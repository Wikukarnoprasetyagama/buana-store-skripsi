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
            $table->integer('products_id');
            $table->string('code_product');
            $table->integer('quantity')->default(1);
            $table->integer('price');
            $table->string('shipping_status')->default('PENDING');
            $table->longText('notes')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('village')->nullable();
            $table->longText('address')->nullable();
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
