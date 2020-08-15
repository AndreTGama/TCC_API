<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('login', 255);
            $table->string('password', 255);
            $table->string('name_user', 255);
            $table->string('e-mail', 255);
            $table->date('birth_date');
            $table->unsignedBigInteger('documents_id_document');
            $table->foreign('documents_id_document')
                  ->references('id_document')
                  ->on('documents')
                  ->onDelete('restrict');
            $table->unsignedBigInteger('addresses_id_address');
            $table->foreign('addresses_id_address')
                  ->references('id_address')
                  ->on('addresses')
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
        Schema::dropIfExists('users');
    }
}
