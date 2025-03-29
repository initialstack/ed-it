<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Interface\RepositoryIntervalInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

final class CachedIntervalRepository implements RepositoryIntervalInterface
{
    /**
     * Underlying Query Repository.
     */
    private readonly QueryIntervalRepository $intervalRepository;

    /**
     * Initialize The Repository.
     */
    public function __construct(QueryIntervalRepository $intervalRepository)
    {
        $this->intervalRepository = $intervalRepository;
    }

    /**
     * Retrieve Interval Data From Cache Or Query Repository.
     *
     * @return array<int, mixed>
     */
    public function get(int $left, int $right): array
    {
        $cacheKey = "intervals_{$left}_{$right}";

        return Cache::flexible(
            key: $cacheKey,
            ttl: [
                Carbon::now()->addMinutes(value: 5),
                Carbon::now()->addMinutes(value: 15),
            ],
            callback: function () use ($left, $right) {
                return $this->intervalRepository->get(left: $left, right: $right);
            }
        );
    }
}
