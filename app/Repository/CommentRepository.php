<?php

namespace App\Repository;

use App\Models\Comment;
use App\Repository\Interface\ICommentRepository;

class CommentRepository implements ICommentRepository
{
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getCommentByAction($action, $data)
    {
        return Comment::with('user', 'post.users')->where($action, $data)->get();
    }
}