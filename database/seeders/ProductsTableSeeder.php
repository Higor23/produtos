<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'  => 'Produto 01',
            'cost'  => '10.00',
            'sale'  => '20.00',
        ]);
        Product::create([
            'name'  => 'Produto 02',
            'cost'  => '20.00',
            'sale'  => '30.00',
        ]);
        Product::create([
            'name' => 'Produto 03',
            'cost' => '30.00',
            'sale' => '40.00',
        ]);
    }
}
