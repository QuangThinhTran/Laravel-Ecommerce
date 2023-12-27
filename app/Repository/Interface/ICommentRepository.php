<?php
namespace App\Repository\Interface;

interface ICommentRepository
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}