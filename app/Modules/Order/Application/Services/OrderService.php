<?php

namespace App\Modules\Order\Application\Services;

use App\Modules\Courier\Application\Exceptions\CourierException;
use App\Modules\Courier\Application\Services\CourierService;
use App\Modules\Courier\Domain\Enums\CourierStatuses;
use App\Modules\Order\Application\Exceptions\OrderRepositoryException;
use App\Modules\Order\Application\Exceptions\OrderServiceException;
use App\Modules\Order\Application\Input\RequestsDTO\CompleteOrderDTO;
use App\Modules\Order\Application\Input\RequestsDTO\CreateOrderDTO;
use App\Modules\Order\Application\Repositories\OrderRepositoryInterface;
use App\Modules\Order\Domain\Entities\OrderEntity;
use App\Modules\Order\Domain\Enums\OrderStatuses;
use App\Modules\Payment\Application\Exceptions\PaymentException;
use App\Modules\Payment\Application\Exceptions\PaymentServiceException;
use App\Modules\Payment\Application\Services\PaymentService;
use App\Modules\Payment\Domain\Enums\PaymentStatuses;
use App\Modules\Product\Application\Services\ProductService;
use App\Modules\User\Application\Services\ClientService;

class OrderService
{
    public function __construct(
        private readonly PaymentService           $paymentService,
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly ProductService           $productService,
        private readonly CourierService           $courierService,
        private readonly ClientService            $clientService,
    ) {}

    /**
     * @throws OrderServiceException
     */
    public function create(CreateOrderDTO $orderDTO): OrderEntity
    {
        if (!$this->productService->checkExists($orderDTO->products)) {
            throw new OrderServiceException(OrderServiceException::CODE_PRODUCT_OUT_OF_STOCK);
        }

        if (!$this->productService->checkPrice($orderDTO->products)) {
            throw new OrderServiceException(OrderServiceException::CODE_PRICE_PRODUCT_CHANGED);
        }

        if (empty($orderDTO->address->id)) {
            $addressEntity = $this->clientService->addAddress($orderDTO->getClientId(), $orderDTO->address);
            $orderDTO->address->setAddressId($addressEntity->id);
        }

        if (empty($orderDTO->phone->id)) {
            $phoneEntity = $this->clientService->addPhone($orderDTO->getClientId(), $orderDTO->phone);
            $orderDTO->phone->setPhoneId($phoneEntity->id);
        }

        $orderEntity = $this->orderRepository->create(
            $orderDTO->clientId->getValue(),
            $orderDTO->address->id->getValue(),
            $orderDTO->phone->id->getValue(),
            $orderDTO->comment->getValue(),
            $orderDTO->getTotalPrice(),
            $orderDTO->products->getArray(),
            OrderStatuses::PendingPayment->value,
        );

        try {
            $this->paymentService->processPayment($orderEntity->id, $orderDTO->paymentType->getValue());
        } catch (PaymentException $e) {
            $this->orderRepository->updateStatus($orderEntity->id, OrderStatuses::PaymentFailed->value);
            throw new OrderServiceException(OrderServiceException::CODE_PAYMENT_FAILED, $e->getMessage());
        }

        try {
            $this->courierService->assign($orderDTO->address);
        } catch (CourierException $e) {
            $this->orderRepository->updateStatus($orderEntity->id, OrderStatuses::CourierFailed->value);
            throw new OrderServiceException(OrderServiceException::CODE_COURIER_FAILED, $e->getMessage());
        }

        $resultUpdateStatus = $this->orderRepository->updateStatus($orderEntity->id, OrderStatuses::Processing->value);
        if (!$resultUpdateStatus) {
            throw new OrderServiceException(OrderServiceException::CODE_FAILED_UPDATE_ORDER_STATUS);
        }

        return $orderEntity;
    }

    /**
     * @throws OrderServiceException
     */
    public function complete(CompleteOrderDTO $completeOrderDTO): void
    {
        try {
            $this->orderRepository->complete(
                $completeOrderDTO->id->getValue(),
                OrderStatuses::Completed->value,
                PaymentStatuses::Success->value,
                CourierStatuses::Pending->value
            );
        } catch (OrderRepositoryException $e) {
            throw new OrderServiceException(OrderServiceException::CODE_FAILED_COMPLETE_ORDER, $e->getMessage());
        }
    }
}
