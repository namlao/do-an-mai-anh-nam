<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLazadaShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lazada_shops', function (Blueprint $table) {
            $table->id();
            $table->string('appkey');
            $table->string('appsecret');
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->bigInteger('user_id')->unsigned()->unique()->index();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('lazada_shops');
    }
}
