<?php

namespace App\Modules\Auth\Domain\Enums;

enum Guards: string
{
    case Web = 'web';
    case WebAdmin = 'webAdmin';
    case Admin = 'admin';
    case Client = 'client';
}
