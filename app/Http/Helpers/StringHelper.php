<?php
/**
 | ----------------------------------------------------------------------------
 | Helpers all about String
 |
 | NOTE: This helper loaded by composer.
 |       New helper file should execute `$ composer dump-autoload`
 | ----------------------------------------------------------------------------
 */

/**
 * Replace last occurrence
 * 
 * source: https://stackoverflow.com/questions/3835636/php-replace-last-occurrence-of-a-string-in-a-string
 *
 * TODO: remove, use str_replace_last() laravel's helper instead.
 * 
 * @return string
 */
function str_replace_last_occurrence($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

/**
 * @param int $number
 * @return string
 */
function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
