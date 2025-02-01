<?php

namespace App\Modules\User\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientAddress extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'region',
        'city',
        'street',
        'house_number',
        'apartment',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
