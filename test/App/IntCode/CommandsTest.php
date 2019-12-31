<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class CommandsTest extends BaseTest
{
    public function testAddTwoNumbers()
    {
        $program = new Program([1101, 2, 4, 3]);
        $output = [1101, 2, 4, 6];
        $add = new AddCommand(new ValueRetriever(), $program, 0, [1, 1]);
        $this->assertEquals($output, $add->run($program)->dumpMemory());
    }

    public function testMultiplyTwoNumbers()
    {
        $program = new Program([1101, 2, 4, 3]);
        $output = [1101, 2, 4, 8];
        $multiply = new MultiplyCommand(new ValueRetriever(), $program, 0, [1, 1]);
        $this->assertEquals($output, $multiply->run($program)->dumpMemory());
    }

    public function testReadInputValue()
    {
        $program = new Program([3, 2, 0]);
        $output = [3, 2, 7];
        $input = new InputCommand(new ValueRetriever(), $program, 0, 7, 0);
        $this->assertEquals($output, $input->run($program)->dumpMemory());
    }

    public function testWriteOutputValue()
    {
        $program = new Program([4, 8]);
        $outputs = new Outputs();
        $output = new OutputCommand(new ValueRetriever(), $program, 0, $outputs, [Value::Absolute]);
        $this->assertEquals($program->dumpMemory(), $output->run($program)->dumpMemory());
        $this->assertEquals([8], $outputs->getOutputs());
    }

    public function testJumpIfTrueWhenTrue()
    {
        $program = new Program([5, 1, 4, 99]);
        $jump = new JumpTrueCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $jump->run($program);
        $this->assertEquals(4, $jump->nextCommand(0));
    }

    public function testJumpIfTrueWhenFalse()
    {
        $program = new Program([5, 0, 4, 99]);
        $jump = new JumpTrueCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $jump->run($program);
        $this->assertEquals(3, $jump->nextCommand(0));
    }

    public function testJumpIfFalseWhenTrue()
    {
        $program = new Program([6, 1, 4, 99]);
        $jump = new JumpFalseCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $jump->run($program);
        $this->assertEquals(3, $jump->nextCommand(0));
    }

    public function testJumpIfFalseWhenFalse()
    {
        $program = new Program([6, 0, 4, 99]);
        $jump = new JumpFalseCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $jump->run($program);
        $this->assertEquals(4, $jump->nextCommand(0));
    }

    public function testLessThanPasses()
    {
        $program = new Program([7, 1, 2, 4, 8]);
        $output = [7, 1, 2, 4, 1];
        $lessThan = new LessThanCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $this->assertEquals($output, $lessThan->run($program)->dumpMemory());
    }

    public function testLessThanFails()
    {
        $program = new Program([7, 2, 1, 4, 8]);
        $output = [7, 2, 1, 4, 0];
        $lessThan = new LessThanCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $this->assertEquals($output, $lessThan->run($program)->dumpMemory());
    }

    public function testEqualsPasses()
    {
        $program = new Program([8, 2, 2, 4, 8]);
        $output = [8, 2, 2, 4, 1];
        $lessThan = new EqualsCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $this->assertEquals($output, $lessThan->run($program)->dumpMemory());
    }

    public function testEqualsFails()
    {
        $program = new Program([8, 2, 1, 4, 8]);
        $output = [8, 2, 1, 4, 0];
        $lessThan = new EqualsCommand(new ValueRetriever(), $program, 0, [Value::Absolute, Value::Absolute]);
        $this->assertEquals($output, $lessThan->run($program)->dumpMemory());
    }
}