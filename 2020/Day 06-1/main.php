<?php

// Load the input
$answers = explode("\r\n", file_get_contents('input.txt'));

$groupsUniqueAnswers = [];
$groupAnswers = [];
foreach($answers as $answer) {
    if('' === trim($answer)) {
        $groupsUniqueAnswers[] = count(array_unique($groupAnswers));
        $groupAnswers = [];
        continue;
    }

    $currentAnswers = str_split($answer);
    $groupAnswers = array_merge($groupAnswers, $currentAnswers);
}

// Add the last entry
$groupsUniqueAnswers[] = count(array_unique($groupAnswers));

printf("The answer is: %d", array_sum($groupsUniqueAnswers));