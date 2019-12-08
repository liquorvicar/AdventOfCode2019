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

    public function get(array $program): int
    {
        return $program[$this->position] ?? 0;
    }
}
