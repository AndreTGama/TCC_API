<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHasComunicatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_comunicateds', function (Blueprint $table) {
            $table->bigIncrements('id_users_has_comunicateds');
            $table->bigInteger('users_id_user')->unsigned()->index();
            $table->foreign('users_id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->bigInteger('comunicateds_id_comunicated')->unsigned()->index();
            $table->foreign('comunicateds_id_comunicated')->references('id_comunicated')->on('comunicateds')->onDelete('cascade');
            $table->boolean('view')->default(0);
            $table->bigInteger('users_has_comunicateds_id')->unsigned()->index()->nullable();
            $table->foreign('users_has_comunicateds_id')->references('id_users_has_comunicateds')
                    ->on('users_has_comunicateds')->onDelete('cascade');
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
        Schema::dropIfExists('users_has_comunicateds');
    }
}
