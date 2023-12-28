<?php
namespace App\Repository;

use App\Models\Comment;
use App\Models\CommentChild;
use App\Repository\Interface\ICommentRepository;

class CommentRepository implements ICommentRepository
{
    public function add(array $data)
    {
        return Comment::create($data);
    }
    public function find($id){
        return Comment::with('user', 'post')->findOrFail($id);
    }
    public function addChildComment(array $data)
    {
        return CommentChild::create($data);
    }
}