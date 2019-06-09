<?php
declare (strict_types=1);

namespace App\Tests\Unit\SampleBehaviour;

use App\SampleBehaviour;
use PHPUnit\Framework\TestCase;

class ProphecyMockSampleBehaviourTest extends TestCase
{
    /** @var SampleBehaviour */
    private $sampleBehaviour;

    protected function setUp(): void
    {
        $sampleBehaviourProphet = $this->prophesize(SampleBehaviour::class);
        $sampleBehaviourProphet
            ->execute('data')->willReturn('sample data');
        $this->sampleBehaviour = $sampleBehaviourProphet->reveal();
    }

    public function test(): void
    {
        $this->assertEquals('sample data', $this->sampleBehaviour->execute('data'));
    }
}
