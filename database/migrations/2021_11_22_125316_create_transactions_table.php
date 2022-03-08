<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->integer('products_id');
            $table->string('order_id')->nullable();
            $table->string('code_product');
            $table->integer('quantity')->default(1);
            $table->integer('code_unique')->nullable();
            $table->integer('total_price');
            $table->string('payment_status')->default('MENUNGGU');
            $table->string('shipping_status')->default('PENDING');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('village')->nullable();
            $table->longText('address')->nullable();
            $table->string('midtrans_url')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
