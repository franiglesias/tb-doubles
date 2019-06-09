<?php
declare (strict_types=1);

namespace App\Tests\Unit\SampleBehaviour;

use App\SampleBehaviour;
use PHPUnit\Framework\TestCase;

class NativeMockSampleBehaviourTest extends TestCase
{
    /** @var SampleBehaviour */
    private $sampleBehaviour;

    protected function setUp(): void
    {
        $this->sampleBehaviour = $this->createMock(SampleBehaviour::class);
    }

    public function test(): void
    {
        $this->sampleBehaviour->method('execute')->willReturn('sample data');
        $this->assertEquals('sample data', $this->sampleBehaviour->execute('data'));
    }
}
