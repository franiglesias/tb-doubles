<?php
declare (strict_types=1);

namespace App\Tests\Unit\Sample;

use App\Sample;
use PHPUnit\Framework\TestCase;

class ProphecyMockTest extends TestCase
{
    /** @var Sample */
    private $sample;

    protected function setUp(): void
    {
        $sampleProphet = $this
            ->prophesize(Sample::class)
            ->data()->willReturn('sample data');

        $this->sample = $sampleProphet->reveal();
    }

    public function testProphecyMockTest(): void
    {
        $this->assertEquals('sample data', $this->sample->data());
    }
}
