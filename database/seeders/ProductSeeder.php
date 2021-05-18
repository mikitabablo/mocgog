<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Fallout',
                'price' => 1.99,
            ],
            [
                'title' => 'Don’t Starve',
                'price' => 2.99,
            ],
            [
                'title' => 'Baldur’s Gate',
                'price' => 3.99,
            ],
            [
                'title' => 'Icewind Dale',
                'price' => 4.99,
            ],
            [
                'title' => 'Bloodborne',
                'price' => 5.99,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
