<?php

namespace App\Repository\Interface;

interface IPostRepository
{
    public function index();

    public function create(array $data);

    public function detail($id);

    public function update($id, array $data);

    public function delete($id);

    public function restore($id);
}