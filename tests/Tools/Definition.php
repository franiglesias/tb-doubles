<?php
declare (strict_types=1);

namespace App\Tests\Tools;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

class Definition
{
    /** @var TestCase */
    private $testCase;
    /** @var string */
    private $method;

    public function __construct(TestCase $testCase, string $method)
    {
        $this->testCase = $testCase;
        $this->testCase->setName($method);
        $this->method = $method;
    }

    public function testCase(): TestCase
    {
        return $this->testCase;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function name(): string
    {
        return sprintf('%s::%s', $this->testCaseName(), $this->method);
    }

    public function run(): TestResult
    {
        return $this->testCase()->run();
    }

    private function testCaseName(): string
    {
        $testCaseName = get_class($this->testCase);
        $path = explode('\\', $testCaseName);

        return array_pop($path);
    }
}
