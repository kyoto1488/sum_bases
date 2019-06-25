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


function toDecimal($base)
{
    return function ($str) use ($base) {
        $num = 0;

        for ($i = strlen($str) - 1, $p = 0; $i >= 0; --$i, ++$p) {
            if (toOrd($str[$i]) >= $base) {
                return 'Incorrect number';
            }
            $num += toOrd($str[$i]) * pow($base, $p);
        }
        return $num;
    };
}

function toChar($decimal)
{
    if ($decimal >= 0 && $decimal <= 9) {
        return chr($decimal + ord('0'));
    } else {
        return chr($decimal - 10 + ord('A'));
    }
}

function toBase($base)
{
    return function ($number) use($base) {
        $result = '';

        while ($number > 0) {
            $result .= toChar($number % $base);
            $number = (int)($number / $base);
        }
        $result = strrev($result);
        return $result;
    };
}


function sumBase36($lOperand, $rOperand)
{
    $toDecimalBase36 = toDecimal(36);
    $decimalL = $toDecimalBase36($lOperand);
    $decimalR = $toDecimalBase36($rOperand);
    $toBase36 = toBase(36);
    return $toBase36($decimalL + $decimalR);
}

echo 'Base36: Z + 1 = ' . sumBase36('Z', '1') . PHP_EOL;
echo 'Base36: 9 + 1 = ' . sumBase36('9', '1') . PHP_EOL;
