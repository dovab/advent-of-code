<?php

// Load the numbers into an array
$numbers = explode("\n", file_get_contents('input.txt'));

// Sort the array by number
sort($numbers, SORT_NUMERIC);

// Loop through the numbers, checking the requirements
foreach($numbers as $index => $number) {
    for($i = count($numbers)-1; $i >= $index; $i--) {
        for($j = count($numbers)-1; $j >= $index; $j--) {
            if (($number + $numbers[$i] + $numbers[$j]) === 2020) {
                printf("The correct values are: %d, %d and %d. The answer is: %d", $number, $numbers[$i], $numbers[$j], ($number * $numbers[$i] * $numbers[$j]));
                die;
            }
        }
    }
}

var_dump($numbers);