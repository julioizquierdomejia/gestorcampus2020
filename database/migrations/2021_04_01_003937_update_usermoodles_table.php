<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsermoodlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usermoodles', function (Blueprint $table) {
            $table->string('profesion')->after('celular')->nullable();
            $table->string('universidad')->after('celular')->nullable();
            $table->string('lugar_trabajo')->after('celular')->nullable();
            $table->text('resena')->after('celular')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usermoodles', function (Blueprint $table) {
            $table->dropColumn('profesion');
            $table->dropColumn('universidad');
            $table->dropColumn('lugar_trabajo');
            $table->dropColumn('resena');
        });
    }
}
