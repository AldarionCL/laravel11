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
        Schema::create('OC_approvals', function (Blueprint $table) {
            $table->id();
            $table->integer('ocOrderRequest_id');
            $table->unsignedBigInteger('approver_id');
//            $table->foreign('approver_id')->references('ID')->on('MA_Usuarios');
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
        Schema::dropIfExists('OC_approvals');
    }
};
