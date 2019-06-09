<?php
declare (strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

abstract class TimedTestCase extends TestCase
{
    private const REPORT_FORMAT = ' %-25s %8.4f %10.2f';
    private const REPORT_HEADER_FORMAT = ' %-25s %8s %10s';
    protected const ITERATIONS = 500;
    protected $testCases;
    protected $results = [];

    protected function addTestCase(TestCase $testCase): void
    {
        $this->testCases[] = $testCase;
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
        $header = sprintf(self::REPORT_HEADER_FORMAT . PHP_EOL, 'Method', 'Time(s)', 'Memory(KB)');
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
        for ($iteration = 0; $iteration < static::ITERATIONS; $iteration++) {
            $testCaseResult = $testCase->run();
            $time += $testCaseResult->time();
        }
        $memoryUsed = memory_get_usage() - $memoryAtStart;

        return Result::fromTestCaseTimeAndMemoryInBytes($testCase, $time, $memoryUsed);
    }
}

