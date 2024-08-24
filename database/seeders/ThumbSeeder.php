<?php

namespace Database\Seeders;

use App\Models\Thumb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThumbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thumb = [
            [
                'id_usr_a' => 1,
                'id_usr_b' => 2,
            ],
            [
                'id_usr_a' => 2,
                'id_usr_b' => 1,
            ],
            [
                'id_usr_a' => 1,
                'id_usr_b' => 3,
            ],
        ];
        Thumb::insert($thumb);
    }
}
