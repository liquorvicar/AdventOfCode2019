<?php

namespace AdventOfCode\App;

use AdventOfCode\BaseTest;

class IntCodeTest extends BaseTest
{

    /**
     * @dataProvider dataForOne
     */
    public function testProgram($program, $result)
    {
        $computer = new IntCode($this->logger);
        $this->assertEquals($result, $computer->runProgram($program));
    }

    public function dataForOne()
    {
        return [
            [[1,9,10,3,2,3,11,0,99,30,40,50], 3500],
            [[1,0,0,0,99], 2],
            [[2,3,0,3,99], 2],
            [[2,4,4,5,99,0], 2],
            [[1,1,1,4,99,5,6,0,99], 30],
            [[1101,100,-1,0,0], 99],
        ];
    }

    public function testReadsInput()
    {
        $computer = new IntCode($this->logger);
        $this->assertEquals(5, $computer->runProgram([3, 0, 99], [5]));
    }

    public function testOutputsValue()
    {
        $computer = new IntCode($this->logger);
        $computer->runProgram([4, 3, 99, 127], []);
        $this->assertEquals([127], $computer->getOutputs());
    }

    public function testParsesCommand()
    {
        $input = 11003;
        $computer = new IntCode($this->logger);
        [$command, $modes] = $computer->parseCommand($input);
        $this->assertEquals(3, $command);
        $this->assertEquals([0, 1, 1], $modes);
    }

    public function testRespectsModes()
    {
        $program = [1002,4,3,0,33];
        $computer = new IntCode($this->logger);
        $this->assertEquals(99, $computer->runProgram($program));
    }
}
