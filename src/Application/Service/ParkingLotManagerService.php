<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\ValueObject\ValueObjectInterface;
use App\Application\ValueObject\VehicleData;
use App\Domain\Entity\Spot;
use App\Domain\Entity\Vehicle;
use App\Domain\Repository\SpotRepositoryInterface;
use App\Domain\Repository\VehicleRepositoryInterface;

readonly class ParkingLotManagerService implements ParkingLotManagerServiceInterface
{
    use ValidationCheckTrait;

    public function __construct(
        protected SpotRepositoryInterface $spotRepository,
        protected VehicleRepositoryInterface $vehicleRepository,
    ) {
    }

    /**
     * @param VehicleData $data
     */
    public function checkIn(ValueObjectInterface $data): void
    {
        $this->checkValidation($data);

        $licensePlate = $data->getLicensePlate();

        /** @var Vehicle|null $vehicle */
        $vehicle = $this->vehicleRepository->findOneBy(['licensePlate' => $licensePlate]);
        $vehicle ??= new Vehicle($licensePlate);

        /** @var Spot $spot */
        $spot = $this->spotRepository->findOneBy(['occupyingVehicle' => null]);

        $vehicle->occupySpot($spot);

        $this->spotRepository->save($spot);
    }

    /**
     * @param VehicleData $data
     */
    public function checkOut(ValueObjectInterface $data): void
    {
        $this->checkValidation($data);

        $licensePlate = $data->getLicensePlate();

        /** @var Vehicle $vehicle */
        $vehicle = $this->vehicleRepository->findOneBy(['licensePlate' => $licensePlate]);

        $vehicle->vacateSpot();

        $this->vehicleRepository->save($vehicle);
    }
}
