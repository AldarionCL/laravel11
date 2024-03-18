<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
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
        Schema::create('TK_agents', function (Blueprint $table) {
            $db = DB::connection('roma')->getDatabaseName();

            $table->id();
            $table->unsignedBigInteger('user_id');
//            $table->foreign('user_id')->references('ID')->on(new Expression($db . '.MA_Usuarios'));
            $table->unsignedBigInteger('subCategory_id');
//            $table->foreign('subCategory_id')->references('id')->on('TK_sub_categories');
            $table->timestamp('FechaCreacion')->nullable();
            $table->integer('EventoCreacionID')->nullable();
            $table->integer('UsuarioCreacionID')->nullable();
            $table->timestamp('FechaActualizacion')->nullable();
            $table->integer('EventoActualizacionID')->nullable();
            $table->integer('UsuarioActualizacionID')->nullable();
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
        Schema::dropIfExists('TK_agents');
    }
};
