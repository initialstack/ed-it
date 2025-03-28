<?php declare(strict_types=1);

namespace App\Contracts\Abstract;

use App\Contracts\Interface\RepositoryIntervalInterface;

abstract class IntervalRepositoryAbstract implements RepositoryIntervalInterface
{
	/**
     * Concrete repository instance for delegation.
     *
     * @var RepositoryIntervalInterface
     */
    private readonly RepositoryIntervalInterface $repository;

    /**
     * Initializes the repository with concrete implementation.
     *
     * @param RepositoryIntervalInterface $repository
     */
    protected function __construct(RepositoryIntervalInterface $repository)
    {
        $this->repository = $repository;
    }
}
