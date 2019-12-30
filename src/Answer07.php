<?php

namespace AdventOfCode;

use AdventOfCode\App\IntCode\Computer;
use AdventOfCode\App\IntCode\PausableComputer;

class Answer07 extends Base
{
    public function one(array $program)
    {
        $program = array_map(function ($element) {
            return (int)$element;
        }, explode(',', $program[0]));
        return $this->runAmplifier(['A', 'B', 'C', 'D', 'E'], [0, 1, 2, 3, 4], $program, 0);
    }

    public function two(array $program)
    {
        $program = array_map(function ($element) {
            return (int)$element;
        }, explode(',', $program[0]));
        return $this->runLoopedAmplifier(['A', 'B', 'C', 'D', 'E'], [], [5, 6, 7, 8, 9], $program);
    }

    private function runAmplifier(array $amplifiers, array $phases, array $program, int $input)
    {
        if (count($amplifiers) === 1) {
            $computer = new Computer($this->logger, [$phases[0], $input]);
            $computer->runProgram($program);
            $outputs = $computer->getOutputs();
            return $outputs[0];
        }
        $amplifier = array_shift($amplifiers);
        $max = 0;
        for ($i = 0; $i < count($phases); $i++) {
            $phase = array_shift($phases);
            $computer = new Computer($this->logger, [$phase, $input]);
            $computer->runProgram($program);
            $outputs = $computer->getOutputs();
            $signal = $this->runAmplifier($amplifiers, $phases, $program, $outputs[0]);
            $max = $signal > $max ? $signal : $max;
            array_push($phases, $phase);
        }
        return $max;
    }

    public function runLoopedAmplifier(array $amplifiers, array $config, array $phases, array $program)
    {
        if (count($amplifiers) === 0) {
            $computers = [];
            foreach ($config as $amplifier => $phase) {
                $computer = new PausableComputer($this->logger, $amplifier . $phase, $program);
                $computer->addInput($phase);
                $computers[] = $computer;
            }
            $signal = 0;
            $finalSignal = 0;
            $terminated = false;
            $pos = 0;
            while (!$terminated) {
                /** @var PausableComputer $computer */
                $computer = $computers[$pos];
                $computer->addInput($signal);
                $signal = $computer->run();
                if ($signal === true) {
                    $terminated = true;
                } else {
                    if ($pos === 4) {
                        $finalSignal = $signal;
                    }
                    $pos = ($pos + 1) % 5;
                }
            }
            return $finalSignal;
        }
        $amplifier = array_shift($amplifiers);
        $max = 0;
        for ($i = 0; $i < count($phases); $i++) {
            $phase = array_shift($phases);
            $signal = $this->runLoopedAmplifier($amplifiers, array_merge($config, [$amplifier => $phase]), $phases, $program);
            $max = $signal > $max ? $signal : $max;
            array_push($phases, $phase);
        }
        return $max;
    }

}