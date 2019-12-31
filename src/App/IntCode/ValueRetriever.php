<?php

namespace AdventOfCode\App\IntCode;

class ValueRetriever
{
    public function retrieve(Program $program, int $position, int $mode): Value
    {
        $value = $program->getMemory($position) ?? 0;
        switch ($mode) {
            case Value::Positional:
                return new PositionalValue($value);
            case Value::Relational:
                return new RelationalValue($value, $program->getRelativeBase());
            case Value::Absolute:
            default:
                return new AbsoluteValue($value);
        }
    }
}