<?php

namespace Database\Seeders;

use App\Models\ProductSeting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSetingseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $ProductSeting=new ProductSeting;
        $ProductSeting->name="product type";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="product name";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="product code";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="unit";
        $ProductSeting->value=1;
        $ProductSeting->save();



        $ProductSeting=new ProductSeting;
        $ProductSeting->name="purchase price";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="selling price";
        $ProductSeting->value=1;
        $ProductSeting->save();



        $ProductSeting=new ProductSeting;
        $ProductSeting->name="alter quantity";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="catagery";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="tax";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="tax method";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="featured";
        $ProductSeting->value=1;
        $ProductSeting->save();



        $ProductSeting=new ProductSeting;
        $ProductSeting->name="product image";
        $ProductSeting->value=1;
        $ProductSeting->save();



        $ProductSeting=new ProductSeting;
        $ProductSeting->name="warehouse";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="opening stock";
        $ProductSeting->value=1;
        $ProductSeting->save();


        $ProductSeting=new ProductSeting;
        $ProductSeting->name="desc";
        $ProductSeting->value=1;
        $ProductSeting->save();

    }





}
