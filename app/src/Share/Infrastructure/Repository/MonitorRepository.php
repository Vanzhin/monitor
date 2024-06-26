<?php

declare(strict_types=1);

namespace App\Share\Infrastructure\Repository;

use App\Monitors\Domain\Entity\Monitor;
use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class MonitorRepository extends ServiceEntityRepository implements MonitorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monitor::class);
    }

    public function add(Monitor $monitor): void
    {
        $this->getEntityManager()->persist($monitor);
        $this->getEntityManager()->flush();
    }

    public function getByUuid(string $uuid): ?Monitor
    {
        return $this->find($uuid);
    }

    public function delete(Monitor $monitor): void
    {
        $this->getEntityManager()->remove($monitor);
        $this->getEntityManager()->flush();
    }
}
