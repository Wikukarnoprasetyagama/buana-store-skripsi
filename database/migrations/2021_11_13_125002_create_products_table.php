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
            $table->string('photo');
            $table->integer('users_id');
            $table->integer('categories_id');
            $table->string('name_product');
            $table->string('slug');
            $table->integer('price');
            $table->enum('discount', ['ada', 'tidak'])->default('tidak');
            $table->string('discount_amount')->default(0)->nullable();
            $table->string('code_discount')->nullable();
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
