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
        Schema::create('CPD_Archivos', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('CpdID')->unsigned();
            $table->integer('TareaID')->unsigned();

            $table->string('inputName',20);
            $table->string('path',200);
            $table->string('name',30);
            $table->string('type',20);
            $table->integer('size');

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
        Schema::dropIfExists('CPD_Archivos');
    }
};
