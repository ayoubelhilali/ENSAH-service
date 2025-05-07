<?php
function isValidPhone($phone)
{
    // Remove any spaces or hyphens just in case
    $phone = str_replace([' ', '-'], '', $phone);

    // Regular expression: starts with 6 or 7, followed by exactly 7 digits (total 8 digits)
    return preg_match('/^[67][0-9]{8}$/', $phone);
}