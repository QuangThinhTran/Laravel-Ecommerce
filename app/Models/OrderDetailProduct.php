<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $data)
 */
class OrderDetailProduct extends Model
{
    use HasFactory;

    protected $table = 'order_detail_products';
    protected $fillable = [
        'product_code',
        'product_name',
        'product_price',
        'quantity',
        'order_id'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
