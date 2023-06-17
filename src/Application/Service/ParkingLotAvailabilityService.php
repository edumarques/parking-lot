<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\ValueObject\ParkingLotAvailability;
use App\Domain\Repository\SpotRepositoryInterface;

readonly class ParkingLotAvailabilityService implements ParkingLotAvailabilityServiceInterface
{
    public function __construct(
        protected SpotRepositoryInterface $spotRepository,
    ) {
    }

    public function getAvailability(): ParkingLotAvailability
    {
        $totalSpotsCount = $this->spotRepository->count([]);
        $availableSpotsCount = $this->spotRepository->countAvailable();

        return new ParkingLotAvailability($totalSpotsCount, $availableSpotsCount);
    }
}
