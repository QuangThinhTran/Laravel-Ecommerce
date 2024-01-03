<?php

namespace App\Repository\Interface;

interface ICartRepository
{
    public function all();
    public function getCartByUserIDAndStatus($id, $status);

    public function create(array $data);

    public function detail($id);

    public function update($id, array $data);

    public function updateStatus($id, $active);

    public function delete($id);

    public function restore($id);
}