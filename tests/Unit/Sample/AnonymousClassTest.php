<?php
declare (strict_types=1);

namespace App\Tests\Sample;

use App\Sample;
use PHPUnit\Framework\TestCase;

class AnonymousClassTest extends TestCase
{
    /** @var Sample */
    private $sample;

    protected function setUp(): void
    {
        $this->sample = new class('sample data') extends Sample
        {
        };
    }

    public function testProphecyMockTest(): void
    {
        $this->assertEquals('sample data', $this->sample->data());
    }
}
