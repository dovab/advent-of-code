<?php

// Load the numbers into an array
$numbers = explode("\n", file_get_contents('input.txt'));

// Sort the array by number
sort($numbers, SORT_NUMERIC);

// Loop through the numbers, checking the requirements
foreach($numbers as $index => $number) {
    for($i = count($numbers)-1; $i >= $index; $i--) {
        if (($number + $numbers[$i]) === 2020) {
            printf("The correct values are: %d and %d. The answer is: %d", $number, $numbers[$i], ($number * $numbers[$i]));
            die;
        }
    }
}

var_dump($numbers);