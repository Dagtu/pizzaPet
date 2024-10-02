<?php

namespace App\modules\product\Infrastructure\Repositories;

use App\modules\product\Domain\Models\Product;
use App\modules\product\Domain\Repositories\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function updateById($id, $name, $type, $isActive, $price, $imageUrl, $description)
    {
        return Product::query()->where('id', $id)->update(['field' => 'value']);
    }

    public function deleteById($id)
    {
        return Product::query()->where('id', $id)->delete();
    }

    public function create($name, $type, $isActive, $price, $imageUrl, $description)
    {
        return Product::query()->create([
            'name' => $name,
            'type' => $type,
            'isActive' => $isActive,
            'price' => $price,
            'imageUrl' => $imageUrl,
            'description' => $description
        ]);
    }
}
