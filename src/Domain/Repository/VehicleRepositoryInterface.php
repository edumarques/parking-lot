<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\VehicleInterface;

/**
 * @method VehicleInterface findOrThrow(int $id, bool $throw = true, ?int $lockMode = null, ?int $lockVersion = null)
 * @method VehicleInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleInterface|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method VehicleInterface[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method VehicleInterface[] findAll()
 * @method void save(VehicleInterface $object)
 * @method void delete(VehicleInterface $object)
 */
interface VehicleRepositoryInterface extends RepositoryInterface
{
}
