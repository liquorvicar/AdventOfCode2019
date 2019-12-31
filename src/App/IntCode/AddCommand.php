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

    public function __construct(ValueRetriever $valueRetriever, $program, $position, $modes, $relativeBase)
    {
        $this->first = $valueRetriever->retrieve($program, $position + 1, $modes[0], $relativeBase);
        $this->second = $valueRetriever->retrieve($program, $position + 2, $modes[1], $relativeBase);
        $this->target = $valueRetriever->retrieve($program, $position + 3, Value::Target, $relativeBase);
    }

    public function run(array $program): array
    {
        $program[$this->target->get($program)] = $this->first->get($program) + $this->second->get($program);
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