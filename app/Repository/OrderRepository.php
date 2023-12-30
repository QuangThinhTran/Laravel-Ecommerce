<?php

namespace App\Repository;

use App\Models\Order;
use App\Repository\Interface\IOrderRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements IOrderRepository
{
    /**
     * Get list Orders and paginate
     * @return LengthAwarePaginator
     * */
    public function index(): LengthAwarePaginator
    {
        return Order::with('cart', 'user', 'status')->orderByDesc('id')->paginate(10);
    }

    /**
     * Create Order
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Order::create($data);
    }

    /**
     * Detail Order
     * @param $id
     * @return Model|Collection
     * */
    public function detail($id): Model|Collection
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id);
    }

    /**
     * Detail Order
     * @param $id
     * @param array $data
     * @return bool
     * */
    public function update($id, array $data): bool
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id)->update($data);
    }

    /**
     * Delete Order
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id)->delete();
    }

    /**
     * Restore Order
     * @param $id
     * @return bool
     * */
    public function restore($id): bool
    {
        return Order::with('cart', 'user', 'status')->findOrFail($id)->withTrashed()->restore();
    }
}