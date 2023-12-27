<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $data)
 * @method static find($id)
 * @method static findorFail($id)
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'user_id',
    ];

    protected $dateFormat = [
        'created_at' => 'd-m-Y',
        'updated_at' => 'd-m-Y',
        'deleted_at' => 'd-m-Y'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Images::class, 'post_id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes', 'post_id', 'user_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($posts) {
            $posts->images()->delete();
        });

        static::restoring(function ($posts) {
            $posts->images()->onlyTrashed()->restore();
        });
    }
}
