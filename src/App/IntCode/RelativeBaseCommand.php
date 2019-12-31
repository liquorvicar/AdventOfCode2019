<?php

namespace AdventOfCode\App\IntCode;

class RelativeBaseCommand implements Command
{
    private $value;
    private $relativeBase;

    public function __construct(ValueRetriever $valueRetriever, $program, $position, $relativeBase)
    {
        $this->value = $valueRetriever->retrieve($program, $position + 1, Value::Absolute, $relativeBase);
        $this->relativeBase = $relativeBase;
    }

    public function run(array $program): array
    {
        $this->relativeBase += $this->value->get($program);
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

    public function relativeBase(): int
    {
        return $this->relativeBase;
    }
}