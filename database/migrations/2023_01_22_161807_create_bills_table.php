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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('number')->nullable();
            $table->date('date')->nullable();
            $table->string('order_type')->nullable();
            $table->integer('booker_id')->nullable();
            $table->integer('user_id');
            $table->float('total')->default(0.0);
            $table->float('discount')->nullable()->default(0.0);
            $table->float('net_total')->default(0.0);
            $table->float('paid_amount')->default(0)->nullable();
            $table->float('remaining')->default(0.0);
            $table->string('bill_type');
            $table->integer('bill_status')->default(1);
            $table->float('change')->default(0.0);
            $table->string('desc')->nullable();
            $table->string('kitchen_status')->default('pending');
            $table->integer('on_hold')->default(0);
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
        Schema::dropIfExists('bills');
    }
};
