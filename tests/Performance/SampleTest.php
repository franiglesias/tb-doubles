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
        $this->addTestCase(new ProphecyMockTest());
        $this->addTestCase(new AnonymousClassTest());
        $this->addTestCase(new NativeMockTest());
        $this->addTestCase(new OriginalClassTest());

        $this->executeTimes(250);

        $this->setTitle('Test Doubles creation methods');
    }
}
