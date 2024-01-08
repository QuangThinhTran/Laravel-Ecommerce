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
     * Get all records of Attributes related to the authenticated user, with relationships and paginate
     * @return LengthAwarePaginator
     * */
    public function all(): LengthAwarePaginator
    {
        return Attribute::with('user')->where('user_id', auth()->id())->paginate(10);
    }

    /**
     * Create a new Attribute record
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Attribute::create($data);
    }

    /**
     * Find a specific Attribute record by ID with relationships
     * @param $id
     * @return Model|Collection
     */
    public function detail($id): Model|Collection
    {
        return Attribute::with('user')->findOrFail($id);
    }

    /**
     * Update a specific Attribute record by ID with the provided data
     * @param $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool
    {
        return Attribute::findOrFail($id)->update($data);
    }

    /**
     * Delete a specific Attribute record by ID
     * @param $id
     * @return bool|null
     */
    public function delete($id): bool|null
    {
        return Attribute::findOrFail($id)->delete();
    }

    /**
     * Restore a specific soft-deleted Attribute record by ID
     * @param $id
     * @return bool
     */
    public function restore($id): bool
    {
        return Attribute::findOrFail($id)->withTrashed()->restore();
    }
}