<?php

namespace AdventOfCode\App\IntCode;

class ValueRetriever
{
    public function retrieve(array $program, int $position, int $mode): Value
    {
        $value = $program[$position] ?? $program[0];
        if ($mode === Value::Positional) {
            return new PositionalValue($value);
        } else {
            return new AbsoluteValue($value);
        }
    }
}