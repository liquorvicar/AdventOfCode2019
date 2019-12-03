<?php

namespace AdventOfCode;

class Answer03 extends Base
{
    public function one(array $input)
    {
        $paths = [
            $this->traceWire(explode(',', $input[0])),
            $this->traceWire(explode(',', $input[1])),
        ];
        $crossovers = $this->findCrossovers($paths);
        $closest = null;
        foreach ($crossovers as $crossover) {
            $distance = abs($crossover[0]) + abs($crossover[1]);
            if (!$closest || $closest > $distance) {
                $closest = $distance;
            }
        }
        return $closest;
    }

    public function two(array $input)
    {
    }

    public function traceWire($directions)
    {
        $path = [];
        $position = [0,0];
        foreach ($directions as $direction) {
            $path = $this->addDirection($path, $position, $direction);
            $position = $path[count($path) - 1];
        }
        return $path;
    }

    public function addDirection(array $path, $start, $command)
    {
        $direction = substr($command, 0, 1);
        $distance = (int)substr($command, 1);
        switch ($direction) {
            case 'U':
                for ($i = 0; $i < $distance; $i++) {
                    $start[0]--;
                    $path[] = $start;
                }
                break;
            case 'D':
                for ($i = 0; $i < $distance; $i++) {
                    $start[0]++;
                    $path[] = $start;
                }
                break;
            case 'R':
                for ($i = 0; $i < $distance; $i++) {
                    $start[1]++;
                    $path[] = $start;
                }
                break;
            case 'L':
                for ($i = 0; $i < $distance; $i++) {
                    $start[1]--;
                    $path[] = $start;
                }
                break;
        }
        return $path;
    }

    public function findCrossovers(array $paths): array
    {
        $crossovers = [];
        foreach ($paths[0] as $point) {
            if (array_filter($paths[1], function ($candidate) use ($point) {
                return $candidate[0] === $point[0] && $candidate[1] === $point[1];
            })) {
                $crossovers[] = $point;
            }
        }
        return $crossovers;
    }

}