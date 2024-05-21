<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\warehouse;
use Illuminate\Database\Seeder;
use Database\Seeders\catageryseeder;
use Database\Seeders\currencyseeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            // ProductSetingseeder::class,
            // catageryseeder::class,
            // currencyseeder::class,
            // taxseeder::class,
           // variantseeder::class,
            // unitseeder::class,
            // warehouseseeder::class,
			// CreateAdminUserSeeder::class,
            // KitchenUserSeeder::class
        ]);
    }
}
