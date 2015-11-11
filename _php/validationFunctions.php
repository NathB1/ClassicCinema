<?php

function isDigits($str) {
    $pattern='/^[0-9]+$/';
    return preg_match($pattern, $str);
}

function isEmpty($str) {
    return strlen(trim($str)) == 0;
}

function isEmail($str) {
    // There's a built in PHP tool that has a go at this
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function checkLength($str, $len) {
    return strlen(trim($str)) === $len;
}

function checkCardDetails($cardType, $cardNumber, $cardMonth, $cardYear, $cardVerify) {
    $errors = array();

    $cardType = strtolower($cardType);
    // card number and verification code depends on card type
    if ($cardType === 'visa') {
        if (!isDigits($cardNumber) || !checkLength($cardNumber, 16) || !((int) $cardNumber[0] === 4)) {
            array_push($errors, "Invalid card number");
        }
        if (!isDigits($cardVerify) || !checkLength($cardVerify, 3)) {
            array_push($errors, "Invalid card verification code");
        }
    } elseif ($cardType === 'mcard') {
        if (!isDigits($cardNumber) || !checkLength($cardNumber, 16) || !((int) $cardNumber[0] === 5)) {
            array_push($errors, "Invalid card number");
        }
        if (!isDigits($cardVerify) || !checkLength($cardVerify, 3)) {
            array_push($errors, "Invalid card verification code");
    }

    } elseif ($cardType === 'amex') {
        if (!isDigits($cardNumber) || !checkLength($cardNumber, 15) || !((int) $cardNumber[0] === 3)) {
            array_push($errors, "Invalid card number");
        }
        if (!isDigits($cardVerify) || !checkLength($cardVerify, 4)) {
            array_push($errors, "Invalid card verification code");
        }
    } else {
        array_push($errors, "Unrecognised card type");
    }

    // card expiry date depends on current date
    $year = (int) date('Y');
    $month = (int) date('n');
    $cardYear = (int) $cardYear;
    $cardMonth = (int) $cardMonth;
    if ($year > $cardYear) {
        array_push($errors, "Card expiry must be in the future");
    } elseif ($year === $cardYear && $month >= $cardMonth) {
        array_push($errors, "Card expiry must be in the future");
    }

    return $errors;
}

?>