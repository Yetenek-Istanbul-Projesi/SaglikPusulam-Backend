<?php

namespace App\Contracts;

use App\DTOs\Comment\CommentDTO;
use App\Models\Comment;

interface CommentServiceInterface
{
    /**
     * Yeni yorum ekler
     */
    public function addComment(CommentDTO $dto): array;

    /**
     * Yorumu günceller
     */
    public function updateComment(Comment $comment, CommentDTO $dto): array;

    /**
     * Yorumu siler
     */
    public function deleteComment(Comment $comment): array;

    /**
     * Hizmetin yorumlarını getirir
     */
    public function getComments(int $serviceId): array;
}
