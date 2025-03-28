<?php declare(strict_types=1);

namespace App\Shared;

use App\Queries\GetIntervalsQuery;

abstract class Handler
{
    /**
     * Handles the given query and returns the result as an array.
     *
     * @param GetIntervalsQuery $query
     * 
     * @return array<array{start: int, end: int}>
     */
    abstract protected function handle(GetIntervalsQuery $query): array;
}
