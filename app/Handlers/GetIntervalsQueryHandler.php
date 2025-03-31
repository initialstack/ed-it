<?php declare(strict_types=1);

namespace App\Handlers;

use App\Shared\Handler;
use App\Contracts\Interface\IntervalRepositoryInterface;
use App\Queries\GetIntervalsQuery;

final class GetIntervalsQueryHandler extends Handler
{
    /**
     * The interval repository instance.
     */
    private readonly IntervalRepositoryInterface $intervalRepository;

    /**
     * Constructs the GetIntervalsQueryHandler.
     */
    public function __construct(IntervalRepositoryInterface $intervalRepository)
    {
        $this->intervalRepository = $intervalRepository;
    }

    /**
     * Handles the GetIntervalsQuery.
     *
     * @return array<array{start: int, end: int|null}>
     */
    public function handle(GetIntervalsQuery $query): array
    {
        return $this->intervalRepository->get(
            left: $query->getLeft(),
            right: $query->getRight()
        );
    }
}
