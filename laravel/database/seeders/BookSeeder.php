<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'id'   => 1,
                'isbn' => '9780743273365',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'   => 2,
                'isbn' => '9780451524935',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'   => 3,
                'isbn' => '9780060945467',
                'created_at' => now(),
                'updated_at' => now(),
            ]]);

    }
}
