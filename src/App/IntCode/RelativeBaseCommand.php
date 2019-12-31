<?php

namespace AdventOfCode\App\IntCode;

class RelativeBaseCommand implements Command
{
    private $value;

    public function __construct(ValueRetriever $valueRetriever, Program $program, $position, $mode)
    {
        $this->value = $valueRetriever->retrieve($program, $position + 1, $mode);
    }

    public function run(Program $program): Program
    {
        $program->adjustRelativeBase($this->value->get($program));
        return $program;
    }

    public function nextCommand(int $position): int
    {
        return $position + 2;
    }

    public function isTerminated(): bool
    {
        return false;
    }
}