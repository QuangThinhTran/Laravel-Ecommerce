<?php

namespace App\Repository;

use App\Models\Order;
use App\Repository\Interface\IOrderRepository;

class OrderRepository implements IOrderRepository
{
    public function index()
    {
        return Order::with('cart', 'user', 'status')->orderByDesc('id')->paginate(10);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function detail($id)
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id)->delete();
    }

    public function restore($id)
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id)->withTrashed()->restore();
    }
}