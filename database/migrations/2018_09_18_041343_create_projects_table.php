<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('project_type_id');
            $table->unsignedInteger('termin_id');
            $table->string('name');
            $table->unsignedInteger('prices');
            $table->date('starttime');
            $table->date('endtime');
            $table->date('endtime_actual');
            $table->date('DP_time');
            $table->text('additional_note');
            $table->string('status');
            $table->string('trello_board_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->foreign('project_type_id')->references('id')->on('project_types')
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->foreign('termin_id')->references('id')->on('termins')
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
        Schema::dropIfExists('projects');
    }
}
