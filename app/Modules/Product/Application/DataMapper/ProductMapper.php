<?php

namespace App\Modules\Product\Application\DataMapper;

use App\Modules\Common\Domain\ValueObjects\IdValue;
use App\Modules\Common\Domain\ValueObjects\IsActiveValue;
use App\Modules\Product\Application\Input\RequestsDTO\CreateProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\DeleteProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\GetProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\ProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\ProductsDTO;
use App\Modules\Product\Application\Input\RequestsDTO\UpdateProductDTO;
use App\Modules\Product\Domain\Entities\ProductEntity;
use App\Modules\Product\Domain\ValueObjects\DescriptionValue;
use App\Modules\Product\Domain\ValueObjects\ImageUrlValue;
use App\Modules\Product\Domain\ValueObjects\NameValue;
use App\Modules\Product\Domain\ValueObjects\PriceValue;
use App\Modules\Product\Domain\ValueObjects\QuantityValue;
use App\Modules\Product\Domain\ValueObjects\TypeValue;

class ProductMapper
{
    public function mapCreateProductDTOFromRequest(
        string $name,
        string $type,
        string $isActive,
        string $price,
        string $imageUrl,
        string $description
    ): CreateProductDTO
    {
        return new CreateProductDTO(
            new NameValue($name),
            new TypeValue($type),
            new IsActiveValue(filter_var($isActive, FILTER_VALIDATE_BOOLEAN)),
            new PriceValue((float) $price),
            new ImageUrlValue($imageUrl),
            new DescriptionValue($description)
        );
    }

    public function mapGetProductDTOFromRequest(string $id): GetProductDTO
    {
        return new GetProductDTO(new IdValue((int) $id));
    }

    public static function mapToEntityFromDB(
        int $id,
        string $name,
        string $type,
        bool $isActive,
        float $price,
        string $imageUrl,
        string $description
    ): ProductEntity
    {
        return new ProductEntity(
            $id,
            $name,
            $type,
            $isActive,
            $price,
            $imageUrl,
            $description
        );
    }

    public function mapUpdateProductDTOFromRequest(
        string $id,
        string $name,
        string $type,
        string $isActive,
        string $price,
        string $imageUrl,
        string $description
    ): UpdateProductDTO
    {
        return new UpdateProductDTO(
            new IdValue((int) $id),
            new NameValue($name),
            new TypeValue($type),
            new IsActiveValue(filter_var($isActive, FILTER_VALIDATE_BOOLEAN)),
            new PriceValue((float) $price),
            new ImageUrlValue($imageUrl),
            new DescriptionValue($description)
        );
    }

    public function mapDeleteProductDTOFromRequest(string $id): DeleteProductDTO
    {
        return new DeleteProductDTO(new IdValue((int) $id));
    }

    public function mapToProductsDTOFromRequest(array $products): ProductsDTO
    {
        $productsDTOs = [];
        foreach ($products as $product) {
            $productsDTOs[] = new ProductDTO(
                new IdValue((int) $product['id']),
                new PriceValue((float) $product['price']),
                new QuantityValue((int) $product['quantity'])
            );
        }

        return new ProductsDTO($productsDTOs);
    }
}
