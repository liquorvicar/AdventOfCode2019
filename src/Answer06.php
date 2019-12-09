<?php

namespace AdventOfCode;

class Answer06 extends Base
{
    public function one(array $input)
    {
        $nodes = $this->createMap($input);
        $count = 0;
        foreach ($nodes as $node) {
            $count+= $node->countOrbits(0);
        }
        return $count;
    }

    public function two(array $input)
    {
        $nodes = $this->createMap($input);
        $possibles = [];
        $possibles[] = [$nodes['YOU']->getOrbitee(), 'YOU'];
        $visited = ['YOU'];
        $found = false;
        while (!empty($possibles) && !$found) {
            $paths = $possibles;
            $possibles = [];
            foreach ($paths as $possible) {
                $currentNode = $possible[0];
                if ($currentNode === 'SAN') {
                    $found = $possible;
                } else {
                    $visited[] = $currentNode;
                    $node = $nodes[$currentNode];
                    if ($node->getOrbitee()) {
                        $possibles = $this->createPath($node->getOrbitee(), $visited, $possible, $possibles);
                    }
                    foreach ($node->getOrbiters() as $orbiter) {
                        $possibles = $this->createPath($orbiter->getName(), $visited, $possible, $possibles);
                    }
                }
            }
        }
        return $found ? count($found) - 3 : 0;
    }

    private function createPath($nodeName, $visited, $path, $paths)
    {
        if (!in_array($nodeName, $visited)) {
            array_unshift($path, $nodeName);
            $paths[] = $path;
        }
        return $paths;
    }

    /**
     * @param array $input
     * @return SpaceObject[]
     */
    protected function createMap(array $input): array
    {
        /** @var SpaceObject[] $nodes */
        $nodes = [];
        foreach ($input as $mapEntry) {
            $objects = explode(')', trim($mapEntry));
            if (!count($objects) === 2) {
                continue;
            }
            if (!isset($nodes[$objects[0]])) {
                $nodes[$objects[0]] = new SpaceObject($objects[0]);
            }
            if (!isset($nodes[$objects[1]])) {
                $nodes[$objects[1]] = new SpaceObject($objects[1]);
            }
            $nodes[$objects[1]]->orbits($nodes[$objects[0]]);
        }
        return $nodes;
    }
}
