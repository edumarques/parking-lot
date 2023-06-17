<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait BaseEntityTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: Types::INTEGER)]
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
