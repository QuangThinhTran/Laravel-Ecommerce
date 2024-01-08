<?php

namespace App\Repository;

use App\Constant;
use App\Models\Cart;
use App\Repository\Interface\ICartRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CartRepository implements ICartRepository
{
    /**
     * Get all records of Cart with relationships, ordered by ID in descending order and paginate
     * @return LengthAwarePaginator
     * */
    public function all(): LengthAwarePaginator
    {
        return Cart::with('listProducts.terms')->orderByDesc('id')->paginate(10);
    }

    /**
     * Get all records of Cart by User ID and status with relationships, ordered by ID in descending Cart and paginate
     * @param $id // User Id
     * @param boolean $status
     * @return LengthAwarePaginator
     * */
    public function getCartByUserIDAndStatus($id, $status): LengthAwarePaginator
    {
        return Cart::with('listProducts.terms')->where('user_id', $id)->where('is_active',
            $status)->orderByDesc('id')->paginate(10);
    }

    /**
     * Create a new Cart record
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Cart::create($data);
    }

    /**
     * Find a specific Cart record by ID with relationships
     * @param $id
     * @return Model|Collection
     * */
    public function detail($id): Model|Collection
    {
        return Cart::with('user', 'listProducts.terms', 'cartDetail')->findOrFail($id);
    }

    /**
     * Update a specific Cart by ID with relationships and provided data
     * @param $id
     * @param array $data
     * @return bool
     * */
    public function update($id, array $data): bool
    {
        return Cart::with('listProducts')->findOrFail($id)->update($data);
    }

    /**
     * Update the status of a specific Cart record by ID with relationships
     * @param $id
     * @param $active
     * @return bool
     */
    public function updateStatus($id, $active): bool
    {
        return Cart::with('listProducts')->findOrFail($id)->update([
            'is_active' => $active
        ]);
    }

    /**
     * Delete a specific Cart record by ID
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Cart::findOrFail($id)->delete();
    }

    /**
     * Restore a specific soft-deleted Cart record by ID
     * @param $id
     * @return bool|int
     * */
    public function restore($id): bool|int
    {
        return Cart::findOrFail($id)->withTrashed()->restore();
    }
}