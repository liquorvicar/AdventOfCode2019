<?php

namespace AdventOfCode;


class Answer01 extends Base
{

    public function one(Array $input) {
        $this->logger->info('Running part one');
        $fuel = 0;
        foreach ($input as $mass) {
            $fuel += $this->calculateFuel((int)$mass);
        }
        return $fuel;
    }

    private function calculateFuel(int $mass): int
    {
        return floor($mass / 3) - 2;
    }

    public function two(Array $input) {
        $this->logger->info('Running part two');
        $totalFuel = 0;
        foreach ($input as $mass) {
            $fuel = $this->calculateFuel((int)$mass);;
            while ($fuel > 0) {
                $totalFuel += $fuel;
                $fuel = $this->calculateFuel($fuel);
            }
        }
        return $totalFuel;
    }
}

