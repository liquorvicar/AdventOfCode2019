<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class ValueRetrieverTest extends BaseTest
{

    public function testRetrievesPositionalValue()
    {
        $values = new ValueRetriever();
        $program = new Program([3, 1, 2, 5]);
        $value = $values->retrieve($program, 0, Value::Positional);
        $this->assertEquals(5, $value->get($program));
    }

    public function testRetrievesAbsoluteValue()
    {
        $values = new ValueRetriever();
        $program = new Program([3, 1, 2, 5]);
        $value = $values->retrieve($program, 0, Value::Absolute);
        $this->assertEquals(3, $value->get($program));
    }

    public function testRetrievesAbsolutePositionForTarget()
    {
        $values = new ValueRetriever();
        $program = new Program([3, 1, 2, 5]);
        $value = $values->retrieve($program, 0, Value::Target);
        $this->assertEquals(3, $value->get($program));
    }

    public function testRetrievesPositionZeroIfPositionOutOfRange()
    {
        $values = new ValueRetriever();
        $program = new Program([3, 1, 2, 5]);
        $value = $values->retrieve($program, 4, Value::Positional);
        $this->assertEquals(3, $value->get($program));
    }

    public function testRetrievesRelativeValue()
    {
        $values = new ValueRetriever();
        $program = new Program([3, 1, 2, 5], 1);
        $value = $values->retrieve($program, 2, Value::Relational);
        $this->assertEquals(5, $value->get($program));
    }

    public function testRetrievesRelativeValueIfOutOfMemoryRange()
    {
        $values = new ValueRetriever();
        $program = new Program([3, 1, 2, 5], 3);
        $value = $values->retrieve($program, 2, Value::Relational);
        $this->assertEquals(0, $value->get($program));
    }
}