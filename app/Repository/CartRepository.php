<?php
namespace App\Repository;

use App\Models\Cart;
use App\Repository\Interface\ICartRepository;

class CartRepository implements ICartRepository
{
    public function index()
    {
        return Cart::with('detail')->orderByDesc('id')->paginate(10);
    }

    public function create(array $data)
    {
        return Cart::create($data);
    }

    public function detail($id)
    {
        return Cart::with('detail')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return Cart::with('detail')->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Cart::with('detail')->findOrFail($id)->delete();
    }

    public function restore($id)
    {
        return Cart::with('detail')->findOrFail($id)->withTrashed()->restore();
    }
}