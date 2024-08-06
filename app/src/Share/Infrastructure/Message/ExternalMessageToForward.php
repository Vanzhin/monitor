<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\Message;

use App\Share\Domain\Message\MessageInterface;

readonly class ExternalMessageToForward implements MessageInterface
{
    public function __construct(
        private string $uuid_contract,
        private string $event_type,
        private array  $event_data
    )
    {
    }

    public function getUuidContract(): string
    {
        return $this->uuid_contract;
    }

    public function getEventType(): string
    {
        return $this->event_type;
    }

    public function getEventData(): array
    {
        return $this->event_data;
    }
}