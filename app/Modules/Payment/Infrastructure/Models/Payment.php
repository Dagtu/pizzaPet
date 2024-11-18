<?php

namespace App\Modules\Payment\Infrastructure\Models;

use App\Modules\Order\Infrastructure\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'time',
        'status',
        'type',
        'order_id',
    ];

    protected $casts = [
        'time' => 'timestamp',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
