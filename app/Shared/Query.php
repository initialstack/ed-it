<?php declare(strict_types=1);

namespace App\Shared;

abstract class Query
{
    /**
     * Get the minimum value.
     * 
     * @return int
     */
    abstract protected function getLeft(): int;

    /**
     * Get the maximum value.
     * 
     * @return int
     */
    abstract protected function getRight(): int;
}
