<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name'   => '10% off',
        ]);

        Tag::create([
            'name'   => '15% off',
        ]);
        
        Tag::create([
            'name'   => '20% off',
        ]);

        
    }
}
