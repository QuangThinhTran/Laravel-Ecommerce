<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'title',
        'user_id',
        'post_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function childComments()
    {
        return $this->hasMany(CommentChild::class);
    }
}
