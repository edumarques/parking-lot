<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\SpotInterface;

/**
 * @method SpotInterface findOrThrow(int $id, bool $throw = true, ?int $lockMode = null, ?int $lockVersion = null)
 * @method SpotInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpotInterface|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method SpotInterface[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method SpotInterface[] findAll()
 * @method void save(SpotInterface $object)
 * @method void delete(SpotInterface $object)
 */
interface SpotRepositoryInterface extends RepositoryInterface
{
    /**
     * @return SpotInterface[]
     */
    public function findAllAvailable(): array;

    public function countAvailable(): int;
}
