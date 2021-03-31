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
            $table->string('profesion')->after('celular');
            $table->string('universidad')->after('celular');
            $table->string('lugar_trabajo')->after('celular');
            $table->text('resena')->after('celular');
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
