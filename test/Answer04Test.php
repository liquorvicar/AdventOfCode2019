<?php

namespace AdventOfCode;

class Answer04Test extends BaseTest
{

    /**
     * @dataProvider dataForAdjacentDigits
     */
    public function testHasAdjacentDigits($number, $valid)
    {
        $answer = new Answer04($this->logger);
        $this->assertEquals($valid, $answer->hasAdjacentDigits($number));
    }

    public function dataForAdjacentDigits()
    {
        return [
            [123456, false],
            [113456, true],
            [111111, true],
        ];
    }

    /**
     * @dataProvider dataForSequentialDigits
     */
    public function testHasSequentialDigits($number, $valid)
    {
        $answer = new Answer04($this->logger);
        $this->assertEquals($valid, $answer->hasSequentialDigits($number));
    }

    public function dataForSequentialDigits()
    {
        return [
            [123456, true],
            [113450, false],
            [111111, true],
        ];
    }

    /**
     * @dataProvider dataForIsValid
     */
    public function testIsValid($number, $valid)
    {
        $answer = new Answer04($this->logger);
        $this->assertEquals($valid, $answer->isValid($number));
    }

    public function dataForIsValid()
    {
        return [
            [123456, false],
            [113450, false],
            [111111, true],
            [135679, false],
            [111123, true],
            [223450, false],
        ];
    }

    /**
     * @dataProvider dataForMultipleAdjacent
     */
    public function testHasExactlyTwoAdjacentDigits($number, $valid)
    {
        $answer = new Answer04($this->logger);
        $this->assertEquals($valid, $answer->hasExactlyTwoAdjacentDigits($number));
    }

    public function dataForMultipleAdjacent()
    {
        return [
            [123456, false],
            [113450, true],
            [111111, false],
            [135679, false],
            [111123, false],
            [223450, true],
            [111122, true],
        ];
    }
}