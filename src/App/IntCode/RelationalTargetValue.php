<?php

namespace AdventOfCode\App\IntCode;

class RelationalTargetValue implements Value
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function get(Program $program): int
    {
        return $this->value + $program->getRelativeBase();
    }
}