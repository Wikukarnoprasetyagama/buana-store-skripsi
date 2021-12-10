<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id('id');
            $table->integer('users_id');
            $table->string('name_store')->nullable();
            $table->string('photo_profile')->nullable();
            $table->string('phone')->nullable();
            $table->string('village')->nullable();
            $table->longText('address')->nullable();
            $table->string('photo_shop')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
