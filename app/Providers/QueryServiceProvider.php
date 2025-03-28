<?php declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Interface\QueryBusInterface;
use App\Queries\GetIntervalsQuery;
use App\Handlers\GetIntervalsQueryHandler;

final class QueryServiceProvider extends ServiceProvider
{
    /**
     * Mapping Of Queries To Their Handlers.
     * 
     * @var array<class-string, class-string>
     */
    private array $queries = [
        GetIntervalsQuery::class => GetIntervalsQueryHandler::class,
    ];

    /**
     * Bootstrap Any Application Services.
     */
    public function boot(QueryBusInterface $queryBus): void
    {
        $queryBus->register(map: $this->queries);
    }
}
