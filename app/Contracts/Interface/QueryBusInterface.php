<?php declare(strict_types=1);

namespace App\Contracts\Interface;

use App\Shared\Query;

interface QueryBusInterface
{
    /**
     * Executes a query and returns the result.
     *
     * @param Query $query
     * 
     * @return mixed
     */
    public function ask(Query $query): mixed;

    /**
     * Registers query handlers.
     *
     * @param array<string> $map
     */
    public function register(array $map): void;
}
