<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';
    protected $fillable = ['name'];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
