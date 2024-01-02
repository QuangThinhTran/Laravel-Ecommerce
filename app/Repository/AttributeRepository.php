<?php

namespace App\Repository;

use App\Models\Attribute;
use App\Repository\Interface\IAttributeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AttributeRepository implements IAttributeRepository
{
    /**
     * Get list Attributes by user id and paginate
     * @return LengthAwarePaginator
     * */
    public function all(): LengthAwarePaginator
    {
        return Attribute::with('user')->where('user_id', auth()->id())->paginate(10);
    }

    /**
     * Get create Attribute
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Attribute::create($data);
    }

    /**
     * Get detail Attribute
     * @param $id
     * @return Model|Collection
     */
    public function detail($id): Model|Collection
    {
        return Attribute::with('user')->findOrFail($id);
    }

    /**
     * update Attribute
     * @param $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool
    {
        return Attribute::findOrFail($id)->update($data);
    }

    /**
     * delete Attribute
     * @param $id
     * @return bool|null
     */
    public function delete($id): bool|null
    {
        return Attribute::findOrFail($id)->delete();
    }

    /**
     * restore Attribute
     * @param $id
     * @return bool
     */
    public function restore($id): bool
    {
        return Attribute::findOrFail($id)->withTrashed()->restore();
    }
}