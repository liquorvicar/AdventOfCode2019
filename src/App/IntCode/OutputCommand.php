<?php

namespace AdventOfCode\App\IntCode;

class OutputCommand implements Command
{
    /**
     * @var Outputs
     */
    protected $outputs;
    /**
     * @var Value
     */
    protected $target;


    public function __construct(ValueRetriever $valueRetriever, $program, $position, $outputs)
    {
        $this->outputs = $outputs;
        $this->target = $valueRetriever->retrieve($program, $position + 1, Value::Target);
    }

    public function run($program): array
    {
        $outputVal = $program[$this->target->get($program)];
        $this->outputs->add($outputVal);
        return $program;
    }

    public function nextCommand(int $position): int
    {
        return $position + 2;
    }

    public function isTerminated(): bool
    {
        return false;
    }
}