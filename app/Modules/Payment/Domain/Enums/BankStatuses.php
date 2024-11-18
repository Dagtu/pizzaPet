<?php

namespace App\Modules\Payment\Domain\Enums;

enum BankStatuses : string
{
    case Success = 'success';
    case Failed = 'failed';
}
