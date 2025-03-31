<?php declare(strict_types=1);

namespace App\Contracts\Abstract;

use App\Contracts\Interface\IntervalRepositoryInterface;

abstract class IntervalRepositoryAbstract implements IntervalRepositoryInterface
{
    /**
     * Concrete repository instance for delegation.
     *
     * @phpstan-ignore-next-line
     */
    private IntervalRepositoryInterface $repository;

    /**
     * Initializes the repository with concrete implementation.
     */
    protected function __construct(IntervalRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
