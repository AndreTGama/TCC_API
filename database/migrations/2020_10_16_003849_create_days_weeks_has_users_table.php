<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysWeeksHasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days_weeks_has_users', function (Blueprint $table) {
            $table->bigIncrements('id_days_weeks_has_users');
            $table->bigInteger('users_id_user')->unsigned()->index();
            $table->foreign('users_id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->bigInteger('days_weeks_id_days_week')->unsigned()->index();
            $table->foreign('days_weeks_id_days_week')->references('id_days_week')->on('days_weeks')->onDelete('cascade');
            $table->bigInteger('opening_hours_id_opening_hour')->unsigned()->index();
            $table->foreign('opening_hours_id_opening_hour')->references('id_opening_hour')->on('opening_hours')->onDelete('cascade');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('days_weeks_has_users');
    }
}
