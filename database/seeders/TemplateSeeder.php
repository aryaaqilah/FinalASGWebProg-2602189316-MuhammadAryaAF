<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}

        // DB::table('books')->insert([
        //     ['title'=>'Book 1',
        //     'category_id' => random_int(1,3)],
        //     ['title'=>'Book 2',
        //     'category_id' => random_int(1,3)],
        //     ['title'=>'Book 3',
        //     'category_id' => random_int(1,3)],
        // ]);

        // $faker = Faker::create('id_ID');
        // for($i=0; $i<100;$i++){
        //     DB::table('details') -> insert([
        //         'book_id' => $faker->unique()->numberBetween(1,100),
        //         'author' => $faker->unique()->name(),
        //         'publisher' => $faker->unique()->company(),
        //         'year' => $faker->year(),
        //         'description' => $faker->paragraph(),
        //     ]);
        // }
