<?php

namespace App\Modules\Product\Infrastructure\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'type',
        'is_active',
        'price',
        'image_url',
        'description'
    ];

    protected $guarded = [
        'id'
    ];

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }
}
