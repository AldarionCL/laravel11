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
        Schema::create('SP_oc_order_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->integer('brand_id');
            $table->integer('branch_id');
            $table->integer('typeOfBranch_id');
            $table->integer('buyers_id');
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
        Schema::dropIfExists('SP_oc_order_requests');
    }
};
