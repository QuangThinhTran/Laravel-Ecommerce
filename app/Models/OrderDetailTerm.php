<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $data)
 */
class OrderDetailTerm extends Model
{
    use HasFactory;

    protected $table = 'order_detail_terms';

    protected $fillable = [
        'term_name',
        'term_price',
//        'quantity',
        'order_id'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
