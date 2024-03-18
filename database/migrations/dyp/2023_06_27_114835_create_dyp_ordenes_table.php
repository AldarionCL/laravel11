<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DYP_Orden', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('DypID');
            $table->integer('UsuarioID')->nullable();
            $table->string('Danio',30)->nullable();
            $table->string('Descripción',100)->nullable();
            $table->string('DesMontar')->nullable();
            $table->string('Mecanica')->nullable();
            $table->string('Pintura')->nullable();
            $table->string('Repuestos')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }


};
