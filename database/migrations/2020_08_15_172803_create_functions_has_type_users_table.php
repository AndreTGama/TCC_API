<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionsHasTypeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functions_has_type_users', function (Blueprint $table) {
            $table->bigIncrements('id_function_has_type_user');
            $table->unsignedBigInteger('type_users_id_type_user');
            $table->foreign('type_users_id_type_user')
                  ->references('id_type_user')
                  ->on('type_users')
                  ->onDelete('restrict');
            $table->unsignedBigInteger('functions_id_function');
            $table->foreign('functions_id_function')
                  ->references('id_function')
                  ->on('functions')
                  ->onDelete('restrict');
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('functions_has_type_users', function (Blueprint $table) {
            $table->dropForeign(['functions_id_function']);
            $table->dropForeign(['type_users_id_type_user']);
            $table->dropColumn(['type_users_id_type_user', 'functions_id_function']);
        });
        Schema::dropIfExists('functions_has_type_users');
    }
}
