<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Spot;

/**
 * @method Spot findOrThrow(int $id, bool $throw = true, ?int $lockMode = null, ?int $lockVersion = null)
 * @method Spot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spot|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method Spot[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method Spot[] findAll()
 * @method void save(Spot $object)
 * @method void delete(Spot $object)
 */
final class SpotRepository extends AbstractRepository implements
    SpotRepositoryInterface,
    AvailabilityAwareRepositoryInterface
{
    public function countAvailable(): int
    {
        return $this->count(['occupyingVehicle' => null]);
    }
}
