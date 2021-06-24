<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoriesProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_products', function (Blueprint $table) {
            $table->id();

           $table->unsignedBigInteger('categories_id')->index();
           $table->unsignedBigInteger('products_id')->index();


           $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
           $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('categories_products');
    }
}
