<?php declare(strict_types=1);

namespace App\Buses;

use App\Contracts\Interface\QueryBusInterface;
use Illuminate\Bus\Dispatcher;
use App\Shared\Query;

final class QueryBus implements QueryBusInterface
{
    /**
     * Query Bus Dispatcher instance.
     *
     * @var Dispatcher
     */
    private Dispatcher $queryBus;

    /**
     * Constructor to initialize Query Bus.
     *
     * @param Dispatcher $queryBus
     */
    public function __construct(Dispatcher $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * Dispatches a query and returns the result.
     *
     * @param Query $query
     * 
     * @return mixed
     */
    public function ask(Query $query): mixed
    {
        return $this->queryBus->dispatch(command: $query);
    }

    /**
     * Registers command handlers for the Query Bus.
     *
     * @param array $map
     * 
     * @return void
     */
    public function register(array $map): void
    {
        $this->queryBus->map(map: $map);
    }
}
