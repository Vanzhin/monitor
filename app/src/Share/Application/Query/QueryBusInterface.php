<?php
declare(strict_types=1);

namespace App\Share\Application\Query;


interface QueryBusInterface
{
    public function execute(QueryInterface $query): mixed;
}