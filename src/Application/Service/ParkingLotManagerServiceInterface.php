<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\ValueObject\ValueObjectInterface;

interface ParkingLotManagerServiceInterface
{
    public function checkIn(ValueObjectInterface $data): void;

    public function checkOut(ValueObjectInterface $data): void;
}
