
<?php
// Load the passwords
$passwordData = explode("\n", file_get_contents('input.txt'));

// Check each password
$goodPasswords = 0;
foreach($passwordData as $password) {
    if (preg_match('/([0-9]+)\-([0-9]+)\ ([a-z]{1})\:\ ([a-z]+)/i', $password, $matches)) {
        $pass = $matches[4];
        $char = $matches[3];
        $checkChar1 = substr($pass, $matches[1]-1, 1);
        $checkChar2 = substr($pass, $matches[2]-1, 1);
        if ($checkChar1 !== $checkChar2 && ($checkChar1 === $char || $checkChar2 === $char)) {
            $goodPasswords++;
        }
    } else {
        printf("Couldn't parse: %s\n", $password);
    }
}

printf("%s passwords met the requirements.", $goodPasswords);