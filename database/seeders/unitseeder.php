<?php

namespace Database\Seeders;

use App\Models\unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class unitseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $unit=new unit;
        $unit->code="kg";
        $unit->unit_name="kg";
        $unit->status=1;
        $unit->user_id=1;
        $unit->save();
    }
}
