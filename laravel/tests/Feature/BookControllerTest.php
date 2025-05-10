<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Genre;
use App\Models\BookDetail;


class BookControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function testBooksByGenre()
    {
        $genre_id = Genre::query()->where('name', 'Horror')->first()->id;
        $horrorCount = BookDetail::query()->where('genre_id', '=', $genre_id)->count();
        $response = $this->getJson('/get-books?genre=Horror');
        $response->assertStatus(200);
        $response['books']->count = $horrorCount;
    }
}
