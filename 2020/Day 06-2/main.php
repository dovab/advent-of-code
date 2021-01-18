<?php

// Load the input
$answers = explode("\r\n", file_get_contents('input.txt'));

$groupsUnanimousAnswers = [];
$groupAnswers = [];
foreach($answers as $answer) {
    if('' === trim($answer)) {

        $groupsUnanimousAnswers[] = getAmountOfUnanimousAnswers($groupAnswers);
        $groupAnswers = [];
        continue;
    }

    $currentAnswers = str_split($answer);
    $groupAnswers[] = $currentAnswers;
}

// Add the last entry
$groupsUnanimousAnswers[] = getAmountOfUnanimousAnswers($groupAnswers);

printf("The answer is: %d", array_sum($groupsUnanimousAnswers));

function getAmountOfUnanimousAnswers($groupAnswers) {
    $unanimousAnswers = [];
    if(count($groupAnswers) === 1) {
        return count($groupAnswers[0]);
    }

    foreach($groupAnswers[0] as $firstAnswer) {
        foreach($groupAnswers as $checkAnswers) {
            if (!in_array($firstAnswer, $checkAnswers)) {
                continue 2;
            }
        }

        $unanimousAnswers[] = $firstAnswer;
    }

    return count($unanimousAnswers);
}