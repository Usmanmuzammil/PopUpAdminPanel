<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          User::create([
        	'name' => 'Admin', 
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('admin@123')
        ]);
          User::create([
        	'name' => 'User', 
        	'email' => 'user@gmail.com',
        	'status' => '0',
        	'password' => bcrypt('123456789')
        ]);
    }
}
