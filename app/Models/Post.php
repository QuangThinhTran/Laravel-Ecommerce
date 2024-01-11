<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    protected $dateFormat = 'd-m-Y';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Images::class, 'post_id');
    }

    public function comments(): LengthAwarePaginator
    {
        return $this->hasMany(Comment::class, 'user_id')->paginate(3);
    }

    public function countComments(): int
    {
        return $this->hasMany(Comment::class, 'user_id')->count();
    }

    public function likes(): int
    {
        return $this->belongsToMany(Post::class, 'likes', 'post_id', 'user_id')->count();
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'post_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($posts) {
            $posts->images()->delete();
            $posts->comments()->delete();
            $posts->likes()->delete();
            $posts->reports()->delete();
        });

        static::restoring(function ($posts) {
            $posts->images()->onlyTrashed()->restore();
        });
    }
}
