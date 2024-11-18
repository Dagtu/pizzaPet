<?php

namespace Tests\Unit;

use App\Modules\Courier\Application\Exceptions\CourierServiceException;
use App\Modules\Courier\Application\Repositories\CourierRepositoryInterface;
use App\Modules\Courier\Application\Services\CourierService;
use App\Modules\Courier\Domain\Entities\CourierEntity;
use App\Modules\Courier\Domain\Enums\CourierStatuses;
use App\Modules\User\Application\Input\RequestsDTO\AddressDTO;
use App\Modules\User\Domain\ValueObjects\ApartmentValue;
use App\Modules\User\Domain\ValueObjects\CityValue;
use App\Modules\User\Domain\ValueObjects\HouseNumberValue;
use App\Modules\User\Domain\ValueObjects\RegionValue;
use App\Modules\User\Domain\ValueObjects\StreetValue;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class CourierServiceTest extends TestCase
{
    protected CourierRepositoryInterface $courierRepositoryMock;
    protected CourierService $courierService;

    /**
     * @throws Exception
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->courierRepositoryMock = $this->createMock(CourierRepositoryInterface::class);
        $this->courierService = new CourierService($this->courierRepositoryMock);
    }

    /**
     * @throws CourierServiceException
     */
    public function test_assign_courier_to_order_when_courier_pending_exists(): void
    {
        $fakeCourierEntity = new CourierEntity(
            id: 1,
            name: 'Test Courier',
            lastName: 'Test Courier',
            isActive: true,
            status: CourierStatuses::InProgress->value,
            locationId: 1
        );

        $this->courierRepositoryMock->expects($this->once())
            ->method('findAvailable')
            ->with(CourierStatuses::Pending->value)
            ->willReturn([$fakeCourierEntity]);

        $fakeAddressDTO = new AddressDTO(
            new RegionValue('тестОбласть'),
            new CityValue('тестГород'),
            new StreetValue('тестУлица'),
            new HouseNumberValue(1),
            new ApartmentValue(1)
        );

        $this->courierRepositoryMock->expects($this->once())
            ->method('updateCourierStatus')
            ->with(1, CourierStatuses::InProgress->value)
            ->willReturn(true);

        $result = $this->courierService->assign($fakeAddressDTO);

        $this->assertInstanceOf(CourierEntity::class, $result);
        $this->assertEquals(1, $result->id);
        $this->assertEquals(CourierStatuses::InProgress->value, $result->status);
    }

    public function test_assign_courier_to_order_when_courier_pending_not_exists(): void
    {
        $this->courierRepositoryMock->expects($this->once())
            ->method('findAvailable')
            ->with(CourierStatuses::Pending->value)
            ->willReturn([]);

        $fakeAddressDTO = new AddressDTO(
            new RegionValue('тестОбласть'),
            new CityValue('тестГород'),
            new StreetValue('тестУлица'),
            new HouseNumberValue(1),
            new ApartmentValue(1)
        );

        $this->expectException(CourierServiceException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('No available couriers');

        $this->courierService->assign($fakeAddressDTO);
    }

    public function test_assign_courier_to_order_when_courier_error_update_status(): void
    {
        $fakeCourierEntity = new CourierEntity(
            id: 1,
            name: 'Test Courier',
            lastName: 'Test Courier',
            isActive: true,
            status: CourierStatuses::Pending->value,
            locationId: 1
        );

        $this->courierRepositoryMock->expects($this->once())
            ->method('findAvailable')
            ->with(CourierStatuses::Pending->value)
            ->willReturn([$fakeCourierEntity]);

        $fakeAddressDTO = new AddressDTO(
            new RegionValue('тестОбласть'),
            new CityValue('тестГород'),
            new StreetValue('тестУлица'),
            new HouseNumberValue(1),
            new ApartmentValue(1)
        );

        $this->courierRepositoryMock->expects($this->once())
            ->method('updateCourierStatus')
            ->with(1, CourierStatuses::InProgress->value)
            ->willReturn(false);

        $this->expectException(CourierServiceException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Courier error update status');

        $this->courierService->assign($fakeAddressDTO);
    }
}
