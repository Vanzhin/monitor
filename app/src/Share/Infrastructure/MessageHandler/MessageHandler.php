<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\MessageHandler;

use App\Share\Application\Message\MessageHandlerInterface;
use App\Share\Infrastructure\Message\ExternalMessage;

class MessageHandler implements MessageHandlerInterface
{
    public function __invoke(ExternalMessage $message)
    {
        var_dump($message, 'MessageHandler');
        # perform some business logic
    }
}