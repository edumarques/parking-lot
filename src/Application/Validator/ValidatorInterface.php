<?php

declare(strict_types=1);

namespace App\Application\Validator;

use App\Application\ValueObject\ValidationAwareInterface;

interface ValidatorInterface
{
    public function validate(?ValidationAwareInterface $data = null): void;
}
