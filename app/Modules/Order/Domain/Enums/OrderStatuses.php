<?php

namespace App\Modules\Order\Domain\Enums;

enum OrderStatuses: string
{
    case PendingPayment = 'pending_payment';
    case PaymentFailed = 'payment_failed';
    case PaymentSuccess = 'payment_success';
    case Processing = 'processing';
    case Delivered = 'delivered';
    case Completed = 'completed';
    case Canceled = 'canceled';
    case CourierFailed = 'courier_failed';
}
