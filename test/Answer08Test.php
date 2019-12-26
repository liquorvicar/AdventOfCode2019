<?php


namespace AdventOfCode;


class Answer08Test extends BaseTest
{

    public function testParseInput()
    {
        $answer = new Answer08($this->logger);
        $input = '123456789012';
        $layers = [
            1 => [
                [1, 2, 3,],
                [4, 5, 6,],
            ],
            2 => [
                [7, 8, 9,],
                [0, 1, 2,],
            ],
        ];
        $this->assertEquals($layers, $answer->parseSIF($input, 3, 2));
    }

    public function testFindChecksumLayer()
    {
        $answer = new Answer08($this->logger);
        $layers = [
            1 => [
                [1, 2, 3,],
                [4, 5, 6,],
            ],
            2 => [
                [7, 8, 9,],
                [0, 1, 2,],
            ],
        ];
        $this->assertEquals(1, $answer->findChecksumLayer($layers));
    }

    public function testCalcLayerChecksum()
    {
        $answer = new Answer08($this->logger);
        $layer =[
            [1, 2, 3,],
            [4, 5, 6,],
        ];
        $this->assertEquals(1, $answer->calcLayerChecksum($layer));
    }

    public function testCombineLayers()
    {
        $answer = new Answer08($this->logger);
        $layers = [
            [
                [0, 2,],
                [2, 2,],
            ],
            [
                [1, 1,],
                [2, 2,],
            ],
            [
                [2, 2,],
                [1, 2,],
            ],
            [
                [0, 0,],
                [0, 0,],
            ],
        ];
        $combined = [
            [
                [0, 1, 2, 0,],
                [2, 1, 2, 0,],
            ],
            [
                [2, 2, 1, 0],
                [2, 2, 2, 0],
            ],
        ];
        $this->assertEquals($combined, $answer->combineLayers($layers, 2, 2));
    }

    public function testFlattenLayers()
    {
        $answer = new Answer08($this->logger);
        $combined = [
            [
                [0, 1, 2, 0,],
                [2, 1, 2, 0,],
            ],
            [
                [2, 2, 1, 0],
                [2, 2, 2, 0],
            ],
        ];
        $flattened = [
            [0, 1],
            [1, 0],
        ];
        $this->assertEquals($flattened, $answer->flatten($combined));
    }
}