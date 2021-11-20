<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpiritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spirits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30)->nullable(false);
            $table->double('price')->nullable(false);
            $table->text('description', 30)->nullable(false);
            $table->string('image', 100)->nullable(false);
            $table->integer('stock')->nullable(false);
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
        Schema::dropIfExists('spirits');
    }
}
