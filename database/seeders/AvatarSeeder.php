<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avatar::create([
            'name' => 'Avatar 1',
            'image_path' => 'avatars/avatar1.png',
            'price' => 500,
        ]);

        Avatar::create([
            'name' => 'Avatar 2',
            'image_path' => 'avatars/avatar2.png',
            'price' => 300,
        ]);
    }
}
