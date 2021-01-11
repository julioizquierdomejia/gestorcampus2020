<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMoodlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('usermoodles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('user');
            $table->string('password');

            $table->string('document')->unique();
            
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mothers_last_name')->nullable();
            $table->integer('cod_nivel')->nullable();

            $table->string('sexo')->nullable();
            $table->string('avatar')->nullable();
            
            $table->string('address')->nullable();
            $table->string('urbanizacion')->nullable();
            $table->string('distrito')->nullable();
            $table->string('city')->nullable();
            $table->string('provincia')->nullable();
            $table->string('country')->nullable();
            
            $table->string('telephone')->nullable();
            $table->string('celular')->nullable();

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
        Schema::dropIfExists('usermoodles');
    }
}
