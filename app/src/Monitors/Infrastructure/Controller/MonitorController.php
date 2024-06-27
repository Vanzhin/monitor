<?php
declare(strict_types=1);

namespace App\Monitors\Infrastructure\Controller;

use App\Monitors\Application\DTO\Monitor\MonitorDTO;
use App\Monitors\Application\UseCase\Command\CreateMonitor\CreateMonitorCommand;
use App\Monitors\Application\UseCase\Command\DeleteMonitor\DeleteMonitorCommand;
use App\Monitors\Application\UseCase\Command\UpdateMonitor\UpdateMonitorCommand;
use App\Monitors\Application\UseCase\Query\FindMonitor\FindMonitorQuery;
use App\Share\Application\Command\CommandBusInterface;
use App\Share\Application\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/monitor', name: 'app_api_monitor_')]
class MonitorController extends AbstractController
{
    //todo вынести в экшены
    public function __construct(
        private readonly QueryBusInterface   $queryBus,
        private readonly CommandBusInterface $commandBus,
    )
    {
    }

    #[Route('/{uuid}', name: 'get', methods: ['GET'])]
    public function get(string $uuid): JsonResponse
    {
        $query = new FindMonitorQuery($uuid);

        $result = $this->queryBus->execute($query);
        if (!$result->monitorDTO) {
            return new JsonResponse('No monitor found.');
        }

        return new JsonResponse($result->monitorDTO);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        extract($data);
        $command = new CreateMonitorCommand($contract, $sip, $is_active, $settings);
        $result = $this->commandBus->execute($command);

        return new JsonResponse($result);
    }

    #[Route('/{uuid}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, string $uuid): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        extract($data);
        $monitorDTO = new MonitorDTO();
        $monitorDTO->is_active = $is_active;
        $monitorDTO->settings = $settings;
        $monitorDTO->sip_server = $sip;
        $monitorDTO->contract = $contract;

        $command = new UpdateMonitorCommand($uuid, $monitorDTO);
        $result = $this->commandBus->execute($command);

        return new JsonResponse($result);
    }

    #[Route('/{uuid}', name: 'delete', methods: ['DELETE'])]
    public function delete(string $uuid): JsonResponse
    {
        $command = new DeleteMonitorCommand($uuid);
        $this->commandBus->execute($command);

        return new JsonResponse('Done.');
    }
}