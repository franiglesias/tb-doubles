<?php
declare (strict_types=1);

namespace App\Tests\Unit\SampleBehaviour;

use App\SampleBehaviour;
use PHPUnit\Framework\TestCase;

class AnonymousSampleBehaviourTest extends TestCase
{
    /** @var SampleBehaviour */
    private $sampleBehaviour;

    protected function setUp(): void
    {
        $this->sampleBehaviour = new class ('sample') extends SampleBehaviour
        {
            public function execute(string $value): string
            {
                return 'sample data';
            }
        };
    }

    public function test(): void
    {
        $this->assertEquals('sample data', $this->sampleBehaviour->execute('data'));
    }
}
