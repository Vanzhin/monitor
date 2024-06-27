<?php
declare(strict_types=1);

namespace App\Share\Infrastructure\Bus;


use App\Share\Application\Command\CommandBusInterface;
use App\Share\Application\Command\CommandInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->messageBus = $commandBus;
    }

    public function execute(CommandInterface $command): mixed
    {
        try {
            return $this->handle($command);
        } catch (HandlerFailedException $exception) {
            throw current($exception->getWrappedExceptions());
        }
    }
}