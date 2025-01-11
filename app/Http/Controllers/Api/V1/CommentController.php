<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Comment\CommentDTO;
use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    // Yorum ekleme
    public function addComment(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => 'required|integer|exists:services,id',
            'content' => 'required|string|min:3|max:1000',
            'is_anonymous' => 'boolean',
            'anonymous_name' => 'nullable|string|max:50'
        ]);

        try {
            $result = $this->commentService->addComment(
                CommentDTO::fromRequest($validated, Auth::id())
            );

            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'data' => $result['comment']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    // Yorum silme
    public function deleteComment(int $commentId): JsonResponse
    {
        try {
            $result = $this->commentService->deleteComment($commentId);

            return response()->json([
                'status' => 'success',
                'message' => $result['message']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    // Hizmetin yorumlarını getirme
    public function getServiceComments(int $serviceId, Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $comments = $this->commentService->getServiceComments($serviceId, $perPage);

        return response()->json([
            'status' => 'success',
            'data' => $comments
        ]);
    }

    // Yorum durumunu güncelleme (Admin için)
    public function updateCommentStatus(int $commentId, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|in:approved,rejected'
        ]);

        try {
            $result = $this->commentService->updateCommentStatus(
                $commentId,
                $validated['status']
            );

            return response()->json([
                'status' => 'success',
                'message' => $result['message'],
                'data' => $result['comment']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    // Bekleyen yorumları getirme (Admin için)
    public function getPendingComments(): JsonResponse
    {
        $result = $this->commentService->getPendingComments();

        return response()->json([
            'status' => 'success',
            'data' => $result['comments']
        ]);
    }
}
