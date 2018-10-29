<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTerminDetailIdColumnToTerminPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('termin_payments', function (Blueprint $table) {
            $table->unsignedInteger('termin_detail_id')->after('id');

            $table->foreign('termin_detail_id')->references('id')->on('termin_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
            $table->dropForeign('termin_payments_termin_detail_id_foreign');
            $table->dropColumn('termin_detail_id');
        });
    }
}
