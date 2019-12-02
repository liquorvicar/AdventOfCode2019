<?php

namespace AdventOfCode;


class Answer01Test extends BaseTest
{
    /**
     * @dataProvider dataForOne
     */
    public function testOne($mass, $fuel) {
        $answer = new Answer01($this->logger);
        $this->assertEquals($fuel, $answer->one([$mass]));
    }

    public function dataForOne() {
        return [
            [12, 2],
            [14, 2],
            [1969, 654],
            [100756, 33583],
        ];
    }

    /**
     * @dataProvider dataForTwo
     */
    public function testTwo($mass, $fuel) {
        $answer = new Answer01($this->logger);
        $this->assertEquals($fuel, $answer->two([$mass]));
    }

    public function dataForTwo()
    {
        return [
            [14, 2],
            [1969, 966],
            [100756, 50346],
        ];
    }
}

