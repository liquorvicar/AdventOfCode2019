<?php

namespace AdventOfCode\App\IntCode;

class InputCommand implements Command
{
    /**
     * @var Value
     */
    protected $input;
    /**
     * @var Value
     */
    protected $target;


    public function __construct(ValueRetriever $valueRetriever, Program $program, $position, $inputVal)
    {
        $this->input = new AbsoluteValue($inputVal);
        $this->target = $valueRetriever->retrieve($program, $position + 1, Value::Target);
    }

    public function run(Program $program): Program
    {
        $program->setMemory($this->target->get($program), $this->input->get($program));
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