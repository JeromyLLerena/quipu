<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('label_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->foreign('type_id')
                  ->references('id')
                  ->on('product_types')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->foreign('label_id')
                  ->references('id')
                  ->on('labels')
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
        Schema::table('products', function(Blueprint $table){
            $table->dropForeign(['category_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['label_id']);
        });

        Schema::dropIfExists('products');
    }
}
