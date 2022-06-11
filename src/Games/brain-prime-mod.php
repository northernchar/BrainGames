<?php

namespace BrainGames\Games;

use function BrainGames\Cli\greetings;
use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\Engine;

function isPrime(int $num): bool
{
    for ($i = 2; $i < $num; $i += 1) {
        if ($num % $i === 0) {
            return false;
        }
    }
    return true;
}

function brainPrime()
{


    $given = fn() => rand(1, 100);

    $expected = function ($given) {

        return isPrime($given) ? "yes" : "no";
    };

    $question = fn($given) => $given;

    Engine($given, $expected, $question);
}
