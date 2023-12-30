<?php
namespace App\Repository;

use App\Models\AttributeChild;
use App\Repository\Interface\IAttributeChildRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AttributeChildRepository implements IAttributeChildRepository
{

    /**
     * Get list AttributeChild and paginate
     * @return LengthAwarePaginator;
     */
    public function all(): LengthAwarePaginator
    {
        return AttributeChild::with('attribute')->paginate();
    }

    /**
     * Create AttributeChild
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        // TODO: Implement detail() method.
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