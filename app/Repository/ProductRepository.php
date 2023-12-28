<?php

namespace App\Repository;

use App\Models\Product;
use App\Repository\Interface\IProductRepository;

class ProductRepository implements IProductRepository
{
    public function index()
    {
        return Product::with('category', 'user', 'images', 'post', 'attributes')->where('user_id', auth()->id())->orderByDesc('id')->paginate(10);
    }

    public function getProductByActive($active)
    {
        return Product::with('category', 'user', 'images', 'post')->where('is_active',
            $active)->orderByDesc('id')->paginate(10);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function update($id, array $data)
    {
        return Product::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Product::findOrFail($id)->delete();
    }

    public function restore($id)
    {
        return Product::findOrFail($id)->withTrashed()->restore();
    }
}