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
        Schema::create('TK_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('priority');
            $table->integer('category');
            $table->integer('subCategory');
            $table->integer('management');
            $table->integer('zone');
            $table->integer('department');
            $table->integer('applicant');
            $table->integer('assigned');
            $table->longText('detail');
            $table->integer('state');
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
        Schema::dropIfExists('TK_tickets');
    }
};
