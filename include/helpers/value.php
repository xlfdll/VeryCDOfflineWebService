<?php

$byteAbbreviations = ["B", "KB", "MB", "GB"];

function getHumanReadableSize($size, $precision)
{
    global $byteAbbreviations;

    if ($size != 0) {
        $order = intval(floor(log($size, 1024)));
        $size /= pow(1024, $order);

        return number_format($size, $precision) . " " . $byteAbbreviations[$order];
    } else {
        return number_format($size, $precision) . " " . $byteAbbreviations[0];
    }
}