<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

class VehicleData implements ValueObjectInterface, ValidationAwareInterface
{
    public function __construct(
        protected readonly string $licensePlate,
        protected bool $isValid = false
    ) {
    }

    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): static
    {
        $this->isValid = $isValid;

        return $this;
    }
}
