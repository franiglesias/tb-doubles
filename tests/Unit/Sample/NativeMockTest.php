<?php
declare (strict_types=1);

namespace App\Tests\Unit\Sample;

use App\Sample;
use PHPUnit\Framework\TestCase;

class NativeMockTest extends TestCase
{
    /** @var Sample */
    private $sample;

    protected function setUp(): void
    {
        $this->sample = $this->createMock(Sample::class);
        $this->sample->method('data')->willReturn('sample data');
    }

    public function test(): void
    {
        $this->assertEquals('sample data', $this->sample->data());
    }

}
