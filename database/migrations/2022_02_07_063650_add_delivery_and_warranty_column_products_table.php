<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryAndWarrantyColumnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->boolean('delivery');
            $table->string('item_id')->nullable();
            $table->string('sku_id')->nullable();
            $table->string('weight')->nullable(); // trọng lượng
            $table->string('warranty');
            $table->string('height');
            $table->string('width');
            $table->string('length');
        });
        Schema::table('attributes', function (Blueprint $table) {
            //
            $table->dropColumn('weight');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('delivery');
            $table->dropColumn('item_id');
            $table->dropColumn('sku_id');
            $table->dropColumn('warranty');
            $table->dropColumn('weight');
        });
        Schema::table('attributes', function (Blueprint $table) {
            //
            $table->string('weight')->nullable(); // trọng lượng

        });
    }
}
