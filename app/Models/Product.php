<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $data)
 * @method static findOrFail($id)
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'code',
        'price',
        'description',
        'is_active',
        'post_id',
        'category_id',
        'user_id'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Images::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get attributes child by Product
     * */
    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(Term::class, 'product_terms', 'product_id', 'term_id')->withPivot('price');
    }
}
