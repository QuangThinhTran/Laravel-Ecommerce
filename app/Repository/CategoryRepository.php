<?php

namespace App\Repository;

use App\Models\Category;
use App\Repository\Interface\ICategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class CategoryRepository implements ICategoryRepository
{
    /**
     * Get all records of Category with relationships and paginate
     * @return LengthAwarePaginator
     * */
    public function all(): LengthAwarePaginator
    {
        return Category::with('products')->paginate(10);
    }

    /**
     * Create a new Category record
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Category::create($data);
    }

    /**
     * Delete a specific Category record by ID
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Category::findOrFail($id)->delete();
    }
}