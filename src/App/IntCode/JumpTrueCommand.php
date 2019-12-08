<?php

namespace AdventOfCode\App\IntCode;

class JumpTrueCommand implements Command
{
    /**
     * @var Value
     */
    protected $comparator;
    /**
     * @var Value
     */
    protected $target;
    /**
     * @var int|null
     */
    protected $next = null;


    public function __construct(ValueRetriever $valueRetriever, $program, $position, $modes)
    {
        $this->comparator = $valueRetriever->retrieve($program, $position + 1, $modes[0]);
        $this->target = $valueRetriever->retrieve($program, $position + 2, $modes[1]);
    }

    public function run(array $program): array
    {
        if ($this->comparator->get($program) !== 0) {
            $this->next = $this->target->get($program);
        }
        return $program;
    }

    public function nextCommand(int $position): int
    {
        return $this->next ?? $position + 3;
    }

    public function isTerminated(): bool
    {
        return false;
    }

}