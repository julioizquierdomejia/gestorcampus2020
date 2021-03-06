<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('video_types_id');
            $table->foreign('video_types_id')->references('id')->on('video_types');
            
            $table->string('name');
            $table->string('especialidad');
            $table->string('tema');
            $table->mediumText('contenido');
            $table->mediumText('resumen');
            $table->date('fecha');
            $table->string('lugar');
            $table->string('duracion');
            $table->string('url');
            $table->string('tags');
            $table->string('tipo_licencia');
            $table->string('status');
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
        Schema::dropIfExists('videos');
    }
}
