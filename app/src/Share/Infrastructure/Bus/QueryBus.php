<?php

declare(strict_types=1);

namespace App\Share\Infrastructure\Bus;

use App\Share\Application\Query\QueryBusInterface;
use App\Share\Application\Query\QueryInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;


class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function execute(QueryInterface $query): mixed
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $exception) {
            throw current($exception->getWrappedExceptions());
        }
    }
}
