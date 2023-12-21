<?php
namespace App\Repository;

use App\Models\Role;
use App\Repository\Interface\IRoleRepository;

class RoleRepository implements IRoleRepository
{
    public function create($data)
    {
        return Role::create([
            'name' => $data['name']
        ]);
    }

    public function delete($id)
    {
        return Role::findOrFail($id)->delete();
    }
}