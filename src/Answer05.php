<?php

namespace AdventOfCode;

use AdventOfCode\App\IntCode\Computer;

class Answer05 extends Base
{
    public function one(array $input)
    {
        $elements = explode(',', $input[0]);
        $program = array_map(function ($element) {
            return (int)$element;
        }, $elements);
        $computer = new Computer($this->logger, [1]);
        $computer->runProgram($program);
        foreach ($computer->getOutputs() as $output) {
            $this->logger->info('Output value', ['output' => $output]);
        }
    }

    public function two(array $input)
    {
        $elements = explode(',', $input[0]);
        $program = array_map(function ($element) {
            return (int)$element;
        }, $elements);
        $computer = new Computer($this->logger, [5]);
        $computer->runProgram($program);
        foreach ($computer->getOutputs() as $output) {
            $this->logger->info('Output value', ['output' => $output]);
        }
    }

}