<?php

namespace App\Models;

use App\Constant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function customer(): Model|Collection
    {
        return $this->belongsTo(User::class)->where('role_id', Constant::ROLE_CUSTOMER)->first();
    }

    public function merchant(): Model|Collection
    {
        return $this->belongsTo(User::class)->where('role_id', Constant::ROLE_MERCHANT)->first();
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function listOrderDetail(): BelongsToMany
    {
        return $this->belongsToMany(OrderDetail::class, 'order_products', 'order_id', 'order_detail_id');
    }
}
