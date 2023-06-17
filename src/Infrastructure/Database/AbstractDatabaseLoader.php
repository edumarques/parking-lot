<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

abstract readonly class AbstractDatabaseLoader implements DatabaseLoaderInterface
{
    protected function seed(): void
    {
    }
}
