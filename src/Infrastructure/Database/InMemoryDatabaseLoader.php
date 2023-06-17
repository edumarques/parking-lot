<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Domain\Entity\Spot;
use App\Infrastructure\Exception\InvalidDatabaseTypeException;
use App\Infrastructure\Exception\InvalidSpotsAmountException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

readonly class InMemoryDatabaseLoader extends AbstractDatabaseLoader
{
    /**
     * @inheritDoc
     */
    public static function create(EntityManagerInterface $entityManager, array $options = []): self
    {
        $memoryDatabaseConnection = $options['memoryDatabaseConnection'] ?? false;

        if (false === $memoryDatabaseConnection) {
            throw new InvalidDatabaseTypeException(
                'You must set an in-memory database connection to be able to load it'
            );
        }

        $spotsAmount = $options['spotsAmount'] ?? false;

        if (0 > $spotsAmount) {
            throw new InvalidSpotsAmountException('The amount of spots must not be negative');
        }

        return new self($entityManager, $spotsAmount);
    }

    public function load(): void
    {
        $metaData = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->updateSchema($metaData);

        $this->seed();
    }

    public function drop(): void
    {
        $metaData = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropSchema($metaData);
    }

    protected function seed(): void
    {
        for ($i = 0; $i < $this->spotsAmount; $i++) {
            $spot = new Spot();
            $this->entityManager->persist($spot);
        }

        $this->entityManager->flush();
    }

    protected function __construct(
        protected EntityManagerInterface $entityManager,
        protected int $spotsAmount
    ) {
    }
}
