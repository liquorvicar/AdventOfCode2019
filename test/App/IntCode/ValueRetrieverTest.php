<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class ValueRetrieverTest extends BaseTest
{

    public function testRetrievesPositionalValue()
    {
        $values = new ValueRetriever();
        $program = [3, 1, 2, 5];
        $value = $values->retrieve($program, 0, Value::Positional, 0);
        $this->assertEquals(5, $value->get($program));
    }

    public function testRetrievesAbsoluteValue()
    {
        $values = new ValueRetriever();
        $program = [3, 1, 2, 5];
        $value = $values->retrieve($program, 0, Value::Absolute, 0);
        $this->assertEquals(3, $value->get($program));
    }

    public function testRetrievesAbsolutePositionForTarget()
    {
        $values = new ValueRetriever();
        $program = [3, 1, 2, 5];
        $value = $values->retrieve($program, 0, Value::Target, 0);
        $this->assertEquals(3, $value->get($program));
    }

    public function testRetrievesPositionZeroIfPositionOutOfRange()
    {
        $values = new ValueRetriever();
        $program = [3, 1, 2, 5];
        $value = $values->retrieve($program, 4, Value::Positional, 0);
        $this->assertEquals(3, $value->get($program));
    }

    public function testRetrievesRelativeValue()
    {
        $values = new ValueRetriever();
        $program = [3, 1, 2, 5];
        $value = $values->retrieve($program, 2, Value::Relational, 1);
        $this->assertEquals(5, $value->get($program));
    }

    public function testRetrievesRelativeValueIfOutOfMemoryRange()
    {
        $values = new ValueRetriever();
        $program = [3, 1, 2, 5];
        $value = $values->retrieve($program, 2, Value::Relational, 6);
        $this->assertEquals(0, $value->get($program));
    }
}