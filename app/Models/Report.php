<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $data)
 * @method static find($id)
 * @method static findOrFail($id)
 */
class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reports';

    protected $fillable = [
        'content',
        'post_id',
        'user_id',
    ];

    protected $dateFormat = 'd-m-Y';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
