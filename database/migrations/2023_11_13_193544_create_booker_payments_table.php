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
        Schema::create('booker_payments', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('date');
            $table->string('description')->nullable();
            $table->integer('added_by');
            $table->unsignedBigInteger('booker_id');
            $table->integer('status')->default(1);
            $table->foreign('booker_id')->references('id')->on('order_bookers');
            $table->softDeletes();
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
        Schema::dropIfExists('booker_payments');
    }
};
