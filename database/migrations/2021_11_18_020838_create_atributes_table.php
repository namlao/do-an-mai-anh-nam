<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('cpu')->nullable(); // cpu của máy tính
            $table->string('ram')->nullable(); // ram của máy tính
            $table->string('hard_drive')->nullable(); // ổ cứng
            $table->string('screen')->nullable(); // màn hình
            $table->string('graphic_card')->nullable(); // card đồ họa
            $table->string('connect_port')->nullable(); // công kết nối
            $table->string('special')->nullable(); // tính năng khác
            $table->string('os')->nullable(); // hệ điều hành
            $table->string('design')->nullable(); // thiết kế
            $table->string('weight')->nullable(); // trọng lượng
            $table->bigInteger('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
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
        Schema::dropIfExists('attributes');
    }
}
