<?php

namespace AdventOfCode;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class Answer01Test extends TestCase
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

    public function testOne() {
        $answer = new Answer01($this->logger);
        $this->assertEquals('one', $answer->one(['']));
    }

    public function testTwo() {
        $answer = new Answer01($this->logger);
        $this->assertEquals('two', $answer->two(['']));
    }
}

