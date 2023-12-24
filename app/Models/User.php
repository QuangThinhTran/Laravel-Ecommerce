<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $array)
 * @method static find($id)
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
        'role_id'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $hidden = [
        'password',
        'role_id'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->posts()->delete();
        });

        static::restoring(function ($user) {
            $user->posts()->onlyTrashed()->restore();
        });
    }

    public function scopeSearch($query)
    {
        if (request('key'))
        {
            $key = request('key');
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        return $query;
    }
}
