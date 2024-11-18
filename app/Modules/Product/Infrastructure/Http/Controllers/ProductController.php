<?php

namespace App\Modules\Product\Infrastructure\Http\Controllers;

use App\Modules\Product\Application\DataMapper\ProductMapper;
use App\Modules\Product\Application\Input\Validators\CreateProductValidator;
use App\Modules\Product\Application\Services\ProductService;
use App\Modules\Product\Infrastructure\Presenters\ProductPresenter;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService         $productService,
        private readonly ProductMapper          $productMapper,
        private readonly CreateProductValidator $createProductValidator,
        private readonly ProductPresenter       $productPresenter
    ) {}

    public function getProduct($id): JsonResponse
    {
        try {
            $getProductDTO = $this->productMapper->mapGetProductDTOFromRequest($id);
            $viewData = $this->productPresenter->getViewDataProduct($this->productService->getById($getProductDTO));
            return response()->json($viewData);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function getList(): JsonResponse
    {
        $viewData = $this->productPresenter->getViewDataList($this->productService->getAllActive());
        return response()->json($viewData);
    }

    public function getAdminList(): JsonResponse
    {
        $viewData = $this->productPresenter->getViewDataList($this->productService->getAll());
        return response()->json($viewData);
    }

    public function createProduct(Request $request): JsonResponse
    {
        try {
            $createProductDTO = $this->productMapper->mapCreateProductDTOFromRequest(
                $request->input('name'),
                $request->input('type'),
                $request->input('isActive'),
                $request->input('price'),
                $request->input('imageUrl'),
                $request->input('description')
            );

            $this->createProductValidator->validate($createProductDTO);
            $viewData = $this->productPresenter->getViewDataCreate($this->productService->create($createProductDTO));
            return response()->json($viewData, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function updateProduct(Request $request): JsonResponse
    {
        try {
            $updateProductDTO = $this->productMapper->mapUpdateProductDTOFromRequest(
                $request->input('id'),
                $request->input('name'),
                $request->input('type'),
                $request->input('isActive'),
                $request->input('price'),
                $request->input('imageUrl'),
                $request->input('description')
            );
            $this->productService->updateById($updateProductDTO);
            return response()->json(['message' => 'Product updated']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function deleteProduct(Request $request): JsonResponse
    {
        try {
            $deleteProductDTO = $this->productMapper->mapDeleteProductDTOFromRequest($request->input('id'));
            $this->productService->deleteById($deleteProductDTO);
            return response()->json(['message' => 'Product deleted']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
