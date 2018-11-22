<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('invoice');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // I am feel it wrong to create a table to only store one data,
        // but for makes me get forward, I will choose this option and
        // allow future change to fix this
        Schema::create('invoice', function (Blueprint $table) {
            $table->unsignedInteger('invoice_number');
        });
    }
}
