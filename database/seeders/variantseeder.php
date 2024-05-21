<?php

namespace Database\Seeders;

use App\Models\variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class variantseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variant=new variant;
        $variant->name='color';
        $variant->value=1;
        $variant->save();

    }
}
