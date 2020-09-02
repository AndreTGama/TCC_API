<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeUserIdTypeUserToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('type_users_id_type_user')->after('addresses_id_address');
            $table->foreign('type_users_id_type_user')
                  ->references('id_type_user')
                  ->on('type_users')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['type_users_id_type_user']);
            $table->dropColumn(['type_users_id_type_user']);
        });
    }
}
