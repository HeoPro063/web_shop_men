<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('size_id')->unsigned();
            $table->integer('promotion_id')->nullable()->unsigned();
            $table->integer('color_id')->unsigned();
            $table->string('name');
            $table->integer('price');
            $table->integer('quantity');
            $table->text('description');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('promotion_id')->references('id')->on('promotions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
