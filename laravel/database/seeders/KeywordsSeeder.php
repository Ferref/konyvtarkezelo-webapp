<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeywordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('keywords')->insert([
            // Romeo and Juliet
            [
                'keyword' => 'Love',
                'book_id' => 1,
                'language_id' => 1,
            ],
            [
                'keyword' => 'Romantic',
                'book_id' => 1,
                'language_id' => 1,
            ],
            [
                'keyword' => 'Deadly',
                'book_id' => 1,
                'language_id' => 1,
            ],

            // Murder on the orient express
            [
                'keyword' => 'Mystery',
                'book_id' => 2,
                'language_id' => 1,
            ],
            [
                'keyword' => 'Train',
                'book_id' => 2,
                'language_id' => 1,
            ],

            // The Shining
            [
                'keyword' => 'Winter',
                'book_id' => 3,
                'language_id' => 1,
            ],
            [
                'keyword' => 'House',
                'book_id' => 3,
                'language_id' => 1,
            ],
            [
                'keyword' => 'Deadly',
                'book_id' => 3,
                'language_id' => 1,
            ],

            // Az ellopott cirkáló
            [
                'keyword' => 'Ellopott',
                'book_id' => 4,
                'language_id' => 2,
            ],
        ]);
    }
}
