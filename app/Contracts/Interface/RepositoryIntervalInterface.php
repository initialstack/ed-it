<?php declare(strict_types=1);

namespace App\Contracts\Interface;

interface RepositoryIntervalInterface
{
	/**
     * Retrieves data within a specified interval.
     *
     * @param int $left
     * @param int $right
     *
     * @return array<int, mixed>
     */
    public function get(int $left, int $right): array;
}
