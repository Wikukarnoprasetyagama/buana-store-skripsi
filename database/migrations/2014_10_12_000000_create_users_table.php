<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('roles', ['ADMIN', 'SELLER', 'CUSTOMER'])->default('CUSTOMER');
            $table->string('name_store')->nullable();
            $table->enum('status', ['TERVERIFIKASI', 'PENDING', 'DIBLOKIR', 'NONE'])->default('NONE');
            $table->string('name_bank');
            $table->string('account_number');
            $table->string('phone')->nullable();
            $table->string('village')->nullable();
            $table->string('street')->nullable();
            $table->longText('address')->nullable();
            $table->string('photo_profile')->nullable();
            $table->string('photo_shop')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
