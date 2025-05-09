<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            ['name' => 'William Shakespeare', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Agatha Christie', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Stephen King', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rejtő Jenő', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
