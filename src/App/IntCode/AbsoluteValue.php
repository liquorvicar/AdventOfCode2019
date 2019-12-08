<?php

namespace AdventOfCode\App\IntCode;

class AbsoluteValue implements Value
{

    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function get(array $_program): int
    {
        return $this->value;
    }

}