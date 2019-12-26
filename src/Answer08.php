<?php


namespace AdventOfCode;


class Answer08 extends Base
{
    public function one(array $input)
    {
        $layers = $this->parseSIF(trim($input[0]), 25, 6);
        $this->logger->info('Found layers', ['count' => count($layers)]);
        $checksumLayer = $this->findChecksumLayer($layers);
        $this->logger->info('Checksum layer', ['checksum' => $checksumLayer]);
        return $this->calcLayerChecksum($layers[$checksumLayer]);
    }

    public function two(array $input)
    {
        $layers = $this->parseSIF(trim($input[0]), 25, 6);
        $this->logger->info('Found layers', ['count' => count($layers)]);
        $combined = $this->combineLayers($layers, 25, 6);
        $flattened = $this->flatten($combined);
        foreach ($flattened as $row) {
            echo implode(' ', $row) . PHP_EOL;
        }
    }

    public function parseSIF(string $input, int $cols, int $rows)
    {
        $digits = array_map(function (string $digit) {
            return (int)$digit;
        }, str_split($input));
        $layers = [
            1 => []
        ];
        $layer = 1;
        $col = 0;
        $row = 0;
        foreach ($digits as $digit) {
            $layers[$layer][$row][] = $digit;
            $col++;
            if ($col === $cols) {
                $row++;
                $col = 0;
            }
            if ($row === $rows) {
                $layer++;
                $row = 0;
            }
        }
        return $layers;
    }

    public function findChecksumLayer(array $layers)
    {
        $layer = 0;
        $numZeros = null;
        foreach ($layers as $layerNum => $digits) {
            $zeros = 0;
            foreach ($digits as $row) {
                $zeros += array_sum(array_map(function ($digit) {
                    return $digit === 0 ? 1 : 0;
                }, $row));
            }
            if (is_null($numZeros) || $zeros < $numZeros) {
                $layer = $layerNum;
                $numZeros = $zeros;
            }
        }
        return $layer;
    }

    public function calcLayerChecksum(array $layer)
    {
        $countOnes = 0;
        $countTwos = 0;
        foreach ($layer as $row) {
            foreach ($row as $digit) {
                if ($digit === 1) {
                    $countOnes++;
                } elseif ($digit === 2) {
                    $countTwos++;
                }
            }
        }
        return $countOnes * $countTwos;
    }

    public function combineLayers(array $layers, int $cols, int $rows)
    {
        $combined = [];
        for ($row = 0; $row < $rows; $row++) {
            for ($col = 0; $col < $cols; $col++) {
                foreach ($layers as $layer) {
                    $combined[$row][$col][] = $layer[$row][$col];
                }
            }
        }
        return $combined;
    }

    public function flatten(array $combined)
    {
        $flattened = [];
        foreach ($combined as $rowNum => $row) {
            foreach ($row as $colNum => $digit) {
                $value = array_reduce($digit, function ($value, $layerValue) {
                    if (!is_null($value)) {
                        return $value;
                    }
                    if ($layerValue !== 2) {
                        return $layerValue;
                    }
                    return $value;
                }, null);
                $flattened[$rowNum][$colNum] = $value;
            }
        }
        return $flattened;
    }
}
