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
            $table->unsignedInteger('termin_id')->nullable();
            $table->string('name');
            // TODO: check nullable because in my database it is not null-able
            //       if after re-migrate (refresh) and null-able still not
            //       working then I should create separate migration for set
            //       nullable.
            $table->unsignedInteger('price')->nullable();
            $table->date('starttime')->nullable();
            $table->date('endtime')->nullable();
            $table->date('endtime_actual')->nullable();
            $table->date('DP_time')->nullable();
            $table->text('additional_note')->nullable();
            // TODO: change to char(1)
            $table->string('status');
            $table->string('trello_board_id')->nullable();
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
