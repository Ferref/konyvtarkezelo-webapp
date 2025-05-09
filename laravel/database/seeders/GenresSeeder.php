<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['name' => 'Horror', 'language_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Drama', 'language_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Crime', 'language_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Krimi', 'language_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
