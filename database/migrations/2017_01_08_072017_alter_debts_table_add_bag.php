<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDebtsTableAddBag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->unsignedInteger('bag_id')->nullable();

            $table->foreign('bag_id')
                  ->references('id')
                  ->on('bags')
                  ->onDelete('set null')
                  ->opUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->dropForeign(['bag_id']);
            $table->dropColumn('bag_id');
        });
    }
}