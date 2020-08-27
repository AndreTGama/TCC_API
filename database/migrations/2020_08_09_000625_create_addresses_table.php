<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id_address');
            $table->string('postcode', 15);
            $table->string('street', 255);
            $table->string('number', 30);
            $table->string('district', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('country', 255);
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
        Schema::dropIfExists('addresses');
    }
}
