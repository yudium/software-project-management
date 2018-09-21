<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancePeriodicBugImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_periodic_bug_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('maintenance_periodic_bug_id');
            $table->string('photo');

            $table->foreign('maintenance_periodic_bug_id', 'maintenance_periodic_bug_id_foreign')->references('id')->on('maintenance_periodic_bugs')
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
        Schema::dropIfExists('maintenance_periodic_bug_images');
    }
}
