<?php

namespace AdventOfCode;


use AdventOfCode\App\IntCode;

class Answer02 extends Base
{

    public function one(Array $input) {
        $elements = explode(',', $input[0]);
        $program = array_map(function ($element) {
            return (int)$element;
        }, $elements);
        $program[1] = 12;
        $program[2] = 2;
        $computer = new IntCode($this->logger);
        return $computer->runProgram($program);
    }

    public function two(Array $input) {
        $elements = explode(',', $input[0]);
        $program = array_map(function ($element) {
            return (int)$element;
        }, $elements);
        $computer = new IntCode($this->logger);
        for ($noun = 0; $noun <= 100; $noun++) {
            for ($verb = 0; $verb <= 100; $verb++) {
                $iteration = $program;
                $iteration[1] = $noun;
                $iteration[2] = $verb;
                $result = $computer->runProgram($iteration);
                if ($result === 19690720) {
                    return 100 * $noun + $verb;
                }
            }
        }
    }
}