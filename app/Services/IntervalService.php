<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Interface\QueryBusInterface;
use App\Queries\GetIntervalsQuery;
use Illuminate\Support\Facades\DB;

final class IntervalService
{
	/**
     * Query Bus for handling requests.
     *
     * @var QueryBusInterface
     */
    private readonly QueryBusInterface $queryBus;

    /**
     * Initialize service with Query Bus.
     *
     * @param QueryBusInterface $queryBus
     */
    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * Validate if left boundary <= right boundary.
     *
     * @param int $left
     * @param int $right
     * 
     * @return bool
     */
    public function validateBoundaries(int $left, int $right): bool
    {
        return $left > $right;
    }

    /**
     * Get intervals between boundaries.
     *
     * @param int $left
     * @param int $right
     * 
     * @return array
     */
    public function fetchIntervals(int $left, int $right): array
    {
        DB::enableQueryLog();

        return $this->queryBus->ask(
            query: new GetIntervalsQuery(left: $left, right: $right)
        );
    }

    /**
     * Log query performance or cache info.
     *
     * @return string
     */
    public function logQueryPerformance(): string
    {
        $queries = DB::getQueryLog();

        if (!empty($queries)) {
            return 'Query executed in ' . $queries[0]['time'] . ' ms';
        }

        return 'Data retrieved from cache.';
    }
}
