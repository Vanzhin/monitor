<?php

declare(strict_types=1);

namespace App\Share\Infrastructure\EventListener\Doctrine;

use App\Monitors\Domain\Aggregate\Monitor\Monitor;
use App\Monitors\Domain\Aggregate\Monitor\Specification\MonitorSpecificationInterface;
use App\Share\Domain\Specification\SpecificationInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostLoadEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[AsDoctrineListener(event: Events::postLoad)]
final readonly class InitMonitorSpecificationOnPostLoadListener
{
    //todo надо сделать один на все сущности, но ContainerBagInterface $container не видит спецификацию в параметрах
    public function __construct(private ContainerBagInterface $container, private MonitorSpecificationInterface $monitorSpecification)
    {
    }

    public function postLoad(PostLoadEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof Monitor) {
            $reflect = new \ReflectionClass($entity);

            foreach ($reflect->getProperties() as $property) {
                $type = $property->getType();

                if (is_null($type) || $property->isInitialized($entity)) {
                    continue;
                }

                if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                    // initialize specifications
                    $interfaces = class_implements($type->getName());
                    if (isset($interfaces[SpecificationInterface::class])) {
                        $property->setValue($entity, $this->monitorSpecification);
                    }
                }
            }
        }
    }
}
