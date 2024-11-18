<?php

namespace App\Modules\Courier\Infrastructure\Models;

use Database\Factories\CourierFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Courier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'phone',
        'is_active',
        'status',
        'name',
        'last_name',
        'location_id',
    ];

    protected static function newFactory(): Factory
    {
        return CourierFactory::new();
    }
}
