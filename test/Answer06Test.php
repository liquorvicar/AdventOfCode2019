<?php

namespace AdventOfCode;

class Answer06Test extends BaseTest
{
    /**
     * @dataProvider dataForCountAllOrbits
     */
    public function testCountAllOrbits($map, $orbits)
    {
        $answer = new Answer06($this->logger);
        $this->assertEquals($orbits, $answer->one($map));
    }

    public function dataForCountAllOrbits()
    {
        return [
            [[], 0],
            [['COM)B'], 1],
            [['COM)B', 'B)C'], 3],
            [[
                'COM)B',
                'B)C',
                'C)D',
                'D)E',
                'E)F',
                'B)G',
                'G)H',
                'D)I',
                'E)J',
                'J)K',
                'K)L'
            ], 42],
        ];
    }

    public function testCalcMinTransfers()
    {
        $map = [
            'COM)B',
            'B)C',
            'C)D',
            'D)E',
            'E)F',
            'B)G',
            'G)H',
            'D)I',
            'E)J',
            'J)K',
            'K)L',
            'K)YOU',
            'I)SAN'
        ];
        $answer = new Answer06($this->logger);
        $this->assertEquals(4, $answer->two($map));
    }
}