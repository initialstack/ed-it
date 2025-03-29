<?php declare(strict_types=1);

namespace App\Contracts\Abstract;

use App\Contracts\Interface\RepositoryIntervalInterface;

abstract class IntervalRepositoryAbstract implements RepositoryIntervalInterface
{
    /**
     * Concrete repository instance for delegation.
     *
     * @phpstan-ignore-next-line
     */
    private RepositoryIntervalInterface $repository;

    /**
     * Initializes the repository with concrete implementation.
     */
    protected function __construct(RepositoryIntervalInterface $repository)
    {
        $this->repository = $repository;
    }
}
