<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProvincesRegenciesAndDistrictsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('provinces_id')->nullable();
            $table->bigInteger('regencies_id')->nullable();
            $table->bigInteger('districts_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('provinces_id');
            $table->dropColumn('regencies_id');
            $table->dropColumn('districts_id');
        });
    }
}
