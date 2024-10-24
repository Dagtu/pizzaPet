<?php

namespace App\Modules\Product\Domain\Repositories;

use App\Modules\Product\Domain\Entities\ProductEntity;

interface ProductRepositoryInterface
{
    public function getAll() : array;

    public function getAllActive() : array;

    public function getById(int $id) : ProductEntity|null;

    public function updateById(
        int $id,
        string $name,
        string $type,
        bool $isActive,
        float $price,
        string $imageUrl,
        string $description
    ) : int;

    public function deleteById(int $id) : bool;

    public function create(
        string $name,
        string $type,
        bool $isActive,
        float $price,
        string $imageUrl,
        string $description
    ) : ProductEntity;
}
