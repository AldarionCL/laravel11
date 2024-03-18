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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tiProduct_id');
            $table->bigInteger('user_id');
            $table->bigInteger('branch_id');
            $table->string('brand')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('year')->nullable();
            $table->string('imei')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->nullable();
            $table->string('origin')->nullable();
            $table->longText('observation')->nullable();
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
        Schema::dropIfExists('inventories');
    }
};
