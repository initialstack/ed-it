<?php declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Interface\RepositoryIntervalInterface;
use App\Repositories\IntervalRepository;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: RepositoryIntervalInterface::class,
            concrete: IntervalRepository::class
        );
    }
}
