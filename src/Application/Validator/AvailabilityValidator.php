<?php

declare(strict_types=1);

namespace App\Application\Validator;

use App\Application\Exception\ValidationException;
use App\Application\Service\ParkingLotAvailabilityServiceInterface;
use App\Application\ValueObject\ValidationAwareInterface;

final readonly class AvailabilityValidator implements ValidatorInterface
{
    public function __construct(
        private ParkingLotAvailabilityServiceInterface $parkingLotAvailabilityService,
    ) {
    }

    public function validate(?ValidationAwareInterface $data = null): void
    {
        $availability = $this->parkingLotAvailabilityService->getAvailability();

        if (false === $availability->hasAvailableSpots()) {
            throw new ValidationException('Sorry, no place left.');
        }
    }
}
