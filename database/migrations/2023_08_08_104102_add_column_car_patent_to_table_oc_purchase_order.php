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
        Schema::table('OC_purchase_orders', function (Blueprint $table) {
            $table->string('car_patent')->nullable()->after('pre_oc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('OC_purchase_orders', function (Blueprint $table) {
            $table->dropColumn('car_patent');
        });
    }
};
