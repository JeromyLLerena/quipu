<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_labels', function(Blueprint $table){
            $table->unsignedInteger('transaction_id');
            $table->unsignedInteger('label_id');

            $table->primary(['transaction_id', 'label_id'], 'transactions_labels_transaction_id_label_id_primary');

            $table->foreign('transaction_id')
                  ->references('id')
                  ->on('transactions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('label_id')
                  ->references('id')
                  ->on('labels')
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
        Schema::table('transactions_labels', function(Blueprint $table){
            $table->dropForeign(['label_id']);
            $table->dropForeign(['transaction_id']);

            $table->dropPrimary('transactions_labels_transaction_id_label_id_primary');
        });

        Schema::dropIfExists('transactions_labels');
    }
}
