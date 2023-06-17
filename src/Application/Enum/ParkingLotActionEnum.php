<?php

declare(strict_types=1);

namespace App\Application\Enum;

enum ParkingLotActionEnum: string
{
    case CHECK_IN = 'Check in';
    case CHECK_OUT = 'Check out';
}
