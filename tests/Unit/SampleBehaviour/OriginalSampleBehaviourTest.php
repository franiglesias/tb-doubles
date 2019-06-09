<?php
declare (strict_types=1);

namespace App\Tests\Unit\SampleBehaviour;

use App\SampleBehaviour;
use PHPUnit\Framework\TestCase;

class OriginalSampleBehaviourTest extends TestCase
{
    /** @var SampleBehaviour */
    private $sampleBehaviour;

    protected function setUp(): void
    {
        $this->sampleBehaviour = new SampleBehaviour('sample');
    }

    public function test(): void
    {
        $this->assertEquals('sample data', $this->sampleBehaviour->execute('data'));
    }
}
