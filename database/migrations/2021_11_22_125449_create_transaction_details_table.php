<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->integer('transactions_id');
            $table->enum('shipping_status', ['Menunggu Konfirmasi', 'Dikirim', 'Diterima'])->default('Menunggu Konfirmasi');
            $table->string('code_transaction');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('village')->nullable();
            $table->longText('address')->nullable();
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
        Schema::dropIfExists('transaction_details');
    }
}
