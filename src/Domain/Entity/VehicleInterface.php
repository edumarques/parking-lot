<?php

declare(strict_types=1);

namespace App\Domain\Entity;

interface VehicleInterface extends EntityInterface
{
    public function getLicensePlate(): string;
}
