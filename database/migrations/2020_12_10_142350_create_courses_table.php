<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->integer('course_moodle_id');

            $table->unsignedBigInteger('course_group_id')->nullable();

            $table->string('categoria');
            $table->string('fullname')->nullable();
            $table->string('shortname')->nullable();
            $table->string('instructor')->nullable();
            $table->longText('introduccion')->nullable();
            $table->longText('description')->nullable();
            $table->longText('Informacion_adicional')->nullable();
            $table->longText('novedades')->nullable();
            $table->integer('price')->nullable();
            $table->string('nuevo')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('img')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
