<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class PositionalValueTest extends BaseTest
{
    public function testReturnsZeroIfPositionOutOfRange()
    {
        $value = new PositionalValue(4);
        $program = [3, 1, 2, 5];
        $this->assertEquals(0, $value->get($program));
    }
}