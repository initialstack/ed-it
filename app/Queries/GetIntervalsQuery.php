<?php declare(strict_types=1);

namespace App\Queries;

use App\Shared\Query;

final class GetIntervalsQuery extends Query
{
    /**
     * The minimum and maximum value of the interval.
     */
    public function __construct(
        private readonly int $left,
        private readonly int $right,
    ) {}

    /**
     * Gets the minimum value of the interval.
     */
    public function getLeft(): int
    {
        return $this->left;
    }

    /**
     * Gets the maximum value of the interval.
     */
    public function getRight(): int
    {
        return $this->right;
    }
}
