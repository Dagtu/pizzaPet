<?php

namespace App\Modules\Payment\Domain\Enums;

enum PaymentStatuses : string
{
    case Pending = 'pending';
    case Success = 'success';
    case Failed = 'failed';
}
