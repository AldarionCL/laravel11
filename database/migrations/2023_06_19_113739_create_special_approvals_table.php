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
        Schema::create('OC_special_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branchOfficeBuyer_id');
//            $table->foreign('branchOfficeBuyer_id')->references('ID')->on('MA_Sucursales');
            $table->unsignedBigInteger('branchOfficeApprover_id');
//            $table->foreign('branchOfficeApprover_id')->references('ID')->on('MA_Sucursales');
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
        Schema::dropIfExists('OC_special_approvals');
    }
};
