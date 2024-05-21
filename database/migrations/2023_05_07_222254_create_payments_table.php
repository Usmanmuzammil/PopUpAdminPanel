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
        // Schema::create('payments', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('from_account');
        //     $table->integer('to_account');
        //     $table->date('date');
        //     $table->bigInteger('amount');
        //     $table->text('desc');
        //     $table->integer('status')->default(1);
        //     $table->integer('user_id');
        //     $table->timestamps();
        // });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->integer('shop_account_id');
            $table->string('amount');
            $table->string('payment_type');
            $table->string('description')->nullable();
            $table->date('date');
            $table->string('user_id');
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
        Schema::dropIfExists('payments');
    }
};
