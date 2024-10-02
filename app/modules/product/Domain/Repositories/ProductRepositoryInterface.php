<?php

namespace App\modules\product\Domain\Repositories;

interface ProductRepositoryInterface
{
    public function getAll();
    public function updateById($id, $name, $type, $isActive, $price, $imageUrl, $description);
    public function deleteById($id);
    public function create($name, $type, $isActive, $price, $imageUrl, $description);
}
