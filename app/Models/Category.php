<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';
    protected $fillable = [
        'name'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
