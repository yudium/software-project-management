<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('agent_commission_id');
            $table->string('project_name');

            $table->foreign('agent_id')->references('id')->on('agents')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('agent_commission_id')->references('id')->on('agent_commissions')
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
        Schema::dropIfExists('agent_projects');
    }
}
