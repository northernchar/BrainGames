<?php

namespace BrainGames\Games;

use function BrainGames\Cli\greetings;
use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\Engine;

function brainCalc()
{
    $given = function () {
        $first = rand(1, 10);
        $second = rand(1, 10);
        $operations = [
            '+' => fn($a, $b) => $a + $b,
            '-' => fn($a, $b) => $a - $b,
            '*' => fn($a, $b) => $a * $b
        ];
        $operandNum = rand(1, 3);

        switch ($operandNum) {
            case 1:
                $operand = '+';
                break;
            case 2:
                $operand = '-';
                break;
            case 3:
                $operand = '*';
                break;
        }

        return ['operation' => $operations[$operand], 'first' => $first, 'second' => $second, 'operand' => $operand];
    };

    $expected = function ($given) {
        $operation = $given['operation'];
        $first = $given['first'];
        $second = $given['second'];
        return $operation($first, $second);
    };

    $question = function ($given) {
        $operand = $given['operand'];
        $first = $given['first'];
        $second = $given['second'];

        return "{$first} {$operand} {$second}";
    };

    Engine($given, $expected, $question);
}

function brainEven()
{
    $given = fn() => rand(1, 100);

    $expected = function ($given) {
        $isEven = $given % 2 === 0;
        return $isEven ? "yes" : "no";
    };

    $question = fn($given) => $given;
    Engine($given, $expected, $question);
}

function brainGcd()
{
    function gcd($a, $b)
    {
        return ($a % $b) ? gcd($b, $a % $b) : abs($b);
    }

    $given = function () {
        $first = rand(1, 100);
        $second = rand(1, 100);

        return [$first, $second];
    };

    $expected = function ($given) {
        $a = $given[0];
        $b = $given[1];

        return gcd($a, $b);
    };

    $question = function ($given) {
        $a = $given[0];
        $b = $given[1];

        return "{$a} {$b}";
    };

    Engine($given, $expected, $question);
}

function brainProgression()
{
    $given = function () {
        $length = rand(5, 10);
        $step = rand(1, 9);
        $missedIndex = rand(0, $length - 1);
        $first = rand(1, 90);
        $result = [];

        for ($i = 0; $i < $length; $i += 1) {
            $result[] = $i === $missedIndex ? '..' : $first;
            $first += $step;
        }

        if ($missedIndex !== 0) {
            $missedValue = $result[$missedIndex - 1] + $step;
        } else {
            $missedValue = $first;
        }

        return ['progression' => $result, 'missed' => $missedValue];
    };

    $expected = fn($given) => $given['missed'];

    $question = fn($given) => implode(" ", $given["progression"]);

    Engine($given, $expected, $question);
}

function brainPrime()
{
    function isPrime($num)
    {
        if ($num < 2 || $num === 4) {
            return false;
        }

        if ($num === 2 || $num === 3) {
            return true;
        }

        for ($i = 5; $i < $num; $i += 1) {
            if ($num % $i === 0) {
                return false;
            }
        }

        return true;
    }

    $given = fn() => rand(1, 100);

    $expected = function ($given) {

        return isPrime($given) ? "yes" : "no";
    };

    $question = fn($given) => $given;

    Engine($given, $expected, $question);
}
