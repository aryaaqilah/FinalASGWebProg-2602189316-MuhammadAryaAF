<?php

namespace Database\Seeders;

use App\Models\Mutual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MutualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mutual = [
            [
                'id_usr_a' => 1,
                'id_usr_b' => 2,
            ],
        ];
        Mutual::insert($mutual);
    }
}
