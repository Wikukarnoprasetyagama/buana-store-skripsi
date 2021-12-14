<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->string('name_store')->nullable();
            $table->string('photo_profile')->nullable();
            $table->string('phone')->nullable();
            $table->string('village')->nullable();
            $table->string('street')->nullable();
            $table->longText('address')->nullable();
            $table->string('photo_shop')->nullable();
            $table->enum('status', ['TERVERIFIKASI', 'PENDING', 'DIBLOKIR'])->default('PENDING');
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
        Schema::dropIfExists('user_details');
    }
}
