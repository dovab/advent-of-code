<?php

// Load the data
$rawPassportData = explode("\r\n", file_get_contents('input.txt'));

// Normalize the data
$normalizedPassports = [];
$currentPassport = '';
foreach ($rawPassportData as $rawPassportLine) {
    if ('' === trim($rawPassportLine)) {
        $normalizedPassports[] = trim($currentPassport);
        $currentPassport = '';
    }

    $currentPassport .= ' ' . $rawPassportLine;
}
// Add the last passport
$normalizedPassports[] = trim($currentPassport);

$fields = [
    ['byr', true],
    ['iyr', true],
    ['eyr', true],
    ['hgt', true],
    ['hcl', true],
    ['ecl', true],
    ['pid', true],
    ['cid', false],
];

$validPassports = 0;
foreach($normalizedPassports as $passport) {
    if(isValid($fields, $passport)) {
        $validPassports++;
    }
}

printf("Valid passports: %d", $validPassports);

function isValid($fields, $passport) {
    preg_match_all('`([a-z]{3})\:(.*?)\ ?`', $passport, $matches);

    foreach($fields as $field) {
        if (true === $field[1]) {
            if(!in_array($field[0], $matches[1])) {
                return false;
            }
        }
    }
    
    return true;
}