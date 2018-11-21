<?php
/**
 | ----------------------------------------------------------------------------
 | Helpers all about Termin
 |
 | NOTE: (1) This helper loaded by composer.
 |           New helper file should execute `$ composer dump-autoload`
 |
 |       (2) Helper is registered in composer.json under 'autoload' > 'files' key
 | ----------------------------------------------------------------------------
 */


/**
 * Get remaining amount client should pay for one termin.
 * This script used by invoice-print.blade.php
 * 
 * Example: 
 *  I have a termin_detail record and this record has many termin_payment record (relation), below the record:
 *  - Termin Payment #1 has amount Rp.5.000.000
 *  - Termin Payment #2 has amount Rp.3.000.000
 *
 * The termin_detail's amount column value is Rp.10.000.000, then this function output: Rp.2.000.000
 */
function getRemainingAmountTerminPayment($current_termin_payment_model, $termin_payment_models) {
    $total_paid_amount = 0;
    foreach ($termin_payment_models as $termin_payment_model) {
        // I assume the models can be *not* ordered by serial number
        if ($termin_payment_model->termin_detail_id == $current_termin_payment_model->termin_detail_id) {
            if ($termin_payment_model->serial_number <= $current_termin_payment_model->serial_number) {
                $total_paid_amount += $termin_payment_model->amount;
            }
        }
    }

    return $current_termin_payment_model->termin_detail->amount - $total_paid_amount;
}

/**
 * Get last serial number in termin_payments table
 * for record that has specific termin_detail_id
 * 
 * Example:
 *      there is 3 record in termin_payments table:
 * 
 *      Termin_Payments table
 *      --------------------------------------------------------------------------
 *          id  |   termin_detail_id | serial_number   |   pay_date     | .... etc
 *      --------------------------------------------------------------------------
 *          8           4                1                  2018-01-01
 *          9           4                2                  2018-01-01
 *          10          4                3                  2018-01-01
 *          11          7                1                  2018-01-01 
 * 
 *      calling function like this: 
 * 
 *              getCurrentSerialNumber($termin_detail_id = 4);
 * 
 *      will output: 3
 */
function getCurrentSerialNumberForTerminPayment($termin_detail_id)
{
    $result = \DB::table('termin_payments')
                    ->select(DB::raw('MAX(serial_number) AS max_value'))
                    ->where('termin_detail_id', '=', $termin_detail_id)
                    ->first();

    return $result->max_value;
}
