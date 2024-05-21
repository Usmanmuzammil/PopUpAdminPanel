<?php

namespace Database\Seeders;

use App\Models\tax;
use App\Models\currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class taxseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax=new tax;
        $tax->name="visiting tax";
        $tax->rate=10.0;
        $tax->status="1";
        $tax->user_id="1";
        $tax->save();
      }
}
