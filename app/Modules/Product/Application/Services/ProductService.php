<?php

namespace App\Modules\Product\Application\Services;

use App\Modules\Product\Application\Exceptions\ProductServiceException;
use App\Modules\Product\Application\Input\RequestsDTO\CreateProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\DeleteProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\GetProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\ProductsDTO;
use App\Modules\Product\Application\Input\RequestsDTO\UpdateProductDTO;
use App\Modules\Product\Application\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Domain\Entities\ProductEntity;

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
     * @throws ProductServiceException
     */
    public function getById(GetProductDTO $request): ProductEntity
    {
        $productEntity = $this->productRepository->getById(id: $request->getId());

        if ($productEntity === null) {
            throw new ProductServiceException(ProductServiceException::CODE_PRODUCT_NOT_FOUND);
        }

        return $productEntity;
    }

    /**
     * @throws ProductServiceException
     */
    public function updateById(UpdateProductDTO $request): int
    {
        $resultUpdate = $this->productRepository->updateById(
            id: $request->getId(),
            name: $request->getName(),
            type: $request->getType(),
            isActive: $request->getIsActive(),
            price: $request->getPrice(),
            imageUrl: $request->getImageUrl(),
            description: $request->getDescription()
        );

        if ($resultUpdate === 0) {
            throw new ProductServiceException(ProductServiceException::CODE_PRODUCT_NOT_FOUND);
        }

        return $resultUpdate;
    }

    /**
     * @throws ProductServiceException
     */
    public function deleteById(DeleteProductDTO $request): bool
    {
        $resultDelete = $this->productRepository->deleteById($request->getId());

        if (!$resultDelete) {
            throw new ProductServiceException(ProductServiceException::CODE_ERROR_DELETE_PRODUCT);
        }

        return true;
    }

    public function create(CreateProductDTO $request): ProductEntity
    {
        return $this->productRepository->create(
            name: $request->getName(),
            type: $request->getType(),
            isActive: $request->getIsActive(),
            price: $request->getPrice(),
            imageUrl: $request->getImageUrl(),
            description: $request->getDescription()
        );
    }

    public function checkExists(ProductsDTO $productsDTO) : bool
    {
        $productsCount = $this->productRepository->getCountActiveByIds($productsDTO->getIds());

        if ($productsCount !== count($productsDTO->getIds())) {
            return false;
        }

        return true;
    }

    public function checkPrice(ProductsDTO $productsDTO) : bool
    {
        $products = $this->productRepository->getByIds($productsDTO->getIds());

        $productsPrices = array_column($products, 'price', 'id');

        foreach ($productsDTO->products as $productDTO) {
            if ($productsPrices[$productDTO->id->getValue()] !== $productDTO->price->getValue()) {
                return false;
            }
        }

        return true;
    }
}
