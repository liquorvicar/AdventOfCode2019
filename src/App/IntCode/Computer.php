<?php

namespace AdventOfCode\App\IntCode;


use Psr\Log\LoggerInterface;

class Computer
{
    /**
     * @var Outputs
     */
    private $outputs;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ValueRetriever
     */
    private $valueRetriever;
    /**
     * @var CommandParser
     */
    private $commandParser;

    public function __construct(LoggerInterface $logger, $inputs = [])
    {
        $this->outputs = new Outputs();
        $this->logger = $logger;
        $this->valueRetriever = new ValueRetriever();
        $this->commandParser = new CommandParser($inputs, $this->outputs);
    }

    public function runProgram(array $program)
    {
        $position = 0;
        $finished = false;
        while (!$finished && $position <= count($program)) {
            $command = $this->commandParser->parse($program, $position, 0);
            $program = $command->run($program);
            $finished = $command->isTerminated();
            $position = $command->nextCommand($position);
        }
        return $program[0];
    }

    public function getOutputs(): array
    {
        return $this->outputs->getOutputs();
    }
}
