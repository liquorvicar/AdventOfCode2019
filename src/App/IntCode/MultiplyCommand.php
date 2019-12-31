<?php

namespace AdventOfCode\App\IntCode;

class MultiplyCommand extends AddCommand
{
    public function run(Program $program): Program
    {
        $program->setMemory($this->target->get($program), $this->first->get($program) * $this->second->get($program));
        return $program;
    }
}