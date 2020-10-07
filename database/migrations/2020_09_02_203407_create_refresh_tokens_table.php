<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefreshTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refresh_tokens', function (Blueprint $table) {
            $table->bigIncrements('id_refresh_token');
			$table->longText('refresh_token',1000);
			$table->boolean('active')->default(1);
			$table->bigInteger('tokens_id_token')->unsigned()->index()->unique();
			$table->foreign('tokens_id_token')
					->references('id_token')
					->on('tokens')
					->onDelete('cascade');
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
        Schema::table('refresh_tokens', function (Blueprint $table) {
            $table->dropForeign(['tokens_id_token']);
            $table->dropColumn(['tokens_id_token']);
        });
        Schema::dropIfExists('refresh_tokens');
    }
}
