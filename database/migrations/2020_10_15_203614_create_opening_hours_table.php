<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeningHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening_hours', function (Blueprint $table) {
            $table->bigIncrements('id_opening_hour');
            $table->time('open')->default('00:00:00')->nullable();
            $table->time('close')->default('00:00:00')->nullable();
            $table->time('lunch_time_out')->default('00:00:00')->nullable();
            $table->time('lunch_time_in')->default('00:00:00')->nullable();
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
        Schema::dropIfExists('opening_hours');
    }
}
