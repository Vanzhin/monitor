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
        //"{"uuid_contract":"4631721bbe9f55b3b4629afa8d285be0","event_data":{"status":"registered","internal":"103"},"event_type":"peer-status-change"}"
        $body = $encodedEnvelope['body'];
        $headers = $encodedEnvelope['headers'];
        try {
            $message = $this->serializer->deserialize($body, ExternalMessage::class, 'json');
//            var_dump($message,'decode');
        } catch (\Throwable $throwable) {
            throw new MessageDecodingFailedException($throwable->getMessage());
        }
//        $stamps = [];
//        if (!empty($headers['stamps'])) {
//            $stamps = unserialize($headers['stamps']);
//        }

        return new Envelope($message);
    }

    #[\Override] public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();
        $stamps = $envelope->all();
        var_dump($envelope->getMessage(),'encode');
        if ($message instanceof ExternalMessage) {
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