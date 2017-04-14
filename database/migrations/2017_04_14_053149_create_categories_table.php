<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('transaction_type_id')->nullable();

            $table->foreign('transaction_type_id')
                  ->references('id')
                  ->on('transaction_types')
                  ->onDelete('set null')
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
        Schema::table('categories', function(Blueprint $table){
            $table->dropForeign(['transaction_type_id']);
        });

        Schema::dropIfExists('categories');
    }
}
