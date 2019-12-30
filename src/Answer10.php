<?php


namespace AdventOfCode;



class Answer10 extends Base
{
    public function one(array $input)
    {
        $asteroids = $this->parseGrid($input);
        $maxLineOfSight = 0;
        foreach ($asteroids as $asteroid) {
            $lineOfSight = $this->countLineOfSight($asteroid, $asteroids);
            if ($lineOfSight > $maxLineOfSight) {
                $this->logger->info('Found new max', $asteroid);
                $maxLineOfSight = $lineOfSight;
            }
        }
        return $maxLineOfSight;
    }

    public function two(array $input)
    {
        $asteroid = [22, 19,];
        return $this->findNthVaporised($input, $asteroid, 300);
    }

    public function countLineOfSight($asteroid, array $asteroids)
    {
        $vectors = $this->getOrientationFromTarget($asteroid, $asteroids);
        $count = 0;
        foreach ($vectors as $target) {
            $possibleBlockers = array_filter($vectors, function ($blocker) use ($target) {
                if ($blocker[6] !== $target[6]) {
                    return false;
                }
                return $blocker[3] < $target[3];
            });
            if (empty($possibleBlockers)) {
                $count++;
            }
        }
        return $count;
    }

    public function parseGrid(array $input): array
    {
        $asteroids = [];
        foreach ($input as $rowNum => $row) {
            $locations = str_split($row);
            foreach ($locations as $colNum => $location) {
                if ($location === '#') {
                    $asteroids[] = [$colNum, $rowNum];
                }
            }
        }
        return $asteroids;
    }

    public function vaporise(array $asteroids, float $direction)
    {
        $found = false;
        $possibles = [];
        $looped = false;
        while (!$found && !$looped) {
            $possibles = array_filter($asteroids, function ($possible) use ($direction) {
                return $possible[6] >= $direction;
            });
            if (count($possibles) > 0) {
                $found = true;
            } elseif (!$looped) {
                $direction = 0;
                $looped = $found =  true;
            }
        }
        if (count($possibles) > 0) {
            $vaporised = array_shift($possibles);
        } else {
            return null;
        }
        $notBlocked = array_filter($possibles, function ($vector) use ($vaporised) {
            return $vector[6] !== $vaporised[6];
        });
        $nextDirection = count($notBlocked) > 0 ? array_shift($notBlocked) : [ 6 => 0];
        return [$vaporised[4], $vaporised[5], $nextDirection[6]];
    }

    /**
     * @param $asteroid
     * @param array $asteroids
     * @return array
     */
    public function getOrientationFromTarget($asteroid, array $asteroids): array
    {
        $vectors = array_map(function ($target) use ($asteroid) {
            return [$target[0] - $asteroid[0], $target[1] - $asteroid[1], $target[0], $target[1]];
        }, $asteroids);
        $targets = array_filter($vectors, function ($target) {
            return $target[0] !== 0 || $target[1] !== 0;
        });
        $vectors = array_map(function ($vector) {
            return [
                $vector[0],
                $vector[1],
                $vector[1] !== 0 ? round($vector[0] / $vector[1], 5) : null,
                abs($vector[0]) + abs($vector[1]),
                $vector[2],
                $vector[3],
                $this->compass($vector[0], $vector[1] * -1),
            ];
        }, $targets);
        return $vectors;
    }

    private function compass($x,$y)
    {
        if($x==0 AND $y==0){ return 0; } // ...or return 360
        return ($x < 0)
            ? rad2deg(atan2($x,$y))+360      // TRANSPOSED !! y,x params
            : rad2deg(atan2($x,$y));
        }

    /**
     * @param array $input
     * @param array $asteroid
     * @return float|int|mixed
     */
    public function findNthVaporised(array $input, array $asteroid, int $num)
    {
        $asteroids = $this->parseGrid($input);
        $asteroids = $this->getOrientationFromTarget($asteroid, $asteroids);
        usort($asteroids, function ($a, $b) {
            $sort = $a[6] <=> $b[6];
            if ($sort === 0) {
                return $a[3] <=> $b[3];
            }
            return $sort;
        });
        $direction = 0;
        $count = 0;
        $found = null;
        while (($next = $this->vaporise($asteroids, $direction)) && $count < $num) {
            $count++;
            $this->logger->info('Vaporised!', ['num' => $count, 'x' => $next[0], 'y' => $next[1], ]);
            $found = $next;
            $direction = $next[2];
            $asteroids = array_filter($asteroids, function ($asteroid) use ($next) {
                return $asteroid[4] !== $next[0] || $asteroid[5] !== $next[1];
            });
        }
        return ($found[0] * 100) + $found[1];
    }
}