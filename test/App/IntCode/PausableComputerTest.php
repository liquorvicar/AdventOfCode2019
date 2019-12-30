<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class PausableComputerTest extends BaseTest
{

    public function testRunsUntilOutput()
    {
        $program = [4, 5, 4, 6, 99, 127, 345];
        $computer = new PausableComputer($this->logger, 'Test', $program);
        $outputs[] = $computer->run();
        $outputs[] = $computer->run();
        $this->assertEquals([127, 345], $outputs);
        $terminated = $computer->run();
        $this->assertTrue($terminated);
    }

    /**
     * @dataProvider dataForCompare
     */
    public function testCompare($program, $input, $expected)
    {
        $computer = new PausableComputer($this->logger, 'Test', $program);
        $computer->addInput($input);
        $terminate = false;
        $outputs = [];
        while (!$terminate) {
            $output = $computer->run();
            if ($output === true) {
                $terminate = true;
            } else {
                $outputs[] = $output;
            }
        }
        $this->assertEquals([$expected], $outputs);

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