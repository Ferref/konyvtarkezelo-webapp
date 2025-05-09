<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            ['value' => 'English',  'created_at' => now(), 'updated_at' => now()],
            ['value' => 'Hungarian',   'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
