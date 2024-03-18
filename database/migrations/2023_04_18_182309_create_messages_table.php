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
        Schema::create('LB_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->text('author_type');
            if ( config('app.env') === 'local' ){
                $table->longText('message')->nullable();
            }else{
                $table->json('message')->nullable();
            }
            $table->boolean('read');
            $table->dateTime('readed_at');
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
        Schema::dropIfExists('LB_messages');
    }
};
