<?php

namespace Database\Seeders;

use App\Models\KitchenUser;

use Illuminate\Database\Seeder;

class KitchenUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KitchenUser::create([
        	'user_name' => 'KitchenUser',
        	'email' => 'kitchenuser@gmail.com',
        	'password' => bcrypt('kitchenuser@123')
        ]);
    }
}
