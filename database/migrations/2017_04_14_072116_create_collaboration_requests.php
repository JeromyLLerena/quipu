<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollaborationRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaboration_requests', function(Blueprint $table){
            $table->unsignedInteger('emisor_id');
            $table->unsignedInteger('receptor_id');
            $table->unsignedInteger('account_id');
            $table->timestamps();

            $table->primary(['emisor_id', 'receptor_id', 'account_id'], 'collaboration_requests_emisor_id_receptor_id_account_id_primary');

            $table->foreign('emisor_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('receptor_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('account_id')
                  ->references('id')
                  ->on('accounts')
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
        Schema::table('collaboration_requests', function(Blueprint $table){
            $table->dropForeign(['emisor_id']);
            $table->dropForeign(['receptor_id']);
            $table->dropForeign(['account_id']);
            $table->dropPrimary('collaboration_requests_emisor_id_receptor_id_account_id_primary');
        });

        Schema::dropIfExists('collaboration_requests');
    }
}
