<?php

namespace BrainGames\Games;

use function BrainGames\Cli\greetings;
use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\Engine;

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
