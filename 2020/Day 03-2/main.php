
<?php
// Load the map
$mapData = explode("\r\n", file_get_contents('input.txt'));

function calculateTrees($mapData, $rightSteps, $downSteps) {
    // Variables
    $amountOfTrees = 0;
    $xPos = 0;

    foreach($mapData as $yPos => $mapLine) {
        // Skip the lines according to the downSteps
        if ($yPos === 0 || $yPos % $downSteps !== 0) {
            continue;
        }

        // Calculate the current x-position, taking into account the map restarts after ending the line
        $xPos += $rightSteps;
        while ($xPos >= strlen($mapLine)) {
            $xPos -= strlen($mapLine);
        }
        //printf("MAP: %s, X: %d, Y: %d, DEBUG: %s\n", $mapLine, $xPos, $yPos, substr($mapLine, $xPos, 1));

        if ('#' === substr($mapLine, $xPos, 1)) {
            $amountOfTrees++;
        }
    }

    printf("RIGHT: %d, DOWN: %d, Encountered %d trees\n", $rightSteps, $downSteps, $amountOfTrees);
    return $amountOfTrees;
}

$slopes = [
    [1, 1],
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2],
];
$total = 1;
foreach($slopes as $slope) {
    $total *= calculateTrees($mapData, $slope[0], $slope[1]);
}

printf("The answer is: %d", $total);

