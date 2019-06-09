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
            ->prophesize(Sample::class);
        $sampleProphet->data()->willReturn('sample data');

        $this->sample = $sampleProphet->reveal();
    }

    public function test(): void
    {
        $this->assertEquals('sample data', $this->sample->data());
    }
}
