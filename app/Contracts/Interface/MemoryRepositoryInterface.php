<?php declare(strict_types=1);

namespace App\Contracts\Interface;

interface MemoryRepositoryInterface
{
	/**
     * Retrieves all stored intervals from memory.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Saves a new interval to memory storage.
     *
     * @param array $interval Interval data to persist
     */
    public function save(array $interval): void;
}
