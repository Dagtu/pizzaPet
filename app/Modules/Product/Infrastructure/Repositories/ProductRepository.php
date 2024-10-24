<?php

namespace App\Modules\Product\Infrastructure\Repositories;

use App\Modules\Product\Application\DataMapper\ProductMapper;
use App\Modules\Product\Domain\Entities\ProductEntity;
use App\Modules\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Infrastructure\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll() : array
    {
        $productsModels = Product::all();

        $products = [];
        foreach ($productsModels as $productModel) {
            $products[] = ProductMapper::mapToEntityFromDB(
                id: $productModel->id,
                name: $productModel->name,
                type: $productModel->type,
                isActive: $productModel->isActive,
                price: $productModel->price,
                imageUrl: $productModel->imageUrl,
                description: $productModel->description
            );
        }

        return $products;
    }

    public function getAllActive() : array
    {
        $productsModels = Product::query()->where('isActive', '=', true)->get();

        $products = [];
        foreach ($productsModels as $productModel) {
            $products[] = ProductMapper::mapToEntityFromDB(
                id: $productModel->id,
                name: $productModel->name,
                type: $productModel->type,
                isActive: $productModel->isActive,
                price: $productModel->price,
                imageUrl: $productModel->imageUrl,
                description: $productModel->description
            );
        }

        return $products;
    }

    public function getById(int $id) : ProductEntity|null
    {
        $productModel = Product::query()->find($id);

        if ($productModel !== null) {
            return ProductMapper::mapToEntityFromDB(
                id: $productModel->id,
                name: $productModel->name,
                type: $productModel->type,
                isActive: $productModel->isActive,
                price: $productModel->price,
                imageUrl: $productModel->imageUrl,
                description: $productModel->description
            );
        }

        return null;
    }

    public function updateById(
        int $id,
        string $name,
        string $type,
        bool $isActive,
        float $price,
        string $imageUrl,
        string $description
    ) : int
    {
        return Product::query()->where('id', $id)->update([
            'name' => $name,
            'type' => $type,
            'isActive' => $isActive,
            'price' => $price,
            'imageUrl' => $imageUrl,
            'description' => $description
        ]);
    }

    public function deleteById(int $id) : bool
    {
        return Product::query()->where('id', $id)->delete();
    }

    public function create(
        string $name,
        string $type,
        bool $isActive,
        float $price,
        string $imageUrl,
        string $description
    ): ProductEntity
    {
        $productModel = Product::query()->create([
            'name' => $name,
            'type' => $type,
            'isActive' => $isActive,
            'price' => $price,
            'imageUrl' => $imageUrl,
            'description' => $description
        ]);

        return ProductMapper::mapToEntityFromDB(
            id: $productModel->id,
            name : $productModel->name,
            type : $productModel->type,
            isActive: $productModel->isActive,
            price: $productModel->price,
            imageUrl: $productModel->imageUrl,
            description: $productModel->description
        );
    }
}
