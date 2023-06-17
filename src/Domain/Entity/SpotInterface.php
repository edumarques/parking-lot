<?php

declare(strict_types=1);

namespace App\Domain\Entity;

interface SpotInterface extends EntityInterface
{
    public function isAvailable(): bool;
}
