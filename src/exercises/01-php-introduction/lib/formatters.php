<?php

function formatPhoneNumber($number) {
    // Remove non-numeric characters
    $clean = preg_replace('/[^0-9]/', '', $number);

    // Format as (XXX) XXX-XXXX if 10 digits
    if (strlen($clean) === 10) {
        return "(" . substr($clean, 0, 3) . ") " .
               substr($clean, 3, 3) . "-" .
               substr($clean, 6);
    }

    return $number; // return original if invalid length
}

?>
