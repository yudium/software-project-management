<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignInFollowUpDealHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('follow_up_deal_histories', function (Blueprint $table) {
            $table->foreign('follow_up_history_id')->references('id')->on('follow_up_histories')
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
        Schema::table('follow_up_deal_histories', function (Blueprint $table) {
            // TODO: fix wrong foreign name
            $table->dropForeign('follow_up_deal_histories_follow_up_history_id_foreign');
        });
    }
}
