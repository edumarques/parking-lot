<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Exception\ValidationException;
use App\Application\ValueObject\ValidationAwareInterface;

trait ValidationCheckTrait
{
    protected function checkValidation(ValidationAwareInterface $data): void
    {
        if (false === $data->isValid()) {
            throw new ValidationException('The data provided has not been validated');
        }
    }
}
