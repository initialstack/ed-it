<?php declare(strict_types=1);

namespace App\Contracts\Interface;

use App\Models\Interval;

interface MemoryRepositoryInterface
{
    /**
     * Retrieves all stored intervals from memory.
     *
     * @return array<Interval>
     */
    public function all(): array;

    /**
     * Saves a new interval to memory storage.
     *
     * @param array<string, int|null> $interval
     */
    public function save(array $interval): void;
}
