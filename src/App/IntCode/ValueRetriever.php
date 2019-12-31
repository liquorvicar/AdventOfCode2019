<?php

namespace AdventOfCode\App\IntCode;

class ValueRetriever
{
    public function retrieve(array $program, int $position, int $mode, int $relativeBase): Value
    {
        $value = $program[$position] ?? $program[0];
        switch ($mode) {
            case Value::Positional:
                return new PositionalValue($value);
            case Value::Relational:
                return new RelationalValue($value, $relativeBase);
            case Value::Absolute:
            default:
                return new AbsoluteValue($value);
        }
    }
}