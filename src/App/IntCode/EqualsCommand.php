<?php

namespace AdventOfCode\App\IntCode;

class EqualsCommand extends LessThanCommand
{
    public function run(Program $program): Program
    {
        if ($this->first->get($program) === $this->second->get($program)) {
            $program->setMemory($this->target->get($program), 1);
        } else {
            $program->setMemory($this->target->get($program), 0);
        }
        return $program;
    }
}