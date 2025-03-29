<?php declare(strict_types=1);

namespace App\Services;

use App\Shared\Service;
use App\Contracts\Interface\QueryBusInterface;
use App\Queries\GetIntervalsQuery;
use Illuminate\Support\Facades\DB;

class IntervalService extends Service
{
    /**
     * Query Bus for handling requests.
     */
    private readonly QueryBusInterface $queryBus;

    /**
     * Initialize service with Query Bus.
     */
    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * Validate if left boundary <= right boundary.
     */
    public function validateBoundaries(int $left, int $right): bool
    {
        return $left > $right;
    }

    /**
     * Get intervals between boundaries.
     *
     * @return array<array{start: int, end: int}>
     */
    public function fetchIntervals(int $left, int $right): array
    {
        DB::enableQueryLog();

        /** @var array<array{start: int, end: int}> $intervals */
        $intervals = $this->queryBus->ask(
            query: new GetIntervalsQuery(left: $left, right: $right)
        );

        return $intervals;
    }

    /**
     * Log query performance or cache info.
     *
     * @return string
     */
    public function logQueryPerformance(): string
    {
        $queries = DB::getQueryLog();

        if (count(value: $queries) > 0) {
            return 'Query executed in ' . $queries[0]['time'] . ' ms';
        }

        return 'Data retrieved from cache.';
    }
}
