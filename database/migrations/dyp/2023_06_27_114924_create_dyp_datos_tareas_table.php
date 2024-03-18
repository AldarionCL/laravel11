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
        Schema::create('DYP_DatosTareas', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('TareaID')->unsigned();
            $table->integer('CampoID')->unsigned();
            $table->string('Valor')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }


};
