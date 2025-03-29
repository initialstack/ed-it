<?php declare(strict_types=1);

namespace App\Buses;

use App\Contracts\Interface\QueryBusInterface;
use App\Shared\Query;
use Illuminate\Bus\Dispatcher;

final class QueryBus implements QueryBusInterface
{
    /**
     * Query Bus Dispatcher instance.
     */
    private Dispatcher $queryBus;

    /**
     * Constructor to initialize Query Bus.
     */
    public function __construct(Dispatcher $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * Dispatches a query and returns the result.
     */
    public function ask(Query $query): mixed
    {
        return $this->queryBus->dispatch(command: $query);
    }

    /**
     * Registers command handlers for the Query Bus.
     *
     * @param array<string> $map
     */
    public function register(array $map): void
    {
        $this->queryBus->map(map: $map);
    }
}
