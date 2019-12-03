<?php

namespace AdventOfCode;

class Answer03Test extends BaseTest
{

    /**
     * @dataProvider dataForAddDirection
     */
    public function testAddDirection($direction, $result)
    {
        $answer = new Answer03($this->logger);
        $this->assertEquals($result, $answer->addDirection([], [0, 0], $direction));
    }

    public function dataForAddDirection()
    {
        return [
            ['U2', [[-1, 0], [-2, 0]]],
            ['D2', [[1, 0], [2, 0]]],
            ['R2', [[0, 1], [0, 2]]],
            ['L2', [[0, -1], [0, -2]]],
        ];
    }

    public function testFindClosestCrossover()
    {
        $answer = new Answer03($this->logger);
        $paths = [
            $answer->traceWire(explode(',', 'R8,U5,L5,D3')),
            $answer->traceWire(explode(',', 'U7,R6,D4,L4')),
        ];
        $paths = $answer->sortByDistance($paths);
        $this->assertEquals([-3, 3], $answer->findClosestCrossover($paths));
    }

    /**
     * @dataProvider dataForOne
     */
    public function testOne($paths, $distance)
    {
        $answer = new Answer03($this->logger);
        $this->assertEquals($distance, $answer->one($paths));
    }

    public function dataForOne()
    {
        return [
            [
                [
                    'R8,U5,L5,D3',
                    'U7,R6,D4,L4',
                ],
                6,
            ],
            [
                [
                    'R75,D30,R83,U83,L12,D49,R71,U7,L72',
                    'U62,R66,U55,R34,D71,R55,D58,R83',
                ],
                159,
            ],
            [
                [
                    'R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51',
                    'U98,R91,D20,R16,D67,R40,U7,R15,U6,R7',
                ],
                135,
            ]
        ];
    }
}