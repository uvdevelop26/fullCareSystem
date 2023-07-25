<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('residentes', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_residente_id');

            $table->foreign('estado_residente_id')
                ->references('id')
                ->on('estado_residentes')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('residentes', function (Blueprint $table) {
            $table->dropForeign(['estado_residente_id']);
            $table->dropColumn('estado_residente_id');
        });
    }
};
