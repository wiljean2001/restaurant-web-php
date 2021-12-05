<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpiritOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spirit_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantify')->nullable(false);
            $table->double('price')->nullable(false);
            $table->timestamps();
            $table->foreignId('spirit_id')
                ->nullable(false)
                ->constrained('spirits');
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
        Schema::dropIfExists('spirit_orders');
    }
}
