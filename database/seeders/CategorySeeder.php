<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            Category::create([
                'name' =>  Str::random(10),
                'parent' => Category::count() ? Category::pluck('id')->random() : 0,
            ]);
        }
    }
}
