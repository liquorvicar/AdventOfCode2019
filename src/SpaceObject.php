<?php

namespace AdventOfCode;

class SpaceObject
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var SpaceObject
     */
    private $orbitee;
    private $count;


    public function __construct(string $name)
    {
        $this->name = $name;
        $this->orbiters = [];
    }

    public function orbits(SpaceObject $object)
    {
        $this->orbitee = $object;
        $object->addOrbiter($this);
    }

    public function addOrbiter(SpaceObject $object)
    {
        $this->orbiters[] = $object;
    }

    public function countOrbits($count)
    {
        if (is_null($this->orbitee)) {
            return $count;
        }
        $count++;
        $count = $this->orbitee->countOrbits($count);
        return $count;
    }

    public function getOrbitee()
    {
        if (is_null($this->orbitee)) {
            return null;
        }
        return $this->orbitee->getName();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOrbiters()
    {
        return $this->orbiters;
    }
}