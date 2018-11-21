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
        Schema::create('agent_commission_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agent_commission_id');
            $table->unsignedInteger('bank_id');
            $table->date('pay_date');
            $table->unsignedInteger('amount');
            $table->string('photo_evidance');

            $table->foreign('bank_id')->references('id')->on('banks')
            ->onDelete('no action')
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
        Schema::dropIfExists('agent_commission_details');
    }
}
