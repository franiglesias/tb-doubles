<?php
declare (strict_types=1);

namespace App\Tests;

use App\Tests\Sample\AnonymousClassTest;
use App\Tests\Sample\NativeMockTest;
use App\Tests\Sample\OriginalClassTest;
use App\Tests\Sample\ProphecyMockTest;
use Example;
use PHPUnit\Framework\TestCase;

class SampleTest extends TimedTestCase
{
    protected function setUp(): void
    {
        $this->addTestCase(new ProphecyMockTest());
        $this->addTestCase(new AnonymousClassTest());
        $this->addTestCase(new NativeMockTest());
        $this->addTestCase(new OriginalClassTest());
    }
}
