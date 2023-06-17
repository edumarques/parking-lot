<?php

declare(strict_types=1);

namespace App\Domain\Entity;

interface SpotOccupationAwareInterface
{
    public function occupySpot(SpotInterface $spot): static;

    public function vacateSpot(): static;

    public function isOccupyingSpot(): bool;
}
