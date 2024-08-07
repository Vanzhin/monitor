<?php
declare(strict_types=1);

namespace App\Monitors\Infrastructure\EventHandler;

use App\Monitors\Application\DTO\Monitor\MonitorDTOTransformer;
use App\Monitors\Domain\Event\MonitorSavedEvent;
use App\Monitors\Domain\Repository\MonitorRepositoryInterface;
use App\Share\Application\Event\EventHandlerInterface;
use App\Share\Domain\Service\RedisService;

readonly class MonitorSavedEventHandler implements EventHandlerInterface
{
    public function __construct(
        private MonitorRepositoryInterface $monitorRepository,
        private RedisService               $cache,
        private MonitorDTOTransformer      $transformer,
    )
    {
    }

    public function __invoke(MonitorSavedEvent $event): string
    {
        $monitor = $this->monitorRepository->getByUuid($event->monitorId);
        if ($monitor) {
            $this->cache->add($event->monitorId, $this->transformer->fromMonitorEntity($monitor)->jsonSerialize(), 0);
        } else {
            $this->cache->delete($event->monitorId);
        }

        return $monitor->getId();
    }
}