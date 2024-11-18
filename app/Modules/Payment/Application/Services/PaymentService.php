<?php

namespace App\Modules\Payment\Application\Services;

use App\Modules\Payment\Application\Contracts\BankGatewayInterface;
use App\Modules\Payment\Application\Exceptions\BankGatewayException;
use App\Modules\Payment\Application\Exceptions\PaymentServiceException;
use App\Modules\Payment\Application\Repositories\PaymentRepositoryInterface;
use App\Modules\Payment\Domain\Entities\PaymentEntity;
use App\Modules\Payment\Domain\Enums\PaymentStatuses;
use App\Modules\Payment\Domain\Enums\PaymentTypes;

class PaymentService
{
    public function __construct(
        private readonly PaymentRepositoryInterface $paymentRepository,
        private readonly BankGatewayInterface $bankGateway
    ) {}

    /**
     * Симуляция оплаты.
     * @throws PaymentServiceException
     */
    public function processPayment(int $orderId, string $type) : PaymentEntity
    {
        $paymentEntity = $this->paymentRepository->create($orderId, $type, PaymentStatuses::Pending->value);

        if ($type !== PaymentTypes::Card->value) {
            return $paymentEntity;
        }

        try {
            $this->bankGateway->send();
        } catch (BankGatewayException $exception) {
            $this->paymentRepository->updateStatus($paymentEntity->id, PaymentStatuses::Failed->value);
            throw new PaymentServiceException(PaymentServiceException::CODE_PAYMENT_FAILED);
        }

        $this->paymentRepository->updateStatus($paymentEntity->id, PaymentStatuses::Success->value);
        $paymentEntity->status = PaymentStatuses::Success->value;

        return $paymentEntity;
    }
}
