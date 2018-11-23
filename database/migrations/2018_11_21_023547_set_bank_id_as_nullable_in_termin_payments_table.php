<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetBankIdAsNullableInTerminPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('termin_payments', function (Blueprint $table) {
            // Allow user to save payment data that paid by cash; not
            // transfer. If this column is NULL then it is paid by cash
            $table->unsignedInteger('bank_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('termin_payments', function (Blueprint $table) {
            $table->unsignedInteger('bank_id')->nullable(false)->change();
        });
    }
}
