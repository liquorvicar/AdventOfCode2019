<?php

namespace AdventOfCode;

use Psr\Log\LoggerInterface;

class Answer02
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function one(Array $input) {
        $elements = explode(',', $input[0]);
        $program = array_map(function ($element) {
            return (int)$element;
        }, $elements);
        $program[1] = 12;
        $program[2] = 2;
        return $this->runProgram($program);
    }

    private function findValue($program, $position)
    {
        if (!isset($program[$position])) {
            return 0;
        }
        if (!isset($program[$program[$position]])) {
            return 0;
        }
        return $program[$program[$position]];
    }

    public function two(Array $input) {
        $elements = explode(',', $input[0]);
        $program = array_map(function ($element) {
            return (int)$element;
        }, $elements);
        for ($noun = 0; $noun <= 100; $noun++) {
            for ($verb = 0; $verb <= 100; $verb++) {
                $iteration = $program;
                $iteration[1] = $noun;
                $iteration[2] = $verb;
                $result = $this->runProgram($iteration);
                if ($result === 19690720) {
                    return 100 * $noun + $verb;
                }
            }
        }
    }

    public function runProgram(array $program)
    {
        $position = 0;
        $finished = false;
        while (!$finished) {
            $command = $program[$position] ?? 0;
            $first = $this->findValue($program, $position + 1);
            $second = $this->findValue($program, $position + 2);
            $target = isset($program[$position + 3]) ? $program[$position + 3] : 0;
            switch ($command) {
                case 1:
                    $program[$target] = $first + $second;
                    break;
                case 2:
                    $program[$target] = $first * $second;
                    break;
                case 99:
                    $finished = true;
                    break;
            }
            $position += 4;
        }
        return $program[0];
    }
}