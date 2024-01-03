<?php

namespace App\Repository\Interface;

interface IOrderRepository
{
    public function all();
    public function getOrderByAction($action, $data);

    public function create(array $data);

    public function detail($id);

    public function update($id, array $data);

    public function delete($id);

    public function restore($id);
}