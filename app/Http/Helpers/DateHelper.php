<?php
/**
 | ----------------------------------------------------------------------------
 | Helpers all about Date
 |
 | NOTE: (1) This helper loaded by composer.
 |           New helper file should execute `$ composer dump-autoload`
 |
 |       (2) Helper is registered in composer.json under 'autoload' > 'files' key
 | ----------------------------------------------------------------------------
 */

/**
 * @param $format string            valid date() function format
 * @param $str_date string|null     date in string
 */
function str_to_date($format, $str_date) {
    if ($str_date) return date($format, strtotime($str_date));
    return null;
}
