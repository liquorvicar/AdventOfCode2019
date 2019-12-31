<?php

namespace AdventOfCode\App\IntCode;

class RelationalValue implements Value
{
    /**
     * @var int
     */
    private $position;

    public function __construct($value, $base)
    {
        $this->position = $value + $base;
    }

    public function get(Program $program): int
    {
        return $program->getMemory($this->position) ?? 0;
    }
}