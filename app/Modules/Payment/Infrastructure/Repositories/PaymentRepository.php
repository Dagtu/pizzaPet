<?php

namespace App\Modules\Payment\Infrastructure\Repositories;

use App\Modules\Payment\Application\DataMapper\PaymentMapper;
use App\Modules\Payment\Application\Exceptions\PaymentRepositoryException;
use App\Modules\Payment\Application\Repositories\PaymentRepositoryInterface;
use App\Modules\Payment\Domain\Entities\PaymentEntity;
use App\Modules\Payment\Infrastructure\Models\Payment;
use Illuminate\Support\Carbon;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function create(int $orderId, string $type, string $status) : PaymentEntity
    {
        $paymentModel = Payment::create([
            'time' => Carbon::now(),
            'order_id' => $orderId,
            'status' => $status,
            'type' => $type
        ]);

        return PaymentMapper::mapToEntityFromDB(
            $paymentModel->id,
            $paymentModel->time,
            $paymentModel->status,
            $paymentModel->type,
            $paymentModel->order_id
        );
    }

    /**
     * @throws PaymentRepositoryException
     */
    public function updateStatus(int $id, string $status): bool
    {
        if (Payment::query()->where('id', $id)->update(['status' => $status]) === 0) {
            throw new PaymentRepositoryException(PaymentRepositoryException::CODE_ERROR_UPDATE_STATUS);
        }

        return true;
    }

    /**
     * @throws PaymentRepositoryException
     */
    public function updateStatusByOrderId(int $orderId, string $status): bool
    {
        if (Payment::query()->where('order_id', $orderId)->update(['status' => $status]) === 0) {
            throw new PaymentRepositoryException(PaymentRepositoryException::CODE_ERROR_UPDATE_STATUS);
        }

        return true;
    }
}
