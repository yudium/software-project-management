<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveBankIdInProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Project doesn't have relation with bank
            $table->dropForeign('projects_bank_id_foreign');
            $table->dropColumn('bank_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedInteger('bank_id')->nullable()->after('project_type_id');

            $table->foreign('bank_id')->references('id')->on('banks')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }
}
