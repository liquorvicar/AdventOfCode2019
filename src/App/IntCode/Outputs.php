<?php

namespace AdventOfCode\App\IntCode;

class Outputs
{
    private $values = [];

    public function getOutputs(): array
    {
        return $this->values;
    }

    public function add($outputVal)
    {
        $this->values[] = $outputVal;
    }
}