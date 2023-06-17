<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Vehicle;

/**
 * @method Vehicle findOrThrow(int $id, bool $throw = true, ?int $lockMode = null, ?int $lockVersion = null)
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method Vehicle[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method Vehicle[] findAll()
 * @method void save(Vehicle $object)
 * @method void delete(Vehicle $object)
 */
final class VehicleRepository extends AbstractRepository implements VehicleRepositoryInterface
{
}
