<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunicatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicateds', function (Blueprint $table) {
            $table->bigIncrements('id_comunicated');
            $table->string('title',25)->nullable();
            $table->longText('comunicated');
            $table->bigInteger('users_id_user')->unsigned()->index();
            $table->foreign('users_id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunicateds');
    }
}
