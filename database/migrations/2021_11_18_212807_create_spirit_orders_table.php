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
            $table->id();
            $table->integer('quantify')->nullable(false);
            $table->timestamps();
            $table->foreignId('spiritID')
                ->nullable(false)
                ->constrained('spirits');
            $table->foreignId('orderID')
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
