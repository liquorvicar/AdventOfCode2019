<?php

namespace AdventOfCode\App\IntCode;

use Psr\Log\LoggerInterface;

class PausableComputer
{
    /**
     * @var array
     */
    private $inputs = [];
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ValueRetriever
     */
    private $valueRetriever;
    /**
     * @var Program
     */
    private $program;
    /**
     * @var int
     */
    private $position = 0;
    private $name;

    public function __construct(LoggerInterface $logger, $name, $program)
    {
        $this->logger = $logger;
        $this->valueRetriever = new ValueRetriever();
        $this->program = new Program($program);
        $this->name = $name;
    }

    public function run()
    {
        $outputs = new Outputs();
        $commandParser = new CommandParser($this->inputs, $outputs);
        $finished = false;
        while (!$finished && !is_null($this->program->getMemory($this->position))) {
            $command = $commandParser->parse($this->program, $this->position);
            $this->program = $command->run($this->program);
            $finished = $command->isTerminated();
            $this->position = $command->nextCommand($this->position);
            if (!empty($outputs->getOutputs())) {
                break;
            }
        }
        $this->inputs = $commandParser->getInputs();
        if (!empty($outputs->getOutputs())) {
            return $outputs->getOutputs()[0];
        }
        return true;
    }

    public function addInput($input): void
    {
        $this->inputs[] = $input;
    }
}