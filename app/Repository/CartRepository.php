<?php

namespace App\Repository;

use App\Models\Cart;
use App\Repository\Interface\ICartRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartRepository implements ICartRepository
{
    /**
     * Get list Cart and paginate
     * @return LengthAwarePaginator
     * */
    public function index(): LengthAwarePaginator
    {
        return Cart::with('detail')->orderByDesc('id')->paginate(10);
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
        return Cart::with('detail')->findOrFail($id);
    }

    /**
     * Get list Cart and paginate
     * @param $id
     * @param array $data
     * @return bool
     * */
    public function update($id, array $data): bool
    {
        return Cart::with('detail')->findOrFail($id)->update($data);
    }

    /**
     * delete Cart
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Cart::with('detail')->findOrFail($id)->delete();
    }

    /**
     * Get list Cart and paginate
     * @param $id
     * @return bool|int
     * */
    public function restore($id)
    {
        return Cart::with('detail')->findOrFail($id)->withTrashed()->restore();
    }
}