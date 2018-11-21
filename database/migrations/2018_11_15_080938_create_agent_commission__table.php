<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agent_project_id');
            $table->date('due_date');
            $table->unsignedInteger('amount');
            
            $table->foreign('agent_project_id')->references('id')->on('agent_projects')
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
        Schema::dropIfExists('agent_commissions');
    }
}
