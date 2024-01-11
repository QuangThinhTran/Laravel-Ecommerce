<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static insert(array $array)
 */
class Images extends Model
{
    use HasFactory;

    protected $table = 'Images';
    protected $fillable = [
        'path',
        'post_id'
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
