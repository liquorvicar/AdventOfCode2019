<?php


namespace AdventOfCode\App\IntCode;


interface Command
{
    public function run(array $program): array;

    public function nextCommand(int $position): int;

    public function isTerminated(): bool;
}