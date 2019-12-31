<?php

namespace AdventOfCode\App\IntCode;

interface Value
{
    const Positional = 0;
    const Absolute = 1;
    const Relational = 2;
    const Target = 3;

    public function get(array $program): int;
}