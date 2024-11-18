<?php

namespace App\Modules\Courier\Application\Services;

use App\Modules\Courier\Application\Exceptions\CourierServiceException;
use App\Modules\Courier\Application\Repositories\CourierRepositoryInterface;
use App\Modules\Courier\Domain\Entities\CourierEntity;
use App\Modules\Courier\Domain\Enums\CourierStatuses;
use App\Modules\User\Application\Input\RequestsDTO\AddressDTO;

class CourierService
{
    public function __construct(private readonly CourierRepositoryInterface $courierRepository) {}

    /**
     * Зачем передается адрес? Этот метод является лишь симуляцией.
     * В настоящем функционале подразумевается использование адреса для корректного назначения курьера.
     *
     * @throws CourierServiceException
     */
    public function assign(AddressDTO $addressDTO) : CourierEntity
    {
        $couriers = $this->courierRepository->findAvailable(CourierStatuses::Pending->value);

        if (empty($couriers)) {
            throw new CourierServiceException(CourierServiceException::CODE_COURIER_NOT_FOUND);
        }

        $selectedCourier = $couriers[array_rand($couriers)];
        $updateStatus = $this->courierRepository->updateCourierStatus(
            $selectedCourier->id,
            CourierStatuses::InProgress->value
        );

        if (!$updateStatus) {
            throw new CourierServiceException(CourierServiceException::CODE_COURIER_ERROR_UPDATE_STATUS);
        }

        return $selectedCourier;
    }
}
