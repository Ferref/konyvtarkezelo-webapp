<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('book_details')->insert([
            [
                'title'=> 'Romeo and Juliet',
                'description' => 'Love story...',
                'cover_path' => 'romeo-juliet.jpg',
                'author_id' => 1,
                'language_id' => 1,
                'genre_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'=> 'Murder on the Orient Express',
                'description' => 'Murder on the Orient Express tells the tale of thirteen strangers stranded on a train, where everyone is a suspect',
                'cover_path' => 'orient.jpg',
                'author_id' => 2,
                'language_id' => 1,
                'genre_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'=> 'The Shining',
                'description'=> 'Winter caretaking at Overlook Hotel turns into a deadly event.',
                'cover_path'=> 'the_shining.jpg',
                'author_id'=> 3,
                'language_id'=> 1,
                'genre_id'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'title'=> 'Az ellopott cirkáló',
                'description'=> 'Magával ragadó tengeri kaland lopott cirkálón.',
                'cover_path'=> 'ellopott_cirkalo.jpg',
                'author_id'=> 4,
                'language_id'=> 2,
                'genre_id'=> 4,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
