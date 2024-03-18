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
        Schema::table('SP_oc_order_requests', function (Blueprint $table) {
            $table->integer('section_id')->nullable()->after('buyers_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_sp_oc_order_requests', function (Blueprint $table) {
            $table->dropColumn(['section_id']);
        });
    }
};
