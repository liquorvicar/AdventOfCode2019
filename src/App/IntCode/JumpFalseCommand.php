<?php

namespace AdventOfCode\App\IntCode;

class JumpFalseCommand extends JumpTrueCommand
{
    public function run(Program $program): Program
    {
        if ($this->comparator->get($program) === 0) {
            $this->next = $this->target->get($program);
        }
        return $program;
    }

}