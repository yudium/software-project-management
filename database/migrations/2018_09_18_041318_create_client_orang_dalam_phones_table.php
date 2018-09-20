<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientOrangDalamPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_orang_dalam_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_orang_dalam_id');
            $table->string('phone');

            $table->foreign('client_orang_dalam_id')->references('id')->on('client_orang_dalam')
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
        Schema::dropIfExists('client_orang_dalam_phones');
    }
}
