<?php

namespace AdventOfCode;

class Answer04 extends Base
{
    public function one(array $input)
    {
        $range = trim($input[0]);
        [$start, $end] = explode('-', $range);
        $countValid = 0;
        for ($number = (int)$start; $number <= (int)$end; $number++) {
            if ($this->isValid($number)) {
                $countValid++;
            }
        }
        return $countValid;
    }

    public function two(array $input)
    {
        $range = trim($input[0]);
        [$start, $end] = explode('-', $range);
        $countValid = 0;
        for ($number = (int)$start; $number <= (int)$end; $number++) {
            if ($this->hasSequentialDigits($number) && $this->hasExactlyTwoAdjacentDigits($number)) {
                $countValid++;
            }
        }
        return $countValid;
    }

    public function hasAdjacentDigits($number)
    {
        $digits = (string)$number;
        $lastDigit = null;
        for ($i = 0; $i < strlen($digits); $i++) {
            $digit = $digits[$i];
            if ($lastDigit && $lastDigit === $digit) {
                return true;
            }
            $lastDigit = $digit;
        }
        return false;
    }

    public function hasSequentialDigits($number)
    {
        $lastDigit = null;
        $divisor = 100000;
        while ($divisor >= 1) {
            $digit = floor($number / $divisor);
            $number = ($number % $divisor);
            if ($lastDigit && $lastDigit > $digit) {
                return false;
            }
            $lastDigit = $digit;
            $divisor = $divisor / 10;
        }
        return true;
    }

    public function isValid($number)
    {
        return $this->hasAdjacentDigits($number) && $this->hasSequentialDigits($number);
    }

    public function hasExactlyTwoAdjacentDigits($number)
    {
        $lastDigit = null;
        $divisor = 100000;
        $countAdjacent = 0;
        while ($divisor >= 1) {
            $digit = floor($number / $divisor);
            $number = ($number % $divisor);
            if ($lastDigit && $lastDigit === $digit) {
                $countAdjacent++;
            } elseif ($countAdjacent === 1) {
                return true;
            } else {
                $countAdjacent = 0;
            }
            $lastDigit = $digit;
            $divisor = $divisor / 10;
        }
        if ($countAdjacent === 1) {
            return true;
        }
        return false;
    }

}