<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Repository\SpotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpotRepository::class)]
#[ORM\Table(name: 'spots')]
class Spot implements SpotInterface, VehicleAwareInterface, VehicleOccupationAwareInterface
{
    use BaseEntityTrait;

    #[ORM\OneToOne(inversedBy: 'occupyingSpot', targetEntity: Vehicle::class, cascade: ['all'])]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    protected ?Vehicle $occupyingVehicle = null;

    public function getVehicle(): ?VehicleInterface
    {
        return $this->occupyingVehicle;
    }

    public function setVehicle(?VehicleInterface $vehicle): static
    {
        $this->occupyingVehicle = $vehicle;

        if ($vehicle instanceof SpotOccupationAwareInterface) {
            $vehicle->occupySpot($this);
        }

        return $this;
    }

    public function isAvailable(): bool
    {
        return null === $this->occupyingVehicle;
    }

    public function hasOccupyingVehicle(): bool
    {
        return null !== $this->occupyingVehicle;
    }
}
