<?php

namespace App\Modules\Order\Infrastructure\Models;

use App\Modules\Courier\Infrastructure\Models\Courier;
use App\Modules\Payment\Infrastructure\Models\Payment;
use App\Modules\User\Infrastructure\Models\Client;
use App\Modules\User\Infrastructure\Models\ClientAddress;
use App\Modules\User\Infrastructure\Models\ClientPhone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'time',
        'client_id',
        'client_address_id',
        'client_phone_id',
        'status',
        'courier_id',
        'comment',
        'total_price',
    ];

    protected $casts = [
        'time' => 'timestamp',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(ClientAddress::class);
    }

    public function phone(): BelongsTo
    {
        return $this->belongsTo(ClientPhone::class);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
