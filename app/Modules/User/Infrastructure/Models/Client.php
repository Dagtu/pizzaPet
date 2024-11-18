<?php

namespace App\Modules\User\Infrastructure\Models;

use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    protected static function newFactory(): Factory
    {
        return ClientFactory::new();
    }
}
