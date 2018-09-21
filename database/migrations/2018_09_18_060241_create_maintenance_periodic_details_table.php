<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancePeriodicDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_periodic_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('maintenance_periodic_id');
            $table->tinyInteger('index');
            $table->date('date');
            $table->boolean('status');

            $table->foreign('maintenance_periodic_id')->references('id')->on('maintenance_periodics')
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
        Schema::dropIfExists('maintenance_periodic_details');
    }
}
