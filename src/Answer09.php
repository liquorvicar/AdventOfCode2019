<?php

namespace AdventOfCode;

use AdventOfCode\App\IntCode\PausableComputer;

class Answer09 extends Base
{
    public function one(array $program)
    {
        return $this->runWithInput($program, 1);
    }

    public function two(array $program)
    {
        return $this->runWithInput($program, 2);
    }

    /**
     * @param array $program
     * @return mixed
     */
    protected function runWithInput(array $program, $input): int
    {
        $program = array_map(function ($element) {
            return (int)$element;
        }, explode(',', $program[0]));
        $computer = new PausableComputer($this->logger, 'Day9', $program);
        $computer->addInput($input);
        $outputs = $computer->runToTermination();
        foreach ($outputs as $output) {
            $this->logger->info('Output: ', ['output' => $output]);
        }
        return $outputs[0];
    }
}