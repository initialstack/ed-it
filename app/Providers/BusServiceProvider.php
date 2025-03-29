<?php declare(strict_types=1);

namespace App\Providers;

use App\Buses\QueryBus;
use App\Contracts\Interface\QueryBusInterface;
use Illuminate\Support\ServiceProvider;

final class BusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: QueryBusInterface::class,
            concrete: QueryBus::class
        );
    }
}
