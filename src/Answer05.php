<?php

namespace AdventOfCode;

use AdventOfCode\App\IntCode;

class Answer05 extends Base
{
    public function one(array $input)
    {
        $elements = explode(',', $input[0]);
        $program = array_map(function ($element) {
            return (int)$element;
        }, $elements);
        $computer = new IntCode($this->logger);
        $computer->runProgram($program, [1]);
    }

    public function two(array $input)
    {
        // TODO: Implement two() method.
    }

}