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
        Schema::create('RC_cash_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number_document');
            $table->date('date');
            $table->integer('type_document');
            $table->string('provider');
            $table->text('description');
            $table->bigInteger('account_id');
            $table->bigInteger('total');
            $table->unsignedBigInteger('cash_id');
            $table->integer('state')->default(1);
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
        Schema::dropIfExists('RC_cash_details');
    }
};
