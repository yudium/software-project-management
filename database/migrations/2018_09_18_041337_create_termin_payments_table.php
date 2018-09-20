<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termin_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_id');
            $table->date('pay_date');
            $table->unsignedInteger('amount');
            $table->string('photo_evidance');

            $table->foreign('bank_id')->references('id')->on('banks')
                ->onDelete('no action')
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
        Schema::dropIfExists('termin_payments');
    }
}
