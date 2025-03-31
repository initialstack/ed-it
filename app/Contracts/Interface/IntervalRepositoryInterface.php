<?php declare(strict_types=1);

namespace App\Contracts\Interface;

interface IntervalRepositoryInterface
{
    /**
     * Retrieves data within a specified interval.
     *
     * @return array<array{start: int, end: int|null}>
     */
    public function get(int $left, int $right): array;
}
