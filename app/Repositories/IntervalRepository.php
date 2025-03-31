<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Interface\IntervalRepositoryInterface;
use App\Models\Interval;

final class IntervalRepository implements IntervalRepositoryInterface
{
    /**
     * In-Memory Repository For Caching Intervals.
     */
    private MemoryIntervalRepository $memoryRepository;

    /**
     * Initializes The Interval Repository With A Cached Repository.
     */
    public function __construct(
        private readonly CachedIntervalRepository $intervalRepository
    ) {
        $this->memoryRepository = new MemoryIntervalRepository();
    }

    /**
     * Retrieves Intervals Between The Specified Range.
     *
     * @return array<array{start: int, end: int|null}>
     */
    public function get(int $left, int $right): array
    {
        if (count(value: $this->memoryRepository->all()) > 0) {
            return $this->transformIntervalsToArray(
                intervals: $this->memoryRepository->all()
            );
        }

        $intervals = $this->intervalRepository->get(left: $left, right: $right);

        foreach ($intervals as $interval) {
            $this->memoryRepository->save(interval: $interval);
        }

        return $this->transformIntervalsToArray(
            intervals: $this->memoryRepository->all()
        );
    }

    /**
     * Transforms an array of Interval objects into the expected array structure.
     *
     * @param array<Interval> $intervals
     *
     * @return array<array{start: int, end: int|null}>
     */
    private function transformIntervalsToArray(array $intervals): array
    {
        return array_map(
            callback: fn(Interval $interval): array
                => ['start' => $interval->start, 'end' => $interval->end],
            array: $intervals
        );
    }
}
