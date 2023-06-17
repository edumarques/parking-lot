<?php

declare(strict_types=1);

namespace App\Domain\Entity;

interface VehicleOccupationAwareInterface
{
    public function setOccupyingVehicle(?VehicleInterface $vehicle): static;

    public function hasOccupyingVehicle(): bool;
}
