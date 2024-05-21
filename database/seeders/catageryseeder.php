<?php

namespace Database\Seeders;

use App\Models\catagery;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class catageryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catagery=new catagery;
        $catagery->catagery_name="Beg";
        $catagery->user_id="5";

        $catagery->save();

        $catagery=new catagery;
        $catagery->catagery_name="caps";
        $catagery->user_id="6";

        $catagery->save();

        $catagery=new catagery;
        $catagery->catagery_name="watchs";
        $catagery->user_id="7";

        $catagery->save();

    }
}
