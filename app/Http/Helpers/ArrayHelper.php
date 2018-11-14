<?php
/**
 | ----------------------------------------------------------------------------
 | Helpers all about Array
 |
 | NOTE: This helper loaded by composer.
 |       New helper file should execute `$ composer dump-autoload`
 | ----------------------------------------------------------------------------
 */

 /**
  * Combine arrays
  * 
  * Usage:
  *     array_join([2018, 2018], ['Oct', 'Nov'], [20, 25])
  *
  * Example:
  *     Input:
  *         array #1: [2018, 2018],
  *         array #2: [Oct, Nov],
  *         array #3: [20, 25],
  *     Output:
  *         [
  *             [2018, Oct, 20],
  *             [2018, Nov, 25],
  *         ]
  * 
  * @author yudisupriyadi123 (github)
  */
function array_join() {
    // HEADER PART
    $num_args = func_num_args();
    $args = func_get_args();

    foreach ($args as $arg) {
        if (false == is_array($arg)) trigger_error('Your argument contains non-array');
    }

    // MAIN PART
    // fetch first array in arguments, then get the array size.
    $array_size = func_get_arg(0);

    $new_array = [];
    for ($i = 0; $i < $array_size; $i++) {
        // array has array in index $i
        $new_array[$i] = [];
        foreach ($args as $arg) {
            // at $i child array, push element (arg) that is array
            array_push($new_array[$i], $arg);
        }
    }

    return $new_array;
}

/**
 * Filter null element from array
 *
 * @param $array    (pass by reference) array to be filtered
 *
 * @return void
 */
function array_filter_null_element(&$array) {
    $array = array_where($array, function ($value, $key) {
        return $value !== null;
    });
}

/**
 * Array to query parameter
 *
 * Used in TrelloHelper.php
 */
function array_to_query_params($array) {
    $query_params = [];
    foreach ($array as $key => $val) {
        array_push($query_params, "$key=$val");
    }

    return join('&', $query_params);
}
