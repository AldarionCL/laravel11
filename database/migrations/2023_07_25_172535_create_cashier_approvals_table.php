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
        Schema::create('RC_cashier_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_id');
//            $table->foreign('branch_office_id')->references('ID')->on('MA_Sucursales');
            $table->unsignedBigInteger('cashier_approver_id');
//            $table->foreign('cashier_approver_id')->references('user_id')->on('cashier_approvers');
            $table->integer('level');
            $table->integer('state');
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
        Schema::dropIfExists('RC_cashier_approvals');
    }
};
