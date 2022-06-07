<?php

namespace BrainGames\Engine;

use function BrainGames\Cli\greetings;
use function cli\line;
use function cli\prompt;

function Engine(?callable $givenFunc, ?callable $expectedFunc, ?callable $questionFunc)
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    $tries = 3;

    for ($i = 0; $i < $tries; $i += 1) {
        $given = $givenFunc() ?? null;
        $expected = $expectedFunc($given) ?? null;
        $question = $questionFunc($given) ?? null;
        line("Question: {$question}");
        $result = prompt("Your answer");
        $isCorrect = $result === "{$expected}";
        if (!$isCorrect) {
            $failMessage = "'{$result}' is wrong answer ;(. Correct answer was '{$expected}'";
            line($failMessage);
            line("Let's try again, {$name}!");
            return;
        }
        line('Correct!');
    }
    line("Congratulations, {$name}!");
}
