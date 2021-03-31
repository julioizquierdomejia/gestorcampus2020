<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('video_id')->nullable();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('set null');
            $table->unsignedBigInteger('competitor_type_id')->nullable();
            $table->foreign('competitor_type_id')->references('id')->on('competitor_types')->onDelete('set null');
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
        Schema::table('competitors', function (Blueprint $table) {
            $table->dropForeign('competitors_user_id_foreign');
            $table->dropForeign('competitors_video_id_foreign');
            $table->dropForeign('competitors_competitor_type_id_foreign');
        });
        Schema::dropIfExists('competitors');
    }
}
