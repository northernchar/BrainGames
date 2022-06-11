<?php

namespace BrainGames\Games;

use function BrainGames\Cli\greetings;
use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\Engine;

function brainProgression()
{
    $given = function () {
        $length = rand(5, 10);
        $step = rand(1, 9);
        $missedIndex = rand(0, $length - 1);
        $first = rand(1, 90);
        $prog = $first;
        $result = [];
        $missedValue = 0;

        for ($i = 0; $i < $length; $i += 1) {
            if ($i === $missedIndex) {
                $result[] = '..';
                $missedValue = $prog;
            } else {
                $result[] = $prog;
            }
            $prog += $step;
        }

        return ['progression' => $result, 'missed' => $missedValue];
    };

    $expected = fn($given) => $given['missed'];

    $question = fn($given) => implode(" ", $given["progression"]);

    Engine($given, $expected, $question);
}
