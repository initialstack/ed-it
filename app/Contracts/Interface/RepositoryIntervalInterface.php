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
     * @return array
     */
    public function get(int $left, int $right): array;
}
