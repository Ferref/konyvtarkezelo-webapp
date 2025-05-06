<?php

namespace App\Http\Controllers;

// Models
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Genre;
use App\Models\Language;

// Libs
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create(Request $request)
    {
        $input = $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'author'      => 'required|string|min:3|max:255',
            'description' => 'required|string|max:1000',
            'genre'       => 'required|string|min:3|max:255',
            'language'    => 'required|string|in:English,Hungarian',
            'isbn'        => 'required|string|size:13',
        ]);

        try {
            $authorId = Author::query()
                ->firstOrCreate(['name' => $input['author']])
                ->id;

            $languageId = Language::query()
                ->firstOrCreate(['value' => $input['language']])
                ->id;

            $genreId = Genre::query()
                ->firstOrCreate([
                    'language_id' => $languageId,
                    'name'        => $input['genre'],
                ])
                ->id;

            $bookId = Book::query()
                ->firstOrCreate(['isbn' => $input['isbn']])
                ->id;

            BookDetail::create([
                'title'       => $input['title'],
                'description' => $input['description'],
                'author_id'   => $authorId,
                'genre_id'    => $genreId,
                'language_id' => $languageId,
                'book_id'     => $bookId,
            ]);

            return redirect('/')->with('success', 'Book created!!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
