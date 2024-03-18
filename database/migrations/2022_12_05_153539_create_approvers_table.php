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
        Schema::create('OC_approvers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branchOffice_id');
//            $table->foreign('branchOffice_id')->references('id')->on('MA_Sucursales');
            $table->integer('level');
            $table->unsignedBigInteger('user_id');
//            $table->foreign('user_id')->references('ID')->on('MA_Usuarios');
            $table->integer('min');
            $table->integer('max');
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
        Schema::dropIfExists('OC_approvers');
    }
};
