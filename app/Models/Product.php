<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_list','product_id', 'attribute_id',);
    }
}
