<?php
declare (strict_types=1);

namespace App\Tests\Unit\Sample;

use App\Sample;
use PHPUnit\Framework\TestCase;

class OriginalClassTest extends TestCase
{
    /** @var Sample */
    private $sample;

    protected function setUp(): void
    {
        $this->sample = new Sample('sample data');
    }

    public function testProphecyMockTest(): void
    {
        $this->assertEquals('sample data', $this->sample->data());
    }
}
