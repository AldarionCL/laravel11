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
        Schema::create('RC_cashier_approvers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_office_id');
//            $table->foreign('branch_office_id')->references('ID')->on('MA_Sucursales');
            $table->unsignedBigInteger('user_id');
//            $table->foreign('user_id')->references('ID')->on('MA_Usuarios');
            $table->integer('level');
            $table->bigInteger('min');
            $table->bigInteger('max');
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
        Schema::dropIfExists('RC_cashier_approvers');
    }
};
