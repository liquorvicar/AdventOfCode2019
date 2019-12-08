<?php

namespace AdventOfCode\App\IntCode;

class MultiplyCommand extends AddCommand
{
    public function run(array $program): array
    {
        $program[$this->target->get($program)] = $this->first->get($program) * $this->second->get($program);
        return $program;
    }
}