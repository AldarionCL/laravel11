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
        Schema::table('RC_cashier_approvals', function (Blueprint $table) {
            $table->integer('active')->nullable()->after('state')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_rc_cashier_approvals', function (Blueprint $table) {
            $table->dropColumn(['active']);
        });
    }
};
