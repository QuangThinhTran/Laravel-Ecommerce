<?php

namespace App\Repository;

use App\Models\Attribute;
use App\Repository\Interface\IAttributeRepository;

class AttributeRepository implements IAttributeRepository
{
    public function index()
    {
        return Attribute::with('user')->where('user_id', auth()->id())->paginate(10);
    }

    public function create(array $data)
    {
        return Attribute::create($data);
    }

    public function detail($id)
    {
        return Attribute::with('user')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return Attribute::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Attribute::findOrFail($id)->delete();
    }

    public function restore($id)
    {
        return Attribute::findOrFail($id)->withTrashed()->restore();
    }
}