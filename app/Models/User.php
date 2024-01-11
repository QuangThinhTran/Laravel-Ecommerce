<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'isAdmin'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $hidden = [
        'password',
        'role_id'
    ];

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')->paginate(10);
    }

    public function follows($id): bool
    {
        return $this->followings()->where('follower_id', $id)->exists();
    }

    public function like()
    {
        return $this->belongsToMany(User::class, 'likes', 'user_id', 'post_id')->paginate(10);
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->posts()->delete();
            $user->followings()->delete();
            $user->followers()->delete();
            $user->like()->delete();
            $user->bookmarks()->delete();
        });

        static::restoring(function ($user) {
            $user->posts()->onlyTrashed()->restore();
        });
    }

    public function scopeSearch($query)
    {
        if (request('key')) {
            $key = request('key');
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }
}
