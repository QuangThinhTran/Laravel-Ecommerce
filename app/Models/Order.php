<?php

namespace App\Models;

use App\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $data)
 * @method static findOrFail($id)
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'customer_name',
        'customer_email',
        'merchant_name',
        'merchant_email',
        'total',
        'quantity',
        'customer_id',
        'merchant_id',
        'status_id'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id')->where('role_id', Constant::ROLE_CUSTOMER);
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'merchant_id')->where('role_id', Constant::ROLE_MERCHANT);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
