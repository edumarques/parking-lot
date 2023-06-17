<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

interface ValidationAwareInterface
{
    public function isValid(): bool;

    public function setIsValid(bool $isValid): static;
}
