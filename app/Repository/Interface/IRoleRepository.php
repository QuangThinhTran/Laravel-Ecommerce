<?php

namespace App\Repository\Interface;

interface IRoleRepository
{
    public function create($data);

    public function delete($id);
}