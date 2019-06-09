<?php
declare (strict_types=1);

namespace App\Tests\Performance;

use App\Tests\Tools\TimedTestCase;
use App\Tests\Unit\SampleBehaviour\AnonymousSampleBehaviourTest;
use App\Tests\Unit\SampleBehaviour\NativeMockSampleBehaviourTest;
use App\Tests\Unit\SampleBehaviour\OriginalSampleBehaviourTest;
use App\Tests\Unit\SampleBehaviour\ProphecyMockSampleBehaviourTest;

class SampleBehaviourTest extends TimedTestCase
{
    protected function setUp(): void
    {
        $this->addTestCase(new AnonymousSampleBehaviourTest());
        $this->addTestCase(new NativeMockSampleBehaviourTest());
        $this->addTestCase(new OriginalSampleBehaviourTest());
        $this->addTestCase(new ProphecyMockSampleBehaviourTest());

        $this->executeTimes(50);

        $this->setTitle('Test Doubles with behaviour creation methods');
    }
}
