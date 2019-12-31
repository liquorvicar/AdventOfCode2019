<?php

namespace AdventOfCode\App\IntCode;

class TerminateCommand implements Command
{
    public function run(Program $program): Program
    {
        return $program;
    }

    public function nextCommand(int $position): int
    {
        return $position + 4;
    }

    public function isTerminated(): bool
    {
        return true;
    }
}