<?php

namespace Database\Seeders;

use App\Models\currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class currencyseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency=new currency;
        $currency->currency_name="dollar";
        $currency->currency_code="$";
        $currency->user_id="1";
        $currency->save();




    }
}
