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
    'byr' => ['required' => true, 'type' => 'number', 'min' => 1920, 'max' => 2002],
    'iyr' => ['required' => true, 'type' => 'number', 'min' => 2010, 'max' => 2020],
    'eyr' => ['required' => true, 'type' => 'number', 'min' => 2020, 'max' => 2030],
    'hgt' => ['required' => true, 'type' => 'height'],
    'hcl' => ['required' => true, 'type' => 'hexColor'],
    'ecl' => ['required' => true, 'type' => 'eyeColor'],
    'pid' => ['required' => true, 'type' => 'passportNumber'],
    'cid' => ['required' => false],
];

$validPassports = 0;
foreach($normalizedPassports as $passport) {
    if(isValid($fields, $passport)) {
        $validPassports++;
    }
}

printf("Valid passports: %d", $validPassports);

function isValid($fields, $passport) {
    // Check the required fields
    foreach($fields as $fieldName => $validation) {
        if (true === $validation['required']) {
            if (false === stripos($passport, $fieldName.':')) {
                return false;
            }
        }
    }

    // Check the field values
    $parts = explode(' ', $passport);
    foreach($parts as $part) {
        list($fieldName, $value) = explode(':', $part);

        if (false === $fields[$fieldName]['required']) {
            continue;
        }

        $method = 'validate'.ucfirst($fields[$fieldName]['type']);
        if (false === $method($value, $fields[$fieldName])) {
            printf("Value '%s' for '%s' did not pass '%s' (%s)\n", $value, $fieldName, $method, $passport);
            return false;
        }
    }
    
    return true;
}

function validateNumber($value, $options) {
    return (int)$value >= $options['min'] && (int)$value <= $options['max'];
}

function validateHeight($value) {
    if (!(bool)preg_match('`^([0-9]{2,3})(cm|in)$`', $value, $matches)) {
        return false;
    }

    if ($matches[2] === 'cm') {
        return validateNumber($matches[1], ['min' => 150, 'max' => 193]);
    } else {
        return validateNumber($matches[1], ['min' => 59, 'max' => 76]);
    }
}

function validateHexColor($value) {
    return (bool)preg_match('`^#[0-9a-f]{6}$`', $value);
}

function validateEyeColor($value) {
    return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
}

function validatePassportNumber($value) {
    return (bool)preg_match('`^[0-9]{9}$`', $value);
}