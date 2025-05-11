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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Romantic',
                'book_id' => 1,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Deadly',
                'book_id' => 1,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Murder on the orient express
            [
                'keyword' => 'Mystery',
                'book_id' => 2,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Train',
                'book_id' => 2,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // The Shining
            [
                'keyword' => 'Winter',
                'book_id' => 3,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'House',
                'book_id' => 3,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Deadly',
                'book_id' => 3,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Az elveszett cirkáló
            [
                'keyword' => 'Ellopott',
                'book_id' => 4,
                'language_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Macbeth
            [
                'keyword' => 'Ambition',
                'book_id' => 5,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Power',
                'book_id' => 5,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Tragedy',
                'book_id' => 5,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Death on the Nile
            [
                'keyword' => 'Nile',
                'book_id' => 6,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Cruise',
                'book_id' => 6,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Murder',
                'book_id' => 6,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Carrie
            [
                'keyword' => 'Telekinesis',
                'book_id' => 7,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'Revenge',
                'book_id' => 7,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword' => 'School',
                'book_id' => 7,
                'language_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
