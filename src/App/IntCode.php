<?php

namespace AdventOfCode\App;


use Psr\Log\LoggerInterface;

class IntCode
{
    private $outputs;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->outputs = [];
        $this->logger = $logger;
    }

    public function runProgram(array $program, $inputs = [])
    {
        $position = 0;
        $finished = false;
        while (!$finished && $position <= count($program)) {
            $commandLength = 4;
            $commandVal = $program[$position] ?? 0;
            [$command, $modes] = $this->parseCommand($commandVal);
            $first = $this->findValue($program, $position + 1, $modes[0]);
            $second = $this->findValue($program, $position + 2, $modes[1]);
            $target = isset($program[$position + 3]) ? $program[$position + 3] : 0;
            switch ($command) {
                case 1:
                    $program[$target] = $first + $second;
                    break;
                case 2:
                    $program[$target] = $first * $second;
                    break;
                case 3:
                    $inputVal = (int)array_shift($inputs);
                    $this->logger->info('Reading input val', ['input' => $inputVal]);
                    $target = $program[$position + 1] ?? 0;
                    $program[$target] = $inputVal;
                    $commandLength = 2;
                    break;
                case 4:
                    $target = $program[$position + 1] ?? 0;
                    $outputVal = $program[$target];
                    $this->logger->info('Outputting val', ['output' => $outputVal]);
                    $this->outputs[] = $outputVal;
                    $commandLength = 2;
                    break;
                case 99:
                    $finished = true;
                    $commandLength = 1;
                    break;
            }
            $position += $commandLength;
        }
        return $program[0];
    }

    private function findValue($program, $position, $mode)
    {
        if (!isset($program[$position])) {
            return 0;
        }
        if ($mode === 1) {
            return $program[$position];
        }
        if (!isset($program[$program[$position]])) {
            return 0;
        }
        return $program[$program[$position]];
    }

    public function getOutputs()
    {
        return $this->outputs;
    }

    public function parseCommand(int $input)
    {
        $modes = [];
        $modes[] = (int)floor($input / 10000);
        $input = $input % 10000;
        $modes[] = (int)floor($input / 1000);
        $input = $input % 1000;
        $modes[] = (int)floor($input / 100);
        $input = $input % 100;
        return [$input, array_reverse($modes)];
    }

}