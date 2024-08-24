<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'email' => 'a@gmail.com',
                'password' => bcrypt('123'),
                'name' => 'aaa',
                'gender' => 'Pria',
                'hobbies' => 'soccer, music, drawing',
                'insta_username' => 'aaa_ig',
                'has_paid' => 1,
                'register_price' => rand(100000,125000),
            ],
            [
                'email' => 'b@gmail.com',
                'password' => bcrypt('123'),
                'name' => 'bbb',
                'gender' => 'Wanita',
                'hobbies' => 'drawing, music',
                'insta_username' => 'bbb_ig',
                'has_paid' => 1,
                'register_price' => rand(100000,125000),
            ],
            [
                'email' => 'c@gmail.com',
                'password' => bcrypt('123'),
                'name' => 'ccc',
                'gender' => 'Wanita',
                'hobbies' => 'drawing, soccer',
                'insta_username' => 'ccc_ig',
                'has_paid' => 1,
                'register_price' => rand(100000,125000),
            ]
        ];
        User::insert($users);

        $this->call([
            MutualSeeder::class,
            ThumbSeeder::class,
            AvatarSeeder::class,
        ]);
    }
}
