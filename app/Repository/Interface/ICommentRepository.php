<?php
namespace App\Repository\Interface;

interface ICommentRepository
{
    public function add(array $data);
    public function find($id);
    public function addChildComment(array $data);
}