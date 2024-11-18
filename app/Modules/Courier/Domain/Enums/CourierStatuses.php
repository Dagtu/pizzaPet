<?php

namespace App\Modules\Courier\Domain\Enums;

enum CourierStatuses : string
{
    case Offline = 'offline';
    case InProgress = 'in_progress';
    case Pending = 'pending';
}
