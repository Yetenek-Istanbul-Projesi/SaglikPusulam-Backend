<?php

namespace App\Services\Comment;

use App\Contracts\CommentServiceInterface;
use App\DTOs\Comment\CommentDTO;
use App\Models\Comment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class CommentService implements CommentServiceInterface
{
    public function addComment(CommentDTO $dto): array
    {
        $service = Service::findOrFail($dto->service_id);
        
        // Yorum oluşturma
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'service_id' => $dto->service_id,
            'parent_id' => $dto->parent_id,
            'content' => $dto->content,
            'rating' => $dto->rating
        ]);

        // Eğer yorum bir yanıt ise, üst yorumu güncelle
        if ($dto->parent_id) {
            $parentComment = Comment::findOrFail($dto->parent_id);
            $parentComment->has_replies = true;
            $parentComment->save();
        }

        // Hizmetin ortalama puanını güncelle
        $this->updateServiceRating($service);

        return [
            'message' => 'Yorum başarıyla eklendi',
            'comment' => $comment->load('user')
        ];
    }

    public function updateComment(Comment $comment, CommentDTO $dto): array
    {
        // Yorumu güncelle
        $comment->update([
            'content' => $dto->content,
            'rating' => $dto->rating
        ]);

        // Hizmetin ortalama puanını güncelle
        if ($dto->rating) {
            $service = Service::findOrFail($comment->service_id);
            $this->updateServiceRating($service);
        }

        return [
            'message' => 'Yorum başarıyla güncellendi',
            'comment' => $comment->fresh()->load('user')
        ];
    }

    public function deleteComment(Comment $comment): array
    {
        $service = Service::findOrFail($comment->service_id);

        // Alt yorumları sil
        Comment::where('parent_id', $comment->id)->delete();
        
        // Yorumu sil
        $comment->delete();

        // Hizmetin ortalama puanını güncelle
        $this->updateServiceRating($service);

        return [
            'message' => 'Yorum başarıyla silindi'
        ];
    }

    public function getComments(int $serviceId): array
    {
        // Ana yorumları al
        $comments = Comment::with(['user', 'replies.user'])
            ->where('service_id', $serviceId)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return [
            'comments' => $comments
        ];
    }

    private function updateServiceRating(Service $service): void
    {
        $averageRating = Comment::where('service_id', $service->id)
            ->whereNull('parent_id') // Sadece ana yorumların puanlarını hesapla
            ->whereNotNull('rating')
            ->avg('rating');

        $service->update([
            'rating' => round($averageRating, 2)
        ]);
    }
}
