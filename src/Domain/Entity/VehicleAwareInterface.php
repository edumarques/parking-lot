<?php

declare(strict_types=1);

namespace App\Domain\Entity;

interface VehicleAwareInterface
{
    public function getVehicle(): ?VehicleInterface;
}
