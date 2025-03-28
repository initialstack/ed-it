<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Interface\MemoryRepositoryInterface;

final class MemoryIntervalRepository implements MemoryRepositoryInterface
{
    /**
     * Collection of memory intervals.
     *
     * @var array
     */
    private array $collection;

    /**
     * Initialize with intervals.
     *
     * @param array $intervals
     */
    public function __construct(array $intervals = [])
    {
        $this->collection = $intervals;
    }

    /**
     * Get all intervals.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->collection;
    }

    /**
     * Save a new interval.
     *
     * @param array $interval
     * @return void
     */
    public function save(array $interval): void
    {
        $this->collection[] = $interval;
    }
}
