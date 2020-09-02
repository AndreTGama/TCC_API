<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id_contact');
            $table->string('ddd_tel', 3);
            $table->string('ddd_cel', 3);
            $table->string('tel_number', 15);
            $table->string('cel_number', 15);
            $table->unsignedBigInteger('users_id_user');
            $table->foreign('users_id_user')
                  ->references('id_user')
                  ->on('users')
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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['users_id_user']);
            $table->dropColumn(['users_id_user']);
        });
        Schema::dropIfExists('contacts');
    }
}
