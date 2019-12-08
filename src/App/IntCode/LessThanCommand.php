<?php

namespace AdventOfCode\App\IntCode;

class LessThanCommand extends AddCommand
{
    public function run(array $program): array
    {
        if ($this->first->get($program) < $this->second->get($program)) {
            $program[$this->target->get($program)] = 1;
        } else {
            $program[$this->target->get($program)] = 0;
        }
        return $program;
    }
}