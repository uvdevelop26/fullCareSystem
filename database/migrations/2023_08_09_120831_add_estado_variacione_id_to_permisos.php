<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('permisos', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_variacione_id');

            $table->foreign('estado_variacione_id')
                ->references('id')
                ->on('estado_variaciones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permisos', function (Blueprint $table) {
            $table->dropForeign(['estado_variacione_id']);
            $table->dropColumn('estado_variacione_id');
        });
    }
};
