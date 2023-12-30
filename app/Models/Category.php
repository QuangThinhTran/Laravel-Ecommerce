<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @method static create(array $data)
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';
    protected $fillable = [
        'name'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
