<?php
declare (strict_types=1);

namespace App;

class SampleBehaviour
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function execute(string $value): string
    {
        sleep(1);

        return sprintf('%s %s', $this->value, $value);
    }
}
