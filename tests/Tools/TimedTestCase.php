<?php
declare (strict_types=1);

namespace App\Tests\Tools;

use PHPUnit\Framework\TestCase;

abstract class TimedTestCase extends TestCase
{
    private const REPORT_FORMAT = ' %-25s %8.4f %12.2f';
    private const REPORT_HEADER_FORMAT = ' %-25s %8s %12s';
    protected $iterations = 500;
    protected $testCases;
    protected $results = [];
    protected $title = 'Comparative test performance and consumption';

    protected function addTestCase(TestCase $testCase): void
    {
        $this->testCases[] = $testCase;
    }

    protected function executeTimes(int $iterations): void
    {
        $this->iterations = $iterations;
    }

    protected function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function testPerformance(): void
    {
        /** @var TestCase $testCase */
        foreach ($this->testCases as $testCase) {
            $this->results[] = $this->executeAndGetResult($testCase);
        }
        $this->printSortedResults();

        $this->assertTrue(true);
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
        print PHP_EOL;
        print $this->title;
        print(PHP_EOL . str_pad('', strlen($this->title), '=') . PHP_EOL);
        print PHP_EOL;
        $header = sprintf(self::REPORT_HEADER_FORMAT . PHP_EOL, 'Method', 'Time (s)', 'Memory (KB)');
        print $header;
        print(str_pad('', strlen($header), '-') . PHP_EOL);

        /** @var Result $result */
        foreach ($this->results as $result) {
            printf(self::REPORT_FORMAT . PHP_EOL, $result->name(), $result->time(), $result->memory());
        }
    }

    private function executeAndGetResult(TestCase $testCase)
    {
        $time = 0;
        $memoryAtStart = memory_get_usage();
        for ($iteration = 0; $iteration < $this->iterations; $iteration++) {
            $testCaseResult = $testCase->run();
            $time += $testCaseResult->time();
        }
        $memoryUsed = memory_get_usage() - $memoryAtStart;

        return Result::fromTestCaseTimeAndMemoryInBytes($testCase, $time, $memoryUsed);
    }
}

