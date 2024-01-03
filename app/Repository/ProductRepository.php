<?php

namespace App\Repository;

use App\Models\Product;
use App\Repository\Interface\IProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements IProductRepository
{
    /**
     * Get all products
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return Product::with('category', 'user', 'images', 'post', 'terms.attribute')->orderByDesc('id')->paginate(10);
    }

    /**
     * Get list Products by User id and paginate
     * @return LengthAwarePaginator
     * */
    public function getProductByUser(): LengthAwarePaginator
    {
        return Product::with('category', 'user', 'images', 'post', 'terms.attribute')->where('user_id',
            auth()->id())->orderByDesc('id')->paginate(10);
    }

    /**
     * Get list Products active or inactive and paginate
     * @param boolean $active | true: active , false: inactive
     * @return LengthAwarePaginator
     * */
    public function getProductByActive($active): LengthAwarePaginator
    {
        return Product::with('category', 'user', 'images', 'post')->where('is_active',
            $active)->orderByDesc('id')->paginate(10);
    }

    /**
     * Create Product
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Product::create($data);
    }

    /**
     * Detail Product
     * @param $id
     * @return Model|Collection
     * */
    public function find($id): Model|Collection
    {
        return Product::findOrFail($id);
    }

    /**
     * Update Product
     * @param $id
     * @param array $data
     * @return bool
     * */
    public function update($id, array $data): bool
    {
        return Product::findOrFail($id)->update($data);
    }

    /**
     * Delete Product
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Product::findOrFail($id)->delete();
    }

    /**
     * Restore Product
     * @param $id
     * @return bool
     * */
    public function restore($id): bool
    {
        return Product::findOrFail($id)->withTrashed()->restore();
    }
}