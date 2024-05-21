<?php

namespace Database\Seeders;

use App\Models\warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class warehouseseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouse=new warehouse;
        $warehouse->name='hyderabad ware house';
        $warehouse->email='warehouse@gmail.com';
        $warehouse->phone=122334545;
        $warehouse->address='hyderabad';
        $warehouse->status=1;
        $warehouse->user_id=1;
        $warehouse->save();
         }
}
