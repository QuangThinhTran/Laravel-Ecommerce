<?php

namespace App\Repository;

use App\Models\Report;
use App\Repository\Interface\ITicketRepository;

class TicketRepository implements ITicketRepository
{
    public function all()
    {
        return Report::with('post', 'user.name')->where('user_id', auth()->id())->paginate(10);
    }

    public function getPostsByUser()
    {
        return Report::with('post', 'user.name')->where('user_id', auth()->id())->paginate(10);
    }

    public function create(array $data)
    {
        return Report::create($data);
    }

    public function find($id)
    {
        return Report::with('post', 'user')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return Report::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Report::findOrFail($id)->delete();
    }
}