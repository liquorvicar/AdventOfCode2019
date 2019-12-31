<?php

namespace AdventOfCode\App\IntCode;

class AddCommand implements Command
{
    /**
     * @var Value
     */
    protected $first;
    /**
     * @var Value
     */
    protected $second;
    /**
     * @var Value
     */
    protected $target;

    public function __construct(ValueRetriever $valueRetriever, Program $program, $position, $modes)
    {
        $this->first = $valueRetriever->retrieve($program, $position + 1, $modes[0]);
        $this->second = $valueRetriever->retrieve($program, $position + 2, $modes[1]);
        $this->target = $valueRetriever->retrieve($program, $position + 3, $modes[2] ?? Value::Target, ValueRetriever::LITERAL);
    }

    public function run(Program $program): Program
    {
        $program->setMemory($this->target->get($program), $this->first->get($program) + $this->second->get($program));
        return $program;
    }

    public function nextCommand(int $position): int
    {
        return $position + 4;
    }

    public function isTerminated(): bool
    {
        return false;
    }
}