<?php

namespace BrainGames\Games;

use function BrainGames\Cli\greetings;
use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\Engine;

function gcd(int $a, int $b): int
{
    $isGcd = ($a % $b);
    if ($isGcd !== 0) {
        return gcd($b, $a % $b);
    } else {
        return abs($b);
    }
}

function brainGcd()
{

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