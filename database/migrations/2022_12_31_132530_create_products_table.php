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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('product_type')->nullable();
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('barcode_type')->nullable();
            $table->string('warehouse_id')->nullable();
            $table->integer('unit_id');
            $table->integer('purchase_price');
            $table->float('selling_price');
            $table->integer('alter_qty')->nullable();
            $table->string('featured')->nullable();
            $table->string('product_image')->nullable();
            $table->float('opening_stock')->nullable();
            $table->integer('status')->default(1);
            $table->integer('user_id');
            $table->string('desc')->nullable();
            $table->integer('tax_id')->nullable();
            $table->integer('category_id')->nullable();
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
        Schema::dropIfExists('_products');
    }
};
