<?php declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\IntervalService;

final class IntervalListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'intervals:list {--left= : Left boundary} {--right= : Right boundary}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays a list of intervals within the specified boundaries';

    /**
     * Interval Service For Handling Interval Operations.
     *
     * @var IntervalService
     */
    private readonly IntervalService $interval;

    /**
     * Initialize The Command With An Interval Service.
     *
     * @param IntervalService $interval
     */
    public function __construct(IntervalService $interval)
    {
        $this->interval = $interval;

        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $left = $this->option(key: 'left');
        $right = $this->option(key: 'right');

        if ($left === null || $right === null) {
            $this->error(string: 'Both left and right boundaries must be provided.');

            return 1;
        }

        if (!is_numeric(value: $left) || !is_numeric(value: $right)) {
            $this->error(string: 'Both left and right boundaries must be numeric.');

            return 1;
        }

        $left = (int) $left;
        $right = (int) $right;

        if ($this->interval->validateBoundaries(left: $left, right: $right)) {
            $this->error(string: 'The left boundary must be less than or equal to the right.');

            return 1;
        }

        $rows = $this->interval->fetchIntervals(left: $left, right: $right);

        $this->info(string: $this->interval->logQueryPerformance());
        $this->newLine();
        $this->table(headers: ['Start', 'End'], rows: $rows);

        return 0;
    }
}
