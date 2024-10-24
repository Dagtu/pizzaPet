<?php

namespace App\Modules\Product\Application\Services;

use App\Modules\Product\Application\Exceptions\DeleteProductServiceException;
use App\Modules\Product\Application\Exceptions\GetProductServiceException;
use App\Modules\Product\Application\Exceptions\UpdateProductServiceException;
use App\Modules\Product\Application\Input\RequestsDTO\CreateProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\DeleteProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\GetProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\UpdateProductDTO;
use App\Modules\Product\Domain\Entities\ProductEntity;
use App\Modules\Product\Domain\Repositories\ProductRepositoryInterface;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository) {}

    public function getAll(): array
    {
        return $this->productRepository->getAll();
    }

    public function getAllActive(): array
    {
        return $this->productRepository->getAllActive();
    }

    /**
     * @throws GetProductServiceException
     */
    public function getById(GetProductDTO $request): ProductEntity
    {
        $productEntity = $this->productRepository->getById(id: $request->getId());

        if ($productEntity === null) {
            throw new GetProductServiceException('Product not found', 404);
        }

        return $productEntity;
    }

    /**
     * @throws UpdateProductServiceException
     */
    public function updateById(UpdateProductDTO $request): int
    {
        $resultUpdate = $this->productRepository->updateById(
            id: $request->getId(),
            name: $request->getName(),
            type : $request->getType(),
            isActive: $request->getIsActive(),
            price: $request->getPrice(),
            imageUrl: $request->getImageUrl(),
            description: $request->getDescription()
        );

        if ($resultUpdate === 0) {
            throw new UpdateProductServiceException('Product not found', 404);
        }

        return $resultUpdate;
    }

    /**
     * @throws DeleteProductServiceException
     */
    public function deleteById(DeleteProductDTO $request): bool
    {
        $resultDelete = $this->productRepository->deleteById($request->getId());

        if (!$resultDelete) {
            throw new DeleteProductServiceException('Error deleting product', 500);
        }

        return true;
    }

    public function create(CreateProductDTO $request): ProductEntity
    {
        return $this->productRepository->create(
            name: $request->getName(),
            type : $request->getType(),
            isActive: $request->getIsActive(),
            price: $request->getPrice(),
            imageUrl: $request->getImageUrl(),
            description: $request->getDescription()
        );
    }
}
