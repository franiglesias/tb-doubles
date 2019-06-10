<?php
declare (strict_types=1);

namespace App\Tests\Tools;

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

    public static function fromDefinitionTimeAndMemoryInBytes(Definition $test, float $time, int $memoryInBytes): Result
    {
        return new static($test->name(), $time, $memoryInBytes / 1024);
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
