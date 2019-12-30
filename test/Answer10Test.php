<?php


namespace AdventOfCode;


class Answer10Test extends BaseTest
{
    /**
     * @dataProvider dataForLineOfSight
     */
    public function testDetectLineOfSight($asteroid, $numVisible)
    {
        $answer = new Answer10($this->logger);
        $asteroids = [
            [1, 0,],
            [4, 0,],
            [0, 2,],
            [1, 2,],
            [2, 2,],
            [3, 2,],
            [4, 2,],
            [4, 3,],
            [3, 4,],
            [4, 4,],
        ];
        $this->assertEquals($numVisible, $answer->countLineOfSight($asteroid, $asteroids));
    }

    public function dataForLineOfSight()
    {
        return [
            [[3, 4,], 8],
            [[1, 0,], 7],
            [[0, 2,], 6],
            [[4, 2,], 5],
        ];
    }

    /**
     * @dataProvider dataForMostLineOfSight
     */
    public function testFindMostLineOfSight($expected, $grid)
    {
        $answer = new Answer10($this->logger);
        $this->assertEquals($expected, $answer->one($grid));
    }

    public function dataForMostLineOfSight()
    {
        return [
            [8, [
                '.#..#',
                '.....',
                '#####',
                '....#',
                '...##',
            ],],
            [33, [
                '......#.#.',
                '#..#.#....',
                '..#######.',
                '.#.#.###..',
                '.#..#.....',
                '..#....#.#',
                '#..#....#.',
                '.##.#..###',
                '##...#..#.',
                '.#....####',
            ],],
            [35, [
                '#.#...#.#.',
                '.###....#.',
                '.#....#...',
                '##.#.#.#.#',
                '....#.#.#.',
                '.##..###.#',
                '..#...##..',
                '..##....##',
                '......#...',
                '.####.###.',
            ],],
            [41, [
                '.#..#..###',
                '####.###.#',
                '....###.#.',
                '..###.##.#',
                '##.##.#.#.',
                '....###..#',
                '..#.#..#.#',
                '#..#.#.###',
                '.##...##.#',
                '.....#.#..',
            ],],
        ];
    }

    public function testBiggestGrid()
    {
        $answer = new Answer10($this->logger);
        $grid = [
            '.#..##.###...#######',
            '##.############..##.',
            '.#.######.########.#',
            '.###.#######.####.#.',
            '#####.##.#.##.###.##',
            '..#####..#.#########',
            '####################',
            '#.####....###.#.#.##',
            '##.#################',
            '#####.##.###..####..',
            '..######..##.#######',
            '####.##.####...##..#',
            '.#####..#.######.###',
            '##...#.##########...',
            '#.##########.#######',
            '.####.#.###.###.#.##',
            '....##.##.###..#####',
            '.#.#.###########.###',
            '#.#.#.#####.####.###',
            '###.##.####.##.#..##',
        ];
        $asteroids = $answer->parseGrid($grid);
        $lineOfSight = $answer->countLineOfSight([11,13], $asteroids);
        $this->assertEquals(210, $lineOfSight);
    }

    /**
     * @dataProvider dataForNthVaporised
     */
    public function testFindNthVaporised(int $smallGrid, int $count, int $expected)
    {
        $answer = new Answer10($this->logger);
        if ($smallGrid) {
            $grid = [
                '.#....#####...#..',
                '##...##.#####..##',
                '##...#...#.#####.',
                '..#.....#...###..',
                '..#.#.....#....##',
            ];
            $asteroid = [8, 3];
        } else {
            $grid = [
                '.#..##.###...#######',
                '##.############..##.',
                '.#.######.########.#',
                '.###.#######.####.#.',
                '#####.##.#.##.###.##',
                '..#####..#.#########',
                '####################',
                '#.####....###.#.#.##',
                '##.#################',
                '#####.##.###..####..',
                '..######..##.#######',
                '####.##.####...##..#',
                '.#####..#.######.###',
                '##...#.##########...',
                '#.##########.#######',
                '.####.#.###.###.#.##',
                '....##.##.###..#####',
                '.#.#.###########.###',
                '#.#.#.#####.####.###',
                '###.##.####.##.#..##'
            ];
            $asteroid = [11, 13,];
        }
        $checksum = $answer->findNthVaporised($grid, $asteroid, $count);
        $this->assertEquals($expected, $checksum);
    }

    public function dataForNthVaporised()
    {
        return [
            [1, 1, 801,],
            [1, 2, 900,],
            [1, 3, 901,],
            [1, 4, 1000,],
            [1, 5, 902,],
            [1, 6, 1101,],
            [1, 7, 1201,],
            [1, 8, 1102,],
            [1, 9, 1501,],
            [1, 10, 1202,],
            [1, 11, 1302,],
            [1, 12, 1402,],
            [1, 13, 1502,],
            [1, 14, 1203,],
            [1, 15, 1604,],
            [1, 16, 1504,],
            [1, 17, 1004,],
            [1, 18, 404,],
            [1, 19, 204,],
            [1, 20, 203,],
            [1, 21, 002,],
            [1, 22, 102,],
            [1, 23, 001,],
            [1, 24, 101,],
            [1, 25, 502,],
            [1, 26, 100,],
            [1, 27, 501,],
            [1, 28, 601,],
            [1, 29, 600,],
            [1, 30, 700,],
            [1, 31, 800,],
            [1, 32, 1001,],
            [1, 33, 1400,],
            [1, 34, 1601,],
            [1, 35, 1303,],
            [1, 36, 1403,],
            [0, 1, 1112,],
            [0, 2, 1201,],
            [0, 3, 1202,],
            [0, 20, 1600,],
            [0, 50, 1609,],
            [0, 100, 1016,],
            [0, 199, 906,],
            [0, 200, 802,],
        ];
    }
}