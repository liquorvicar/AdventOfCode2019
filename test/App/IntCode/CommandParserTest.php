<?php

namespace AdventOfCode\App\IntCode;

use AdventOfCode\BaseTest;

class CommandParserTest extends BaseTest
{
    public function testThrowsIfCommandValOutOfRange()
    {
        $commands = new CommandParser([], new Outputs());
        $program = [];
        $this->expectException(\RuntimeException::class);
        $commands->parse($program, 0);
    }

    /**
     * @dataProvider dataForParsesCommands
     */
    public function testParsesCommand($program, $expectedCommand)
    {
        $commands = new CommandParser([0], new Outputs());
        $command = $commands->parse($program, 0);
        $this->assertEquals($expectedCommand, get_class($command));
    }

    public function dataForParsesCommands()
    {
        return [
            [[1, 0, 0, 0], AddCommand::class],
            [[2, 0, 0, 0], MultiplyCommand::class],
            [[3, 0, 0, 0], InputCommand::class],
            [[4, 0, 0, 0], OutputCommand::class],
            [[5, 0, 0, 0], JumpTrueCommand::class],
            [[6, 0, 0, 0], JumpFalseCommand::class],
            [[7, 0, 0, 0], LessThanCommand::class],
            [[8, 0, 0, 0], EqualsCommand::class],
            [[99, 0, 0, 0], TerminateCommand::class],
        ];
    }

    /**
     * @dataProvider dataForParsesModes
     */
    public function testParsesModes($program, $expectedModes)
    {
        $commands = new CommandParser([], new Outputs());
        $commands->parse($program, 0);
        $this->assertEquals($expectedModes, $commands->getModes());
    }

    public function dataForParsesModes()
    {
        return [
            [[1], [0, 0]],
            [[101], [1, 0]],
            [[1101], [1, 1]],
            [[1001], [0, 1]],
        ];
    }
}
