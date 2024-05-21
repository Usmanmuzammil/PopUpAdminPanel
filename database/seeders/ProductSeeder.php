<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) {
            $productCode = $faker->numberBetween(10000, 9999999);
            $productName = $faker->word;
            $productType = 'sell';
            $sellingPrice = $faker->randomFloat(2, 10, 100);
            $purchasePrice = $faker->randomFloat(2, 5, 50);
            $image  = 'no_image.jpg';
            $opening_Stock = '100';
            $status = 1;
            $user_id = 1;

            DB::table('products')->insert([
                'product_code' => $productCode,
                'product_name' => $productName,
                'product_type' => $productType,
                'selling_price' => $sellingPrice,
                'purchase_price' => $purchasePrice,
                'product_image' => $image,
                'opening_stock' => $opening_Stock,
                'status' => $status,
                'user_id' => $user_id,
                'unit_id' => $user_id,
            ]);
        }
    }
}
