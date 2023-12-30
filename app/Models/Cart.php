<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $data)
 */
class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'carts';
    protected $fillable = [
        'total',
        'is_active',
        'user_id'
    ];

    public function detail(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'cart_detail', 'cart_id', 'product_id');
    }
}
