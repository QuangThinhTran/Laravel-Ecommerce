<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 * @method static create(array $data)
 */
class AttributeChild extends Model
{
    use HasFactory;

    protected $table = 'attribute_child';
    protected $fillable = [
        'name',
        'description',
        'price',
        'attribute_id'
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
