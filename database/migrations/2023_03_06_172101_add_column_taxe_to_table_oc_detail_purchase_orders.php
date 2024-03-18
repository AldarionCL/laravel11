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
            $table->integer('taxAmount')->nullable()->after('totalPrice');
            $table->integer('taxe')->nullable()->after('taxAmount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('OC_detail_purchase_orders', function (Blueprint $table) {
            $table->dropColumn('taxAmount');
            $table->dropColumn('taxe');
        });
    }
};
