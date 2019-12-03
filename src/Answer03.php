<?php

namespace AdventOfCode;

class Answer03 extends Base
{
    public function one(array $input)
    {
        $points = $this->traceWire(explode(',', trim($input[0])), [], 'a');
        $points = $this->traceWire(explode(',', trim($input[1])), $points, 'b');
        $paths = $this->sortByDistance($points);
        $closest = $this->findClosestCrossover($paths);
        return $this->calculateManhattanDistance(explode('.', $closest));
    }

    private function calculateManhattanDistance($position)
    {
        return abs($position[0]) + abs($position[1]);
    }

    public function two(array $input)
    {
    }

    public function traceWire($directions, $points, $wire)
    {
        $position = [0,0];
        foreach ($directions as $number => $direction) {
            $this->logger->info('Adding direction', ['direction' => $direction, 'number' => $number]);
            $path = $this->addDirection($position, $direction);
            $position = $path[count($path) - 1];
            foreach ($path as $point) {
                $key = sprintf('%s.%s', $point[0], $point[1]);
                $distance = $this->calculateManhattanDistance($point);
                if (!isset($points[$distance])) {
                    $points[$distance] = [];
                }
                if (!isset($points[$distance][$key])) {
                    $points[$distance][$key] = $wire;
                } elseif ($points[$distance][$key] !== $wire) {
                    $points[$distance][$key] = $points[$distance][$key] . $wire;
                }
            }
        }
        return $points;
    }

    public function addDirection($start, $command)
    {
        $path = [];
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

    public function sortByDistance(array $paths): array
    {
        ksort($paths);
        return $paths;
    }

    public function findClosestCrossover(array $paths)
    {
        $found = false;
        $key = null;
        while (!$found) {
            $distance = key($paths);
            foreach ($paths[$distance] as $path => $wires) {
                if (strlen($wires) > 1) {
                    $found = true;
                    $key = $path;
                }
            }
            array_shift($paths);
        }
        return $key;
    }

}