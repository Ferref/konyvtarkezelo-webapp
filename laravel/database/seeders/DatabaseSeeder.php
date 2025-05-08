<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('keywords')->truncate();
        DB::table('book_details')->truncate();
        DB::table('books')->truncate();
        DB::table('genres')->truncate();
        DB::table('authors')->truncate();
        DB::table('languages')->truncate();

        Schema::enableForeignKeyConstraints();

        $this->call([
            LanguagesSeeder::class,
//            AuthorsSeeder::class,
//            GenresSeeder::class,
//            BooksSeeder::class,
//            BookDetailsSeeder::class,
//            KeywordsSeeder::class,
        ]);
    }
}
