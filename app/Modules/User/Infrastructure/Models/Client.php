<?php

namespace App\Modules\User\Infrastructure\Models;

use App\Modules\Cart\Infrastructure\Models\Cart;
use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'phone',
        'first_name',
        'last_name',
    ];

    protected $guarded = [
        'id'
    ];

    public function getAddresses(): HasMany
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function getPhones(): HasMany
    {
        return $this->hasMany(ClientPhone::class);
    }

    public function getCarts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    protected static function newFactory(): Factory
    {
        return ClientFactory::new();
    }
}
