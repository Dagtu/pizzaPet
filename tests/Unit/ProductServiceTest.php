<?php

namespace Tests\Unit;

use App\Modules\Product\Application\Exceptions\DeleteProductServiceException;
use App\Modules\Product\Application\Exceptions\GetProductServiceException;
use App\Modules\Product\Application\Exceptions\UpdateProductServiceException;
use App\Modules\Product\Application\Input\RequestsDTO\DeleteProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\GetProductDTO;
use App\Modules\Product\Application\Input\RequestsDTO\UpdateProductDTO;
use App\Modules\Product\Application\Services\ProductService;
use App\Modules\Product\Domain\Entities\ProductEntity;
use App\Modules\Product\Domain\Enums\ProductTypes;
use App\Modules\Product\Domain\ValueObjects\DescriptionValue;
use App\Modules\Product\Domain\ValueObjects\IdValue;
use App\Modules\Product\Domain\ValueObjects\ImageUrlValue;
use App\Modules\Product\Domain\ValueObjects\IsActiveValue;
use App\Modules\Product\Domain\ValueObjects\NameValue;
use App\Modules\Product\Domain\ValueObjects\PriceValue;
use App\Modules\Product\Domain\ValueObjects\TypeValue;
use App\Modules\Product\Infrastructure\Repositories\ProductRepository;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    protected ProductService $productService;
    protected MockObject $productRepositoryMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->productRepositoryMock = $this->createMock(ProductRepository::class);
        $this->productService = new ProductService($this->productRepositoryMock);
    }

    /**
     * @throws GetProductServiceException
     */
    public function test_get_by_id_returns_product_when_exists(): void
    {
        $fakeProduct = new ProductEntity(
            id: 1,
            name: 'Test Product',
            type: ProductTypes::Dessert->value,
            isActive: true,
            price: 100.02,
            imageUrl: 'http://example.com/test-image.jpg',
            description: 'Test Description, test description'
        );

        $getProductDTO = new GetProductDTO(new IdValue(1));

        $this->productRepositoryMock->expects($this->once())
            ->method('getById')
            ->with(1)
            ->willReturn($fakeProduct);

        $result = $this->productService->getById($getProductDTO);

        $this->assertInstanceOf(ProductEntity::class, $result);
        $this->assertEquals(1, $result->id);
        $this->assertEquals('Test Product', $result->name);
    }

    public function test_get_by_id_throws_exception_when_product_not_found()
    {
        $getProductDTO = new GetProductDTO(new IdValue(999));

        $this->productRepositoryMock->expects($this->once())
            ->method('getById')
            ->with(999)
            ->willReturn(null);

        $this->expectException(GetProductServiceException::class);
        $this->expectExceptionMessage('Product not found');
        $this->expectExceptionCode(404);

        $this->productService->getById($getProductDTO);
    }

    public function test_update_by_id_when_product_exists()
    {
        $updateProductDTO = new UpdateProductDTO(
            new IdValue(1),
            new NameValue('Update name value'),
            new TypeValue(ProductTypes::Dessert->value),
            new IsActiveValue(true),
            new PriceValue(100.02),
            new ImageUrlValue('http://example.com/test-image.jpg'),
            new DescriptionValue('Test Description, test description')
        );

        $this->productRepositoryMock->expects($this->once())
            ->method('updateById')
            ->with(1, 'Update name value', ProductTypes::Dessert->value, true, 100.02, 'http://example.com/test-image.jpg', 'Test Description, test description')
            ->willReturn(1);

        $result = $this->productService->updateById($updateProductDTO);

        $this->assertIsInt($result);
        $this->assertEquals(1, $result);
    }

    public function test_update_by_id_throws_exception_when_product_not_found()
    {
        $updateProductDTO = new UpdateProductDTO(
            new IdValue(999),
            new NameValue('Update name value'),
            new TypeValue(ProductTypes::Dessert->value),
            new IsActiveValue(true),
            new PriceValue(100.02),
            new ImageUrlValue('http://example.com/test-image.jpg'),
            new DescriptionValue('Test Description, test description')
        );

        $this->productRepositoryMock->expects($this->once())
            ->method('updateById')
            ->with(999, 'Update name value', ProductTypes::Dessert->value, true, 100.02, 'http://example.com/test-image.jpg', 'Test Description, test description')
            ->willReturn(0);

        $this->expectException(UpdateProductServiceException::class);
        $this->expectExceptionMessage('Product not found');
        $this->expectExceptionCode(404);

        $this->productService->updateById($updateProductDTO);
    }

    public function test_delete_by_id_when_product_exists()
    {
        $deleteProductDTO = new DeleteProductDTO(new IdValue(1));

        $this->productRepositoryMock->expects($this->once())
            ->method('deleteById')
            ->with(1)
            ->willReturn(true);

        $result = $this->productService->deleteById($deleteProductDTO);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function test_delete_by_id_throws_exception_when_product_not_found()
    {
        $deleteProductDTO = new DeleteProductDTO(new IdValue(999));

        $this->productRepositoryMock->expects($this->once())
            ->method('deleteById')
            ->with(999)
            ->willReturn(false);

        $this->expectException(DeleteProductServiceException::class);
        $this->expectExceptionMessage('Error deleting product');
        $this->expectExceptionCode(500);

        $this->productService->deleteById($deleteProductDTO);
    }
}
