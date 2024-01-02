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
     * Get list Cart and paginate
     * @return LengthAwarePaginator
     * */
    public function all(): LengthAwarePaginator
    {
        return Cart::with('listProducts.attributesChild')->where('is_active', Constant::CART_INACTIVE)->orderByDesc('id')->paginate(10);
    }

    /**
     * Get list Cart and paginate
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Cart::create($data);
    }

    /**
     * Get detail Cart
     * @param $id
     * @return Model|Collection
     * */
    public function detail($id): Model|Collection
    {
        return Cart::with('user', 'listProducts.attributesChild')->findOrFail($id);
    }

    /**
     * Update Cart
     * @param $id
     * @param array $data
     * @return bool
     * */
    public function update($id, array $data): bool
    {
        return Cart::with('listProducts')->findOrFail($id)->update($data);
    }

    /**
     * Update status Cart
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
     * delete Cart
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Cart::with('listProducts')->findOrFail($id)->delete();
    }

    /**
     * Get list Cart and paginate
     * @param $id
     * @return bool|int
     * */
    public function restore($id): bool|int
    {
        return Cart::with('listProducts')->findOrFail($id)->withTrashed()->restore();
    }
}