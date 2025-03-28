<?php declare(strict_types=1);

namespace App\Handlers;

use App\Shared\Handler;
use App\Contracts\Interface\RepositoryIntervalInterface;
use App\Queries\GetIntervalsQuery;

final class GetIntervalsQueryHandler extends Handler
{
    /**
     * The interval repository instance.
     * 
     * @var RepositoryIntervalInterface
     */
    private readonly RepositoryIntervalInterface $intervalRepository;

    /**
     * Constructs the GetIntervalsQueryHandler.
     *
     * @param RepositoryIntervalInterface $intervalRepository
     */
    public function __construct(RepositoryIntervalInterface $intervalRepository)
    {
        $this->intervalRepository = $intervalRepository;
    }

    /**
     * Handles the GetIntervalsQuery.
     * 
     * @param GetIntervalsQuery $query
     * 
     * @return array
     */
    public function handle(GetIntervalsQuery $query): array
    {
        return $this->intervalRepository->get(
            left: $query->getLeft(),
            right: $query->getRight()
        );
    }
}
