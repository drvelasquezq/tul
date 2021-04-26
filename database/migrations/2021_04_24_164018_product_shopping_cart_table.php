<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductShoppingCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shopping_cart', function (Blueprint $table) {
            $table->unsignedBigInteger('shopping_cart_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity')->default(1);

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_shopping_cart');
    }
}
