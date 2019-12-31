<?php

namespace AdventOfCode\App\IntCode;

class ValueRetriever
{
    public const LITERAL = true;

    public function retrieve(Program $program, int $position, int $mode, bool $literal =  false): Value
    {
        if ($literal) {
            $mode = $mode === Value::Relational ? Value::RelationalTarget : Value::Target;
        }
        $value = $program->getMemory($position) ?? 0;
        switch ($mode) {
            case Value::Positional:
                return new PositionalValue($value);
            case Value::Relational:
                return new RelationalValue($value, $program->getRelativeBase());
            case Value::RelationalTarget:
                return new RelationalTargetValue($value);
            case Value::Absolute:
            default:
                return new AbsoluteValue($value);
        }
    }
}