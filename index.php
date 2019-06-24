<?php

function toOrd($char)
{
    $dec = ord($char);

    if ($dec >= ord('0') && $dec <= ord('9')) {
        return $dec - ord('0');
    } else {
        return $dec - ord('A') + 10;
    }
}

function toDecimal($str, $base)
{
    $num = 0;

    for ($i = strlen($str) - 1, $p = 0; $i >= 0; --$i, ++$p) {
        if (toOrd($str[$i]) >= $base) {
            return 'Incorrect number';
        }
        $num += toOrd($str[$i]) * pow($base, $p);
    }
    return $num;
}

function toChar($decimal)
{
    if ($decimal >= 0 && $decimal <= 9) {
        return chr($decimal + ord('0'));
    } else {
        return chr($decimal - 10 + ord('A'));
    }
}

function toBase($number, $base)
{
    $result = '';

    while ($number > 0) {
        $result .= toChar($number % $base);
        $number = (int)($number / $base);
    }
    $result = strrev($result);
    return $result;
}

function sumBase36($lOperand, $rOperand)
{
    $decimalL = toDecimal($lOperand, 36);
    $decimalR = toDecimal($rOperand, 36);
    return toBase($decimalL + $decimalR, 36);
}

echo 'Base36: Z + 1 = ' . sumBase36('Z', '1') . PHP_EOL;
echo 'Base36: 9 + 1 = ' . sumBase36('9', '1') . PHP_EOL;
