<?php

namespace App\Modules\User\Infrastructure\Models;

use Database\Factories\AdminUserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use HasFactory, HasApiTokens;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'role',
        'is_active'
    ];

    protected $guarded = [
        'id'
    ];

    protected static function newFactory(): Factory
    {
        return AdminUserFactory::new();
    }
}
