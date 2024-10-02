<?php

namespace App\modules\product\Infrastructure\Http\Controllers;

use App\modules\product\Application\Services\ProductService;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    public function __construct(private ProductService $productService)
    {
    }

    public function getList()
    {
        $this->productService->getAll();
    }

    public function updateProduct()
    {
        try {
            $this->productService->updateById();
        } catch (\Exception $e) {

        }
    }

    public function deleteProduct()
    {
        try {
            $this->productService->deleteById();
        } catch (\Exception $e) {

        }
    }

    public function createProduct()
    {
        try {
            $this->productService->create();
        } catch (\Exception $e) {

        }
    }
}
