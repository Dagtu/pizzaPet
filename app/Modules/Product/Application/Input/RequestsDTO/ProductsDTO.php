<?php

namespace App\Modules\Product\Application\Input\RequestsDTO;

class ProductsDTO
{
    /**
     * @param ProductDTO[] $products
     */
    public function __construct(
        public readonly array $products
    ) {}

    public function getIds(): array
    {
        return array_column($this->getArray(), 'product_id');
    }

    public function getArray() : array
    {
        return array_map(function ($product) {
            return [
                'product_id' => $product->id->getValue(),
                'price' => $product->price->getValue(),
                'quantity' => $product->quantity->getValue(),
                'total_price' => $product->getTotalPrice(),
            ];
        }, $this->products);
    }
}
