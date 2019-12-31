<?php

namespace AdventOfCode\App\IntCode;

class Program
{
    /**
     * @var int
     */
    private $relativeBase;
    /**
     * @var int[]
     */
    private $memory;

    public function __construct(array $memory, $relativeBase = 0)
    {
        $this->memory = $memory;
        $this->relativeBase = $relativeBase;
    }

    public function adjustRelativeBase(int $value)
    {
        $this->relativeBase += $value;
    }

    public function setMemory($address, $value)
    {
        $this->memory[$address] = $value;
    }

    public function getMemory(int $address)
    {
        return isset($this->memory[$address]) ? $this->memory[$address] : null;
    }

    public function dumpMemory()
    {
        return $this->memory;
    }

    public function getRelativeBase()
    {
        return $this->relativeBase;
    }
}
