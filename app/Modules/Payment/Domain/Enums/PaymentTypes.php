<?php

namespace App\Modules\Payment\Domain\Enums;

enum PaymentTypes : string
{
    case Cash = 'cash';
    case Card = 'card';
}
