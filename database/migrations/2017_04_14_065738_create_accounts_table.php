<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->double('balance');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('currency_id');
            $table->string('icon');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->foreign('currency_id')
                  ->references('id')
                  ->on('currencies')
                  ->onDelete('restrict')
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
        Schema::table('accounts', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['currency_id']);
        });

        Schema::dropIfExists('accounts');
    }
}
