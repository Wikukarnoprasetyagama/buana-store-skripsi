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
            $table->id();
            $table->integer('users_id');
            $table->integer('categories_id');
            $table->string('code');
            $table->string('name_product');
            $table->string('slug')->unique();
            $table->integer('price');
            $table->boolean('discount')->default(false);
            $table->string('discount_amount')->default(0)->nullable();
            $table->boolean('ongkir')->default(false);
            $table->string('ongkir_amount')->default(0)->nullable();
            $table->longText('description');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
