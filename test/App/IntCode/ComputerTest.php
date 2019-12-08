<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class ComputerTest extends BaseTest
{

    /**
     * @dataProvider dataForOne
     */
    public function testProgram($program, $result)
    {
        $computer = new Computer($this->logger, []);
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
            [[1101,30,-1,0,99], 29],
        ];
    }

    public function testReadsInput()
    {
        $computer = new Computer($this->logger, [5]);
        $this->assertEquals(5, $computer->runProgram([3, 0, 99]));
    }

    public function testOutputsValue()
    {
        $computer = new Computer($this->logger, []);
        $computer->runProgram([4, 3, 99, 127]);
        $this->assertEquals([127], $computer->getOutputs());
    }
}
