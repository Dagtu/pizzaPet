<?php

namespace App\Modules\Product\Infrastructure\Presenters;

use App\Modules\Product\Domain\Entities\ProductEntity;

class ProductPresenter
{
    public function getViewDataList(array $productEntities): array
    {
        $viewData = [];
        foreach ($productEntities as $productEntity) {
            $viewData[] = [
                'id' => $productEntity->id,
                'name' => $productEntity->name,
                'type' => $productEntity->type,
                'isActive' => $productEntity->isActive,
                'price' => $productEntity->price,
                'imageUrl' => $productEntity->imageUrl,
                'description' => $productEntity->description
            ];
        }

        return $viewData;
    }

    public function getViewDataCreate(ProductEntity $productEntity): array
    {
        return [
            'id' => $productEntity->id
        ];
    }

    public function getViewDataProduct(ProductEntity $productEntity): array
    {
        return [
            'id' => $productEntity->id,
            'name' => $productEntity->name,
            'type' => $productEntity->type,
            'isActive' => $productEntity->isActive,
            'price' => $productEntity->price,
            'imageUrl' => $productEntity->imageUrl,
            'description' => $productEntity->description
        ];
    }
}
