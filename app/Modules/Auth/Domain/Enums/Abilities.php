<?php

namespace App\Modules\Auth\Domain\Enums;

enum Abilities: string
{
    case Client = 'client';
    case Admin = 'admin';
}
