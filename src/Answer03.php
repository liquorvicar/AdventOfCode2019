<?php

namespace AdventOfCode;

class Answer03 extends Base
{
    public function one(array $input)
    {
        $paths = [
            $this->traceWire(explode(',', trim($input[0]))),
            $this->traceWire(explode(',', trim($input[1]))),
        ];
        $paths = $this->sortByDistance($paths);
        $closest = $this->findClosestCrossover($paths);
        return $this->calculateManhattanDistance($closest);
    }

    private function calculateManhattanDistance($position)
    {
        return abs($position[0]) + abs($position[1]);
    }

    public function two(array $input)
    {
    }

    public function traceWire($directions)
    {
        $path = [];
        $position = [0,0];
        foreach ($directions as $number => $direction) {
            $this->logger->info('Adding direction', ['direction' => $direction, 'number' => $number]);
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

    public function sortByDistance(array $paths): array
    {
        $paths = array_map(function ($path) {
            usort($path, function ($a, $b) {
                $aDistance = $this->calculateManhattanDistance($a);
                $bDistance = $this->calculateManhattanDistance($b);
                if ($aDistance < $bDistance) {
                    return -1;
                } elseif ($aDistance === $bDistance) {
                    return 0;
                } else {
                    return 1;
                }
            });
            return $path;
        }, $paths);
        return $paths;
    }

    public function findClosestCrossover(array $paths)
    {
        $pos0 = 0;
        $pos1 = 1;
        while ($pos0 < count($paths[0]) && $pos1 < count($paths[1])) {
            $this->logger->info('Examining', ['a' => $pos0, 'b' => $pos1]);
            $point0 = $paths[0][$pos0];
            $point1 = $paths[1][$pos1];
            if ($point0[0] === $point1[0] && $point0[1] === $point1[1]) {
                return $point0;
            } elseif ($this->calculateManhattanDistance($point0) < $this->calculateManhattanDistance($point1)) {
                $pos0++;
            } elseif ($this->calculateManhattanDistance($point0) > $this->calculateManhattanDistance($point1)) {
                $pos1++;
            } elseif ($this->calculateManhattanDistance($point0) === $this->calculateManhattanDistance($paths[0][$pos0 + 1])) {
                $pos0++;
            } else {
                $pos1++;
            }
        }
        return null;
    }

}