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
        Schema::create('SP_buyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branchOffice_id');
//            $table->foreign('branchOffice_id')->references('ID')->on('MA_Sucursales');
            $table->unsignedBigInteger('user_id');
//            $table->foreign('user_id')->references('ID')->on('MA_Usuarios');
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
        Schema::dropIfExists('SP_buyers');
    }
};
