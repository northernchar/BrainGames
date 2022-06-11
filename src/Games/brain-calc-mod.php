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
            default:
                $operand = '+';
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
