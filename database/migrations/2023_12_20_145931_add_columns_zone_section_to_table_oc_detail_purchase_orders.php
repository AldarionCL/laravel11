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
        Schema::table('OC_detail_purchase_orders', function (Blueprint $table) {
            $table->integer('typeOfBranch_id')->nullable();
            $table->integer('section_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_oc_detail_purchase_orders', function (Blueprint $table) {
            $table->dropColumn([ 'typeOfBranch_id', 'section_id' ]);
        });
    }
};
