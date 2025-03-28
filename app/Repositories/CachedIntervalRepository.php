<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Interface\RepositoryIntervalInterface;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

final class CachedIntervalRepository implements RepositoryIntervalInterface
{
	/**
     * Underlying Query Repository.
     *
     * @var QueryIntervalRepository
     */
    private readonly QueryIntervalRepository $intervalRepository;

    /**
     * Initialize The Repository.
     *
     * @param QueryIntervalRepository $intervalRepository
     */
    public function __construct(QueryIntervalRepository $intervalRepository)
    {
        $this->intervalRepository = $intervalRepository;
    }

    /**
     * Retrieve Interval Data From Cache Or Query Repository.
     *
     * @param int $left
     * @param int $right
     * 
     * @return array
     */
    public function get(int $left, int $right): array
    {
        $cacheKey = "intervals_{$left}_{$right}";

        return Cache::flexible(
            key: $cacheKey,
            ttl: [
                Carbon::now()->addMinutes(value: 5),
                Carbon::now()->addMinutes(value: 15)
            ],
            callback: function () use ($left, $right) {
                return $this->intervalRepository->get(left: $left, right: $right);
            }
        );
    }
}
