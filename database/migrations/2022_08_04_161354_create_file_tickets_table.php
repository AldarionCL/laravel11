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
        Schema::create('TK_file_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('TK_tickets');
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
        Schema::dropIfExists('TK_file_tickets');
    }
};
