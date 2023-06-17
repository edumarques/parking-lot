<?php

declare(strict_types=1);

namespace App\Application\Validator;

use App\Application\Exception\ValidationException;
use App\Application\ValueObject\ValidationAwareInterface;
use App\Application\ValueObject\VehicleData;
use App\Domain\Entity\Vehicle;
use App\Domain\Repository\VehicleRepositoryInterface;

final readonly class CheckOutValidator implements ValidatorInterface
{
    public function __construct(
        private VehicleRepositoryInterface $vehicleRepository,
    ) {
    }

    /**
     * @param VehicleData|null $data
     */
    public function validate(?ValidationAwareInterface $data = null): void
    {
        $licensePlate = $data?->getLicensePlate();

        /** @var Vehicle|null $vehicle */
        $vehicle = $this->vehicleRepository->findOneBy(['licensePlate' => $licensePlate]);

        if (null === $vehicle || false === $vehicle->isOccupyingSpot()) {
            throw new ValidationException(
                'This license plate is not registered as parked here. Please verify the value you provided.'
            );
        }

        $data->setIsValid(true);
    }
}
