<?php
require_once 'vendor/autoload.php';

$day = 1;
$inputFilename = './input/01.txt';

if (!file_exists($inputFilename)) {
    throw new Exception('Cannot find input file.');
}

$input = file($inputFilename);

$logger = new Monolog\Logger('Advent of Code challenge');
$class = sprintf('AdventOfCode\Answer%02d', $day);
$answer = new $class($logger);

$options = getopt('p:');

if (isset($options['p']) && $options['p'] === 'two') {
    echo $answer->two($input);
} else {
    echo $answer->one($input);
}
echo "\n";
