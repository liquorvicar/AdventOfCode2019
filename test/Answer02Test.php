<?php

namespace AdventOfCode;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class Answer02Test extends TestCase
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function setUp(): void
    {
        parent::setUp();
        $this->logger = new Logger('AoC Test logger');
    }

    /**
     * @dataProvider dataForOne
     */
    public function testOne($program, $result)
    {
        $answer = new Answer02($this->logger);
        $this->assertEquals($result, $answer->runProgram($program));
    }

    public function dataForOne()
    {
        return [
            [[1,9,10,3,2,3,11,0,99,30,40,50], 3500],
            [[1,0,0,0,99], 2],
            [[2,3,0,3,99], 2],
            [[2,4,4,5,99,0], 2],
            [[1,1,1,4,99,5,6,0,99], 30],
        ];
    }
}
