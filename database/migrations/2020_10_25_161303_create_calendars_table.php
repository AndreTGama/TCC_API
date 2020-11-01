<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigIncrements('id_calendar');
            $table->date('day_commitment');
            $table->time('hour_commitment');
            $table->longText('note');
            $table->boolean('concluded')->default(0);
            $table->bigInteger('users_id_user')->unsigned()->index();
            $table->foreign('users_id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->bigInteger('services_companies_id_services_company')->unsigned()->index();
            $table->foreign('services_companies_id_services_company')
                    ->references('id_services_company')->on('services_companies')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('calendars');
    }
}
