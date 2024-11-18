<?php

namespace App\Modules\Product\Infrastructure\Repositories;

use App\Modules\Product\Application\DataMapper\ProductMapper;
use App\Modules\Product\Application\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Domain\Entities\ProductEntity;
use App\Modules\Product\Infrastructure\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll() : array
    {
        return Product::all()->map(fn ($productModel) => ProductMapper::mapToEntityFromDB(
            id: $productModel->id,
            name: $productModel->name,
            type: $productModel->type,
            isActive: $productModel->is_active,
            price: $productModel->price,
            imageUrl: $productModel->image_url,
            description: $productModel->description
        ))->toArray();
    }

    public function getAllActive() : array
    {
        return Product::query()
            ->where('is_active', true)
            ->get()
            ->map(fn ($productModel) => ProductMapper::mapToEntityFromDB(
                id: $productModel->id,
                name: $productModel->name,
                type: $productModel->type,
                isActive: $productModel->is_active,
                price: $productModel->price,
                imageUrl: $productModel->image_url,
                description: $productModel->description
            ))->toArray();
    }

    public function getById(int $id) : ProductEntity|null
    {
        $productModel = Product::query()->where('id', $id)->first();

        if ($productModel !== null) {
            return ProductMapper::mapToEntityFromDB(
                id: $productModel->id,
                name: $productModel->name,
                type: $productModel->type,
                isActive: $productModel->is_active,
                price: $productModel->price,
                imageUrl: $productModel->image_url,
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
            'is_active' => $isActive,
            'price' => $price,
            'image_url' => $imageUrl,
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
            'is_active' => $isActive,
            'price' => $price,
            'image_url' => $imageUrl,
            'description' => $description
        ]);

        return ProductMapper::mapToEntityFromDB(
            id: $productModel->id,
            name : $productModel->name,
            type : $productModel->type,
            isActive: $productModel->is_active,
            price: $productModel->price,
            imageUrl: $productModel->image_url,
            description: $productModel->description
        );
    }

    /**
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids): array
    {
        return Product::query()
            ->whereIn('id', $ids)
            ->get()
            ->map(fn ($productModel) => ProductMapper::mapToEntityFromDB(
                id: $productModel->id,
                name: $productModel->name,
                type: $productModel->type,
                isActive: $productModel->is_active,
                price: $productModel->price,
                imageUrl: $productModel->image_url,
                description: $productModel->description
        ))->toArray();
    }

    /**
     * @param array $getIds
     * @return int
     */
    public function getCountActiveByIds(array $getIds) : int
    {
        return Product::query()
            ->where('is_active', true)
            ->whereIn('id', $getIds)
            ->count();
    }
}
