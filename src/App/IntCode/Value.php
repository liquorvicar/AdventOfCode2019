<?php

namespace AdventOfCode\App\IntCode;

interface Value
{
    const Positional = 0;
    const Absolute = 1;
    const Target = 2;

    public function get(array $program): int;
}