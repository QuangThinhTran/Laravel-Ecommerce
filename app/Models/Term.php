<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 * @method static create(array $data)
 */
class Term extends Model
{
    use HasFactory;

    protected $table = 'terms';
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'attribute_id'
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
