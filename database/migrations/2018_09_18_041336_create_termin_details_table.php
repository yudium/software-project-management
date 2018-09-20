<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerminDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termin_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('termin_id');
            $table->tinyInteger('index');
            $table->date('billing_date');
            $table->unsignedInteger('amount');

            $table->foreign('termin_id')->references('id')->on('termins')
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
        Schema::dropIfExists('termin_details');
    }
}
