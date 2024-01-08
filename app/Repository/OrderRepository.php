<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\OrderDetailProduct;
use App\Models\OrderDetailTerm;
use App\Repository\Interface\IOrderRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements IOrderRepository
{
    /**
     * Get all records of Orders with relationships, ordered by ID in descending order and paginate
     * @return LengthAwarePaginator
     * */
    public function all(): LengthAwarePaginator
    {
        return Order::with('customer', 'merchant', 'status', 'orderDetailProducts',
            'orderDetailTerms')->orderByDesc('id')->paginate(10);
    }

    /**
     * Get all records of Orders by action, data, with relationships, ordered by ID in descending order and paginate
     * @param $action
     * @param $data
     * @return LengthAwarePaginator
     * */
    public function getOrderByAction($action, $data): LengthAwarePaginator
    {
        return Order::with('customer', 'merchant', 'status')->where($action, $data)->orderByDesc('id')->paginate(10);
    }

    /**
     * Create a new Order record
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Order::create($data);
    }

    /**
     * Find a specific Order record by ID with relationships
     * @param $id
     * @return Model|Collection
     * */
    public function detail($id): Model|Collection
    {
        return Order::with('status')->findOrFail($id);
    }

    /**
     * Update a specific Order record by ID, with provided data
     * @param $id
     * @param array $data
     * @return bool
     * */
    public function update($id, array $data): bool
    {
        return Order::findOrFail($id)->update($data);
    }

    /**
     * Delete a specific Order record by ID
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Order::findOrFail($id)->delete();
    }

    /**
     * Restore a specific soft-delete Order record by ID
     * @param $id
     * @return bool
     * */
    public function restore($id): bool
    {
        return Order::findOrFail($id)->withTrashed()->restore();
    }

    /**
     * Create a new OrderDetailProduct record
     * @param array $data
     * @return Model|Collection
     * */
    public function createOrderDetailProducts(array $data): Model|Collection
    {
        return OrderDetailProduct::create($data);
    }

    /**
     * Create a new OrderDetailTerm record
     * @param array $data
     * @return Model|Collection
     * */
    public function createOrderDetailTerms(array $data): Model|Collection
    {
        return OrderDetailTerm::create($data);
    }
}