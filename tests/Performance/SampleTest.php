<?php
declare (strict_types=1);

namespace App\Tests\Performance;

use App\Tests\Tools\TimedTestCase;
use App\Tests\Unit\Sample\AnonymousClassTest;
use App\Tests\Unit\Sample\NativeMockTest;
use App\Tests\Unit\Sample\OriginalClassTest;
use App\Tests\Unit\Sample\ProphecyMockTest;

class SampleTest extends TimedTestCase
{
    protected function setUp(): void
    {
        $this->addTest(new OriginalClassTest());
        $this->addTest(new AnonymousClassTest());
        $this->addTest(new ProphecyMockTest());
        $this->addTest(new NativeMockTest());

        $this->executeTimes(50);

        $this->setTitle('Test Doubles creation methods');
    }
}
