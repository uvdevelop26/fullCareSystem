<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residentes', function (Blueprint $table) {
            $table->unsignedBigInteger('habitacione_id');

            $table->foreign('habitacione_id')
                ->references('id')
                ->on('habitaciones')
                ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('residentes', function (Blueprint $table) {
            $table->dropForeign(['habitacione_id']);
            $table->dropColumn('habitacione_id');
        });
    }
};
