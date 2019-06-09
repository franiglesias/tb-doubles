<?php
declare (strict_types=1);

namespace App\Tests\Tools;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

class Result
{
    private $name;
    private $time;
    private $memory;

    public function __construct(string $name, float $time, float $memory)
    {
        $this->name = $name;
        $this->time = $time;
        $this->memory = $memory;
    }

    public static function fromTestCaseAndResult(TestCase $testCase, TestResult $testResult): Result
    {
        $className = self::className($testCase);

        return new static($className, $testResult->time(), 0);
    }

    public static function fromTestCaseTimeAndMemoryInBytes(TestCase $testCase, float $time, int $memoryInBytes): Result
    {
        $className = self::className($testCase);

        return new static($className, $time, $memoryInBytes / 1024);
    }

    private static function className(TestCase $testCase): string
    {
        $testCaseName = get_class($testCase);
        $path = explode('\\', $testCaseName);
        $className = array_pop($path);

        return $className;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function time(): float
    {
        return $this->time;
    }

    public function memory(): float
    {
        return $this->memory;
    }

}
