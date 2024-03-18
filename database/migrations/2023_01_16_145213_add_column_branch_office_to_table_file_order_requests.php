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
        Schema::table('SP_file_order_requests', function (Blueprint $table) {
            $table->integer('branchOffice_id' )->after( 'ocOrderRequest_id' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('SP_file_order_requests', function (Blueprint $table) {
            $table->dropColumn('branchOffice_id');
        });
    }
};
