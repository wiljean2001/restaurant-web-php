<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_orders', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('quantify')->nullable(false);
            $table->double('price')->nullable(false);
            $table->timestamps();
            $table->foreignId('dish_id')
                ->nullable(false)
                ->constrained('dishes');
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
        Schema::dropIfExists('dish_orders');
    }
}
