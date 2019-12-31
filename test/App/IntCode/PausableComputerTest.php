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
        $outputs = $computer->runToTermination();
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

    /**
     * @dataProvider dataForLargeNumbers
     */
    public function testLargeNumbers($memory, $expected)
    {
        $computer = new PausableComputer($this->logger, 'Test', $memory);
        $computer->addInput(0);
        $outputs = $computer->runToTermination();
        $this->assertEquals($expected, $outputs);

    }

    public function dataForLargeNumbers()
    {
        return [
            [[109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99], [109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99]],
            [[1102,34915192,34915192,7,4,7,99,0], [1219070632396864]],
            [[104,1125899906842624,99], [1125899906842624]],
        ];
    }

    /**
     * @dataProvider dataForRelativeInput
     */
    public function testProcessesRelativeInput($memory, $input, $output)
    {
        $computer = new PausableComputer($this->logger, 'Test', $memory);
        $computer->addInput($input);
        $outputs = $computer->runToTermination();
        $this->assertEquals([$output], $outputs);
    }

    public function dataForRelativeInput()
    {
        return [
            [[109, 2, 204, 0, 99], 0, 204],
            [[109, 4, 203, 3, 4, 7, 99, 0], 12, 12],
            [[109, -1, 4, 1, 99], 0, -1],
            [[109, -1, 104, 1, 99], 0, 1],
            [[109, -1, 204, 1, 99], 0, 109],
            [[109, 1, 9, 2, 204, -6, 99], 0, 204],
            [[109, 1, 109, 9, 204, -6, 99], 0, 204],
            [[109, 1, 209, -1, 204, -106, 99], 37, 204],
            [[109, 1, 3, 3, 204, 2, 99], 37, 37],
            [[109, 1, 203, 2, 204, 2, 99], 23, 23],

        ];
    }
}