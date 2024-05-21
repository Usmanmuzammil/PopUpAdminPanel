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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->integer('product_id');
            $table->integer('qty');
            $table->json('varriantion')->nullable();
            $table->json('extras')->nullable();
            $table->json('addons')->nullable();
            $table->string('variant_price')->nullable();
            $table->string('extras_price')->nullable();
            $table->string('addons_price')->nullable();
            $table->text('unit')->nullable();
            $table->float('price')->default(0.0);
            $table->float('total')->default(0.0);
            $table->float('discount')->default(0.0);
            $table->float('net_total')->default(0.0);
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
        Schema::dropIfExists('bill_details');
    }
};
