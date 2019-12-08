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

    /**
     * @dataProvider dataForCompare
     */
    public function testCompare($program, $input, $output)
    {
        $computer = new Computer($this->logger, [$input]);
        $computer->runProgram($program);
        $this->assertEquals([$output], $computer->getOutputs());

    }

    public function dataForCompare()
    {
        return [
            [[3,9,8,9,10,9,4,9,99,-1,8], 8, 1],
            [[3,9,8,9,10,9,4,9,99,-1,8], 9, 0],
            [[3,9,7,9,10,9,4,9,99,-1,8], 7, 1],
            [[3,9,7,9,10,9,4,9,99,-1,8], 8, 0],
            [[3,3,1108,-1,8,3,4,3,99], 8, 1],
            [[3,3,1108,-1,8,3,4,3,99], 7, 0],
            [[3,3,1107,-1,8,3,4,3,99], 7, 1],
            [[3,3,1107,-1,8,3,4,3,99], 8, 0],
            [[3,12,6,12,15,1,13,14,13,4,13,99,-1,0,1,9], 0, 0],
            [[3,12,6,12,15,1,13,14,13,4,13,99,-1,0,1,9], 10, 1],
            [[3,3,1105,-1,9,1101,0,0,12,4,12,99,1], 0, 0],
            [[3,3,1105,-1,9,1101,0,0,12,4,12,99,1], 10, 1],
            [[3,21,1008,21,8,20,1005,20,22,107,8,21,20,1006,20,31,
                1106,0,36,98,0,0,1002,21,125,20,4,20,1105,1,46,104,
                999,1105,1,46,1101,1000,1,20,4,20,1105,1,46,98,99], 7, 999],
            [[3,21,1008,21,8,20,1005,20,22,107,8,21,20,1006,20,31,
                1106,0,36,98,0,0,1002,21,125,20,4,20,1105,1,46,104,
                999,1105,1,46,1101,1000,1,20,4,20,1105,1,46,98,99], 8, 1000],
            [[3,21,1008,21,8,20,1005,20,22,107,8,21,20,1006,20,31,
                1106,0,36,98,0,0,1002,21,125,20,4,20,1105,1,46,104,
                999,1105,1,46,1101,1000,1,20,4,20,1105,1,46,98,99], 9, 1001],
        ];
    }
}
