<?php

namespace App\Modules\Product\Infrastructure\Http\Controllers;

use App\Modules\Product\Application\DataMapper\ProductMapper;
use App\Modules\Product\Application\Exceptions\CreateProductInputException;
use App\Modules\Product\Application\Exceptions\GetProductServiceException;
use App\Modules\Product\Application\Input\Validators\CreateProductValidator;
use App\Modules\Product\Application\Services\ProductService;
use App\Modules\Product\Infrastructure\Presenters\ProductPresenter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PharIo\Version\Exception;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService         $productService,
        private readonly ProductMapper          $productMapper,
        private readonly CreateProductValidator $createProductValidator,
        private readonly ProductPresenter       $productPresenter
    ) {}

    /**
     * @throws GetProductServiceException
     */
    public function getProduct($id): \Illuminate\Http\JsonResponse
    {
        try {
            $getProductDTO = $this->productMapper->mapGetProductDTOFromRequest($id);
            $viewData = $this->productPresenter->getViewDataProduct($this->productService->getById($getProductDTO));
            return response()->json($viewData);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function getList(): \Illuminate\Http\JsonResponse
    {
        $viewData = $this->productPresenter->getViewDataList($this->productService->getAllActive());
        return response()->json($viewData);
    }

    public function getAdminList(): \Illuminate\Http\JsonResponse
    {
        $viewData = $this->productPresenter->getViewDataList($this->productService->getAll());
        return response()->json($viewData);
    }

    /**
     * @throws CreateProductInputException
     */
    public function createProduct(Request $request): \Illuminate\Http\JsonResponse
    {
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
    }

    public function updateProduct(Request $request): \Illuminate\Http\JsonResponse
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
            return response()->json('Product updated');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function deleteProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $deleteProductDTO = $this->productMapper->mapDeleteProductDTOFromRequest($request->input('id'));
            $this->productService->deleteById($deleteProductDTO);
            return response()->json('Product deleted');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
