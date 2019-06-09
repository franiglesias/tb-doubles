<?php
declare (strict_types=1);

namespace App;

class Sample
{
    /** @var string */
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function data(): string
    {
        return $this->data;
    }

}
