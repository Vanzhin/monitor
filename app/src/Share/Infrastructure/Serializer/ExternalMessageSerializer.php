<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\Serializer;

use App\Share\Domain\Message\MessageInterface;
use App\Share\Infrastructure\Message\ExternalMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\MessageDecodingFailedException;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface as MessageSerializerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExternalMessageSerializer implements MessageSerializerInterface
{

    public function __construct(private SerializerInterface $serializer)
    {
    }

    #[\Override] public function decode(array $encodedEnvelope): Envelope
    {
        $body = $encodedEnvelope['body'];
        try {
            $message = $this->serializer->deserialize($body, ExternalMessage::class, 'json');
        } catch (\Throwable $throwable) {
            throw new MessageDecodingFailedException($throwable->getMessage());
        }

        return new Envelope($message);
    }

    #[\Override] public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();
        $stamps = $envelope->all();
        if ($message instanceof MessageInterface) {
            $data = [
                'uuid_contract' => $message->getUuidContract(),
                'event_type' => $message->getEventType(),
                'event_data' => $message->getEventData(),

            ];
        } else {
            throw new \Exception(sprintf('Serializer does not support message of type %s.', $message::class));
        }

        return [
            'body' => json_encode($data),
            'headers' => [
                'stamps' => serialize($stamps)
            ]
        ];
    }
}