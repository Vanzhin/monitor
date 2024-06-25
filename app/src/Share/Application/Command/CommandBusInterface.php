<?php
declare(strict_types=1);

namespace App\Share\Application\Command;


interface CommandBusInterface
{
    public function execute(CommandInterface $command): mixed;
}