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
        Schema::create('LB_chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat');
            $table->bigInteger('channel');
            $table->bigInteger('customer_id');
            $table->text('name_customer');
            $table->mediumText('attention')->nullable();
            $table->mediumText('brand')->nullable();
            $table->mediumText('model')->nullable();
            $table->text('phone')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
//            $table->foreign('seller_id')->references('ID')->on('MA_Usuarios');
            $table->integer('lead_id')->nullable();
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
        Schema::dropIfExists('LB_chats');
    }
};
