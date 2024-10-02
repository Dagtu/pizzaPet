<?php

namespace App\modules\product\Application\Services;

use App\modules\product\Application\Input\RequestsDTO\createProductDTO;
use App\modules\product\Application\Input\RequestsDTO\deleteProductDTO;
use App\modules\product\Application\Input\RequestsDTO\updateProductDTO;
use App\modules\product\Domain\Repositories\ProductRepositoryInterface;

class ProductService
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository) {}

    public function getAll()
    {
        $this->productRepository->getAll();
    }

    public function updateById(updateProductDTO $request)
    {
        $this->productRepository->updateById(
            $request->id,
            $request->name,
            $request->type,
            $request->isActive,
            $request->price,
            $request->imageUrl,
            $request->description
        );
    }

    public function deleteById(deleteProductDTO $request) {
        $this->productRepository->deleteById($request->id);
    }

    public function create(createProductDTO $request)
    {
        $this->productRepository->create(
            $request->name,
            $request->type,
            $request->isActive,
            $request->price,
            $request->imageUrl,
            $request->description
        );
    }
}
