<?php


namespace AdventOfCode\App\IntCode;


interface Command
{
    public function run(Program $program): Program;

    public function nextCommand(int $position): int;

    public function isTerminated(): bool;
}