<?php
namespace App\Repository;

use App\Models\Comment;
use App\Repository\Interface\ICommentRepository;

class CommentRepository implements ICommentRepository
{
    public function add(array $data)
    {
        return Comment::create($data);
    }
}