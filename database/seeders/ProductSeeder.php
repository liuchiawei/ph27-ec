<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daikon = new Product();
        $daikon->name = '大根';
        $daikon->price = 200;
        $daikon->save();

        $ninjin = new Product();
        $ninjin->name = '人参';
        $ninjin->price = 80;
        $ninjin->save();

        $kabocha = new Product();
        $kabocha->name = 'カボチャ';
        $kabocha->price = 300;
        $kabocha->save();
    }
}
