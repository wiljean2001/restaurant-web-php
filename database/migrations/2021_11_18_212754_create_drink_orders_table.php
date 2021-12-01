<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drink_orders', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('quantify')->nullable(false);
            $table->double('price')->nullable(false);
            $table->timestamps();
            // $table->foreign('drinkID')->references('drinkID')->on('drinks');
            $table->foreignId('drink_id')
                ->nullable(false)
                ->constrained('drinks');
            $table->foreignId('order_id')
                ->nullable(false)
                ->constrained('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drink_orders');
    }
}
