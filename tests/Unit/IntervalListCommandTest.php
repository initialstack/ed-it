<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Console\Commands\IntervalListCommand;
use App\Services\IntervalService;
use Mockery\MockInterface;
use Illuminate\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

final class IntervalListCommandTest extends TestCase
{
    private IntervalService|MockInterface $intervalServiceMock;
    private IntervalListCommand $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->intervalServiceMock = \Mockery::mock(IntervalService::class);

        $this->command = new IntervalListCommand($this->intervalServiceMock);

        $application = new ConsoleApplication(
            $this->app,
            $this->app->make('events'),
            $this->app->version()
        );

        $application->add($this->command);

        $this->command->setApplication($application);
    }

    public function test_handle_fails_when_left_boundary_is_greater_than_right(): void
    {
        $this->intervalServiceMock->shouldReceive('validateBoundaries')
            ->with(10, 5)
            ->once()
            ->andReturn(true);

        $input = new ArrayInput([
            '--left' => '10',
            '--right' => '5',
        ]);

        $output = new BufferedOutput();

        $result = $this->command->run($input, $output);

        $this->assertEquals(1, $result);

        $this->assertStringContainsString(
            'The left boundary must be less than or equal to the right.',
            $output->fetch()
        );
    }

    public function test_handle_successfully_fetches_and_displays_intervals(): void
    {
        $this->intervalServiceMock->shouldReceive('validateBoundaries')
            ->with(5, 10)
            ->once()
            ->andReturn(false);

        $this->intervalServiceMock->shouldReceive('fetchIntervals')
            ->with(5, 10)
            ->once()
            ->andReturn([
                ['Start' => 5, 'End' => 7],
                ['Start' => 8, 'End' => 10],
            ]);

        $this->intervalServiceMock->shouldReceive('logQueryPerformance')
            ->once()
            ->andReturn('Query executed in 0.01 seconds');

        $input = new ArrayInput([
            '--left' => '5',
            '--right' => '10',
        ]);

        $output = new BufferedOutput();

        $result = $this->command->run($input, $output);

        $this->assertEquals(0, $result);
        
        $outputContent = $output->fetch();

        $this->assertStringContainsString('Query executed in 0.01 seconds', $outputContent);
        $this->assertStringContainsString('Start', $outputContent);
        $this->assertStringContainsString('End', $outputContent);
        $this->assertStringContainsString('5', $outputContent);
        $this->assertStringContainsString('7', $outputContent);
        $this->assertStringContainsString('8', $outputContent);
        $this->assertStringContainsString('10', $outputContent);
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
}