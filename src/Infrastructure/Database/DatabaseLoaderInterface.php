<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use Doctrine\ORM\EntityManagerInterface;

interface DatabaseLoaderInterface
{
    /**
     * @param mixed[] $options
     */
    public static function create(EntityManagerInterface $entityManager, array $options = []): static;

    public function load(): void;
}
