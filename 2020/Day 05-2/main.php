<?php

function decodeSeatIdentifier($identifier) {
    $seatIdentifier = str_replace(['F', 'B', 'R', 'L'], ['0', '1', '1', '0'], $identifier);
    $row = bindec(substr($seatIdentifier, 0, 7));
    $column = bindec(substr($seatIdentifier, 7, 3));

    return [
        'row' => $row,
        'column' => $column,
        'seatId' => ($row * 8) + $column,
    ];
}

$seats = explode("\r\n", file_get_contents('input.txt'));

$seatIds = [];
foreach($seats as $seat) {
    $seatData = decodeSeatIdentifier($seat);
    $seatIds[] = $seatData['seatId'];
}

sort($seatIds);
for($i = 1; $i < count($seatIds); $i++) {
    if ($seatIds[$i-1] !== $seatIds[$i] - 1) {
        printf("My seatId is: %d\n", $seatIds[$i]-1);
    }
}