<?php declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\Interface\RepositoryIntervalInterface;
use App\Queries\GetIntervalsQuery;
use App\Shared\Handler;

final class GetIntervalsQueryHandler extends Handler
{
    /**
     * The interval repository instance.
     */
    private readonly RepositoryIntervalInterface $intervalRepository;

    /**
     * Constructs the GetIntervalsQueryHandler.
     */
    public function __construct(RepositoryIntervalInterface $intervalRepository)
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
