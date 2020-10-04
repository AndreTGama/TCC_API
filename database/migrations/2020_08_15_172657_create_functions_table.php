<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functions', function (Blueprint $table) {
            $table->bigIncrements('id_function');
            $table->string('function', 255);
            $table->unsignedBigInteger('functions_id_function')->nullable();
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
        Schema::dropIfExists('functions');
    }
}
