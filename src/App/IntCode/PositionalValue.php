<?php

namespace AdventOfCode\App\IntCode;

class PositionalValue implements Value
{
    /**
     * @var int
     */
    private $position;

    public function __construct(int $position)
    {
        $this->position = $position;
    }

    public function get(Program $program): int
    {
        return $program->getMemory($this->position) ?? 0;
    }
}
