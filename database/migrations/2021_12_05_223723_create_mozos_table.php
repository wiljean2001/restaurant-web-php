<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMozosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mozos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni', 8)->nullable(false);
            $table->string('name', 40)->nullable(false);
            $table->string('lname', 50)->nullable(false);
            $table->integer('date_of_birth')->nullable(false);
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
        Schema::dropIfExists('mozos');
    }
}
