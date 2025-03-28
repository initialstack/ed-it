<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Interface\RepositoryIntervalInterface;

final class IntervalRepository implements RepositoryIntervalInterface
{
    /**
     * In-Memory Repository For Caching Intervals.
     *
     * @var MemoryIntervalRepository
     */
    private MemoryIntervalRepository $memoryRepository;

    /**
     * Initializes The Interval Repository With A Cached Repository.
     *
     * @param CachedIntervalRepository $intervalRepository
     */
    public function __construct(
        private readonly CachedIntervalRepository $intervalRepository
    ) {
        $this->memoryRepository = new MemoryIntervalRepository();
    }

    /**
     * Retrieves Intervals Between The Specified Range.
     *
     * @param int $left
     * @param int $right
     *
     * @return array<int, mixed>
     */
    public function get(int $left, int $right): array
    {
        if (count(value: $this->memoryRepository->all()) > 0) {
            return $this->memoryRepository->all();
        }

        $intervals = $this->intervalRepository->get(left: $left, right: $right);

        foreach ($intervals as $interval) {
            $this->memoryRepository->save(interval: $interval);
        }

        return $this->memoryRepository->all();
    }
}
