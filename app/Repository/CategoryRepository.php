<?php
namespace App\Repository;

use App\Models\Category;
use App\Repository\Interface\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    public function all()
    {
        return Category::all();
    }
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}