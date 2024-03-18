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
        Schema::create('RC_user_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('bank_id');
            $table->string('account_type');
            $table->string('account_number');
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
        Schema::dropIfExists('RC_user_bank_accounts');
    }
};
