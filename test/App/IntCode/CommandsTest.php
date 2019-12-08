<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class CommandsTest extends BaseTest
{
    public function testAddTwoNumbers()
    {
        $program = [1101, 2, 4, 3];
        $output = [1101, 2, 4, 6];
        $add = new AddCommand(new ValueRetriever(), $program, 0, [1, 1]);
        $this->assertEquals($output, $add->run($program));
    }

    public function testMultiplyTwoNumbers()
    {
        $program = [1101, 2, 4, 3];
        $output = [1101, 2, 4, 8];
        $multiply = new MultiplyCommand(new ValueRetriever(), $program, 0, [1, 1]);
        $this->assertEquals($output, $multiply->run($program));
    }

    public function testReadInputValue()
    {
        $program = [3, 2, 0];
        $output = [3, 2, 7];
        $input = new InputCommand(new ValueRetriever(), $program, 0, 7);
        $this->assertEquals($output, $input->run($program));
    }

    public function testWriteOutputValue()
    {
        $program = [4, 2, 8];
        $outputs = new Outputs();
        $output = new OutputCommand(new ValueRetriever(), $program, 0, $outputs);
        $this->assertEquals($program, $output->run($program));
        $this->assertEquals([8], $outputs->getOutputs());
    }
}