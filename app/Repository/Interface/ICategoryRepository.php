<?php

namespace App\Repository\Interface;

interface ICategoryRepository
{
    public function all();

    public function create(array $data);

    public function delete($id);
}