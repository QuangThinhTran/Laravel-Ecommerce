<?php

namespace App\Repository;

use App\Models\Term;
use App\Repository\Interface\ITermRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class TermRepository implements ITermRepository
{

    /**
     * Get all records of AttributeChild with relationships and paginate
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return Term::with('attribute')->get();
    }

    /**
     * Create a new AttributeChild record
     * @param array $data
     * @return Model|Collection
     */
    public function create(array $data): Model|Collection
    {
        return Term::create($data);
    }

    /**
     * Find a specific Term record by Attribute ID
     * @param $attribute_id
     * @return mixed
     */
    public function find($attribute_id): mixed
    {
        return Term::where('attribute_id', $attribute_id)->get();
    }

    /**
     * Update a specific Term record by ID with provided data
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete a specific Term record by ID
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Restore a specific soft-delete Term record by ID
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        // TODO: Implement restore() method.
    }
}