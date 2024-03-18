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
        Schema::create('CPD_Logs', function (Blueprint $table) {
            $table->id('ID');
            $table->string('Tipo',50);
            $table->text('request');
            $table->text('textolog');
            $table->integer('UsuarioID')->nullable();
            $table->integer('CpdID')->nullable();
            $table->integer('TareaID')->nullable();

            $table->softDeletes();
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
        //
    }
};
