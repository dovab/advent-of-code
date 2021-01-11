
<?php
// Load the passwords
$passwordData = explode("\n", file_get_contents('input.txt'));

// Check each password
$goodPasswords = 0;
foreach($passwordData as $password) {
    if (preg_match('/([0-9]+)\-([0-9]+)\ ([a-z]{1})\:\ ([a-z]+)/i', $password, $matches)) {
        $characterCount = substr_count($matches[4], $matches[3]);
        if ($characterCount >= $matches[1] && $characterCount <= $matches[2]) {
            $goodPasswords++;
        }
    } else {
        printf("Couldn't parse: %s\n", $password);
    }
}

printf("%s passwords met the requirements.", $goodPasswords);