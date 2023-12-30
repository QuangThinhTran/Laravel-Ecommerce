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
     * Get list Category and paginate
     * @return LengthAwarePaginator
     * */
    public function all(): LengthAwarePaginator
    {
        return Category::with('products')->paginate(10);
    }

    /**
     * Create Category
     * @param array $data
     * @return Model|Collection
     * */
    public function create(array $data): Model|Collection
    {
        return Category::create($data);
    }

    /**
     * Create Category
     * @param $id
     * @return bool|null
     * */
    public function delete($id): bool|null
    {
        return Category::findOrFail($id)->delete();
    }
}