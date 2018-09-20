<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancePeriodicBugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_periodic_bugs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('priority');
            $table->string('title');
            $table->text('note');
            $table->text('solution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_periodic_bugs');
    }
}
