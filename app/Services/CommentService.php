<?php

namespace App\Services;

use App\DTOs\Comment\CommentDTO;
use App\Models\Comment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentService
{
    // Yorum ekleme işlemi
    public function addComment(CommentDTO $dto): array
    {
        // Hizmetin var olup olmadığını kontrol ediyoruz
        $service = Service::findOrFail($dto->service_id);

        // Yorumu oluşturuyoruz
        $comment = Comment::create([
            'service_id' => $dto->service_id,
            'user_id' => $dto->user_id,
            'content' => $dto->content,
            'is_anonymous' => $dto->is_anonymous,
            'anonymous_name' => $dto->anonymous_name,
            'status' => 'pending' // Varsayılan olarak onay bekliyor
        ]);

        return [
            'message' => 'Yorumunuz başarıyla gönderildi ve onay bekliyor',
            'comment' => $comment
        ];
    }

    // Yorum silme işlemi
    public function deleteComment(int $commentId): array
    {
        $comment = Comment::findOrFail($commentId);

        // Kullanıcının yetkisi var mı kontrol ediyoruz
        if (!$comment->is_anonymous && $comment->user_id !== Auth::id()) {
            throw new \Exception('Bu yorumu silme yetkiniz yok');
        }

        $comment->delete();

        return [
            'message' => 'Yorum başarıyla silindi'
        ];
    }

    // Hizmetin yorumlarını getirme işlemi
    public function getServiceComments(int $serviceId, int $perPage = 10): LengthAwarePaginator
    {
        return Comment::where('service_id', $serviceId)
            ->where('status', 'approved')
            ->with('user:id,first_name,last_name')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    // Yorum durumunu güncelleme işlemi (Admin için)
    public function updateCommentStatus(int $commentId, string $status): array
    {
        $comment = Comment::findOrFail($commentId);
        
        if (!in_array($status, ['approved', 'rejected'])) {
            throw new \Exception('Geçersiz durum');
        }

        $comment->update(['status' => $status]);

        return [
            'message' => 'Yorum durumu güncellendi',
            'comment' => $comment
        ];
    }

    // Bekleyen yorumları getirme işlemi (Admin için)
    public function getPendingComments(): array
    {
        $comments = Comment::where('status', 'pending')
            ->with(['user:id,first_name,last_name', 'service:id,name'])
            ->orderBy('created_at', 'asc')
            ->get();

        return [
            'comments' => $comments
        ];
    }
}
