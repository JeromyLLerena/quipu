<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('account_collaborators', function(Blueprint $table){
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->primary(['account_id', 'user_id'], 'account_collaborators_account_id_user_id_primary');

            $table->foreign('account_id')
                  ->references('id')
                  ->on('accounts')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::table('account_collaborators', function(Blueprint $table){
            $table->dropForeign(['account_id']);
            $table->dropForeign(['user_id']);
            $table->dropPrimary('account_collaborators_account_id_user_id_primary');
        });

        Schema::dropIfExists('account_collaborators');
    }
}
