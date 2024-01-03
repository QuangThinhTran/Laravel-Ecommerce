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
     * Get list AttributeChild and paginate
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function all(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Term::with('attribute')->get();
    }

    /**
     * Create AttributeChild
     * @param array $data
     * @return Model|Collection
     */
    public function create(array $data): Model|Collection
    {
        return Term::create($data);
    }

    /**
     * @param $attribute_id
     * @return mixed
     */
    public function find($attribute_id): mixed
    {
        return Term::where('attribute_id', $attribute_id)->get();
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