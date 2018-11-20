<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidOffColumnToTerminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('termins', function (Blueprint $table) {
            // The default value must be same as @const IS_NOT_PAID_OFF
            // in Termin.php model
            $table->char('paid_off', 1)->nullable()->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('termins', function (Blueprint $table) {
            $table->dropColumn('paid_off');
        });
    }
}
