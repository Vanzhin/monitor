<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\MessageHandler;

use App\Share\Application\Message\MessageBusInterface;
use App\Share\Application\Message\MessageHandlerInterface;
use App\Share\Infrastructure\Message\ExternalMessage;
use App\Share\Infrastructure\Message\ExternalMessageToForward;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Envelope;

class MessageHandler implements MessageHandlerInterface
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function __invoke(ExternalMessage $message)
    {

        $message2 = new ExternalMessageToForward('khyj', $message->getEventType(), $message->getEventData());
        $envelope = new Envelope($message2, [new AmqpStamp('test')]);

        $this->messageBus->execute($envelope);
        # perform some business logic
    }
}