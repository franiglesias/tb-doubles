<?php
declare (strict_types=1);

namespace App\Tests\Tools;

use PHPUnit\Framework\TestCase;

abstract class TimedTestCase extends TestCase
{
    private const REPORT_FORMAT = ' %\'.-35s %8.4f %12.2f';
    private const REPORT_HEADER_FORMAT = ' %-35s %8s %12s';
    private const TITLE_FORMAT = '%s (%s times)';

    protected $tests;
    protected $executeTimes = 50;
    protected $results = [];
    protected $title = 'Comparative test performance and consumption';

    protected function addTest(TestCase $testCase, string $testMethod = 'test'): void
    {
        $this->tests[] = new Definition($testCase, $testMethod);
    }

    protected function executeTimes(int $iterations): void
    {
        $this->executeTimes = $iterations;
    }

    protected function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function testPerformance(): void
    {
        $this->tests[0]->purgue();
        /** @var Definition $test */
        foreach ($this->tests as $test) {
            $this->results[] = $this->executeAndGetResult($test);
        }
        $this->printSortedResults();

        $this->assertTrue(true);
    }

    private function executeAndGetResult(Definition $test): Result
    {
        $time = 0;
        $memoryUsedInBytes = 0;
        for ($iteration = 0; $iteration < $this->executeTimes; $iteration++) {
            $memoryAtStart = memory_get_usage();
            $testCaseResult = $test->run();
            $time += $testCaseResult->time();
            $memoryUsedInBytes += memory_get_usage() - $memoryAtStart;
        }

        return Result::fromDefinitionTimeAndMemoryInBytes($test, $time, $memoryUsedInBytes);
    }

    private function printSortedResults(): void
    {
        usort(
            $this->results,
            static function (Result $method, Result $otherMethod) {
                return $method->time() <=> $otherMethod->time();
            }
        );
        $this->printResults();
    }

    private function printResults(): void
    {
        $this->printHeader(sprintf(self::TITLE_FORMAT, $this->title, $this->executeTimes), '=');
        $this->printHeader(sprintf(self::REPORT_HEADER_FORMAT . PHP_EOL, 'Method', 'Time (s)', 'Memory (KB)'));

        /** @var Result $result */
        foreach ($this->results as $result) {
            printf(self::REPORT_FORMAT . PHP_EOL, $result->name(), $result->time(), $result->memory());
        }
    }

    private function printHeader(string $header, string $line = '-'): void
    {
        print PHP_EOL . $header;
        print(PHP_EOL . str_pad('', strlen($header), $line) . PHP_EOL);
    }
}
