<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    protected $dateFormat = [
        'created_at' => 'd-m-Y',
        'updated_at' => 'd-m-Y',
        'deleted_at' => 'd-m-Y'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
