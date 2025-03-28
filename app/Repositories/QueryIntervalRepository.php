<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Interface\RepositoryIntervalInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

final class QueryIntervalRepository implements RepositoryIntervalInterface
{
    /**
     * Retrieves Intervals That Overlap With The Specified Range.
     *
     * @param int $left
     * @param int $right
     *
     * @return array
     */
	public function get(int $left, int $right): array
    {
        $results = [];

        DB::table(
            table: 'intervals'
        )->select(
            columns: ['start', 'end']
        )->where(
            function (Builder $query) use ($left, $right): void {
                $query->whereBetween(
                    column: 'start',
                    values: [$left, $right]
                )->orWhereBetween(
                    column: 'end',
                    values: [$left, $right]
                )->orWhere(
                    function ($query) use ($left, $right) {
                        $query->where(
                            column: 'start',
                            operator: '<=',
                            value: $left
                        )->where(
                            column: 'end',
                            operator: '>=',
                            value: $right
                        );
                    }
                );
            }
        )->orderBy(
            column: 'start',
            direction: 'asc'
        )->chunk(
            count: 100,
            callback: function (Collection $intervals) use (&$results): void {
                foreach ($intervals as $interval) {
                    $results[] = (array) $interval;
                }
            }
        );

        return $results;
    }
}
