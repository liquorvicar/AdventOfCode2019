<?php

namespace AdventOfCode\App\IntCode;

class CommandParser
{
    private $modes = [];

    /**
     * @var ValueRetriever
     */
    private $valueRetriever;
    /**
     * @var array
     */
    private $inputs;
    /**
     * @var Outputs
     */
    private $outputs;

    public function __construct(array $inputs, Outputs $outputs)
    {
        $this->valueRetriever = new ValueRetriever();
        $this->inputs = $inputs;
        $this->outputs = $outputs;
    }

    public function parse(array $program, int $position): Command
    {
        if (!isset($program[$position])) {
            throw new \RuntimeException(sprintf('Command not found at %d', $position));
        }
        $commandVal = $program[$position];
        $this->modes = [];
        $commandVal = $commandVal % 10000;
        $this->modes[] = (int)floor($commandVal / 1000);
        $commandVal = $commandVal % 1000;
        array_unshift($this->modes, (int)floor($commandVal / 100));
        $commandVal = $commandVal % 100;
        switch ($commandVal) {
            case 1:
                return new AddCommand($this->valueRetriever, $program, $position, $this->modes);
                break;
            case 2:
                return new MultiplyCommand($this->valueRetriever, $program, $position, $this->modes);
                break;
            case 3:
                return new InputCommand($this->valueRetriever, $program, $position, (int)array_shift($this->inputs));
                break;
            case 4:
                return new OutputCommand($this->valueRetriever, $program, $position, $this->outputs, $this->modes);
                break;
            case 5:
                return new JumpTrueCommand($this->valueRetriever, $program, $position, $this->modes);
                break;
            case 6:
                return new JumpFalseCommand($this->valueRetriever, $program, $position, $this->modes);
                break;
            case 7:
                return new LessThanCommand($this->valueRetriever, $program, $position, $this->modes);
                break;
            case 8:
                return new EqualsCommand($this->valueRetriever, $program, $position, $this->modes);
                break;
            case 99:
                return new TerminateCommand();
                break;
            default:
                throw new \RuntimeException(sprintf('Unknown Command %d not found at %d', $commandVal, $position));
        }
    }

    public function getModes(): array
    {
        return $this->modes;
    }

    public function getInputs(): array
    {
        return $this->inputs;
    }
}
