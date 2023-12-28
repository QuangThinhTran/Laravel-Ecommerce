<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class CommentChild extends Model
{
    use HasFactory;

    protected $table = 'comment_child';
    protected $fillable = [
        'content',
        'user_id',
        'comment_id'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
