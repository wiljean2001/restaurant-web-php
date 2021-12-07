<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('finalized')->default(false);
            $table->boolean('delivered')->default(false);
            $table->time('hour')->nullable(false);
            $table->date('date')->nullable(false);
            $table->timestamps();
            $table->foreignId('table_id')
                ->nullable(false)
                ->constrained('tables');
            $table->foreignId('client_id')
                ->nullable(false)
                ->constrained('clients');
            $table->foreignId('waiter_id')
                ->nullable(false)
                ->constrained('waiters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
