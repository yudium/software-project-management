<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentCommissionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_commission_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agent_commission_id');
            $table->tinyInteger('serial_number');
            $table->date('due_date');
            $table->unsignedInteger('amount');

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
        Schema::dropIfExists('agent_commission_details');
    }
}
