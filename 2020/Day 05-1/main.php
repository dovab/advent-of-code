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

$highestSeatId = 0;
foreach($seats as $seat) {
    $seatData = decodeSeatIdentifier($seat);
    if ($seatData['seatId'] > $highestSeatId) {
        $highestSeatId = $seatData['seatId'];
    }
}

printf("Highest seatId: %d", $highestSeatId);