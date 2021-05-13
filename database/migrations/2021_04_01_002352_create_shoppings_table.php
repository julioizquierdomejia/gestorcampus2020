<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');

            $table->string('document')->nullable();
            
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mothers_last_name')->nullable();

            $table->string('address')->nullable();
            $table->string('urbanizacion')->nullable();
            $table->string('distrito')->nullable();
            $table->string('city')->nullable();
            $table->string('provincia')->nullable();
            $table->string('country')->nullable();

            $table->string('telephone')->nullable();
            $table->string('celular')->nullable();

            $table->string('status')->nullable();
            
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
        Schema::dropIfExists('shoppings');
    }
}
