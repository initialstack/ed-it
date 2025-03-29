<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Interface\MemoryRepositoryInterface;
use App\Models\Interval;

final class MemoryIntervalRepository implements MemoryRepositoryInterface
{
    /**
     * Collection of memory intervals.
     *
     * @var array<Interval>
     */
    private array $collection = [];

    /**
     * Retrieves all stored intervals from memory.
     *
     * @return array<Interval>
     */
    public function all(): array
    {
        return $this->collection;
    }

    /**
     * Save a new interval to memory storage.
     *
     * @param array<string, int|null> $interval
     */
    public function save(array $interval): void
    {
        $intervalModel = new Interval(attributes: $interval);
        $this->collection[] = $intervalModel;
    }
}
