
<?php
// Load the map
$mapData = explode("\r\n", file_get_contents('input.txt'));

// Variables
$amountOfTrees = 0;
$amountOfDots = 0;
$xPos = 0;

foreach($mapData as $yPos => $mapLine) {
    // Skip the first line, since we basically start counting at the second line
    if ($yPos === 0) {
        continue;
    }

    // Calculate the current x-position, taking into account the map restarts after ending the line
    $xPos = $yPos * 3;
    while ($xPos > strlen($mapLine)-1) {
        $xPos -= strlen($mapLine);
    }

    if ('#' === substr($mapLine, $xPos, 1)) {
        $amountOfTrees++;
    } else {
        $amountOfDots++;
    }
}

printf("Encountered %d trees", $amountOfTrees);