<?php
namespace App\Repository;

use App\Models\AttributeChild;
use App\Repository\Interface\IAttributeChildRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class AttributeChildRepository implements IAttributeChildRepository
{

    /**
     * Get list AttributeChild and paginate
     * @return LengthAwarePaginator;
     */
    public function all(): LengthAwarePaginator
    {
        return AttributeChild::with('attribute')->paginate(10);
    }

    /**
     * Create AttributeChild
     * @param array $data
     * @return Model|Collection
     */
    public function create(array $data): Model|Collection
    {
        return AttributeChild::create($data);
    }

    /**
     * @param $attribute_id
     * @return mixed
     */
    public function find($attribute_id): mixed
    {
        return AttributeChild::where('attribute_id', $attribute_id)->get();
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        // TODO: Implement restore() method.
    }
}