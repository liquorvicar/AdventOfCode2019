<?php

namespace AdventOfCode\App\IntCode;

class JumpFalseCommand extends JumpTrueCommand
{
    public function run(array $program): array
    {
        if ($this->comparator->get($program) === 0) {
            $this->next = $this->target->get($program);
        }
        return $program;
    }

}