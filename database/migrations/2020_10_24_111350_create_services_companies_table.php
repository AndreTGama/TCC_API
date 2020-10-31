<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_companies', function (Blueprint $table) {
            $table->bigIncrements('id_services_company');
            $table->string('service', 25);
            $table->longText('description');
            $table->time('time');
            $table->decimal('price', 15, 2);
            $table->bigInteger('users_id_user')->unsigned()->index();
            $table->foreign('users_id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->bigInteger('types_services_id_type_service')->unsigned()->index();
            $table->foreign('types_services_id_type_service')->references('id_type_service')->on('types_services')->onDelete('cascade');
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
        Schema::dropIfExists('services_companies');
    }
}
