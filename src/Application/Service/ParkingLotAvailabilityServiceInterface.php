<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\ValueObject\ParkingLotAvailabilityInterface;

interface ParkingLotAvailabilityServiceInterface
{
    public function getAvailability(): ParkingLotAvailabilityInterface;
}
