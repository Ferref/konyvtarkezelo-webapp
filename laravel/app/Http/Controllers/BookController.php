<?php

namespace App\Http\Controllers;

// Models
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Keyword;

// Libs
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function deleteBook(Book $book){
        $book->delete();
        return redirect('/get-books');
    }

    public function getAllBooks(Request $request)
    {
        $langFilter = $request->input('language', '');

        $query = Book::with([
            'details.author',
            'details.language',
            'details.genre',
            'details.keywords',
        ]);

        if ($langFilter !== '') {
            $query->whereHas('details.language', function($q) use ($langFilter) {
                $q->where('value', $langFilter);
            });
        }

        $books = $query->get();

        $allBookData=[];
        foreach($books as $book){
            foreach($book->details as $detail){

                $keywords = $detail->keywords
                    ->where('language_id', $detail->language_id)
                    ->pluck('keyword')
                    ->implode(', ');

                if($langFilter!=='' && $detail->language->value !== $langFilter)
                    continue;

                $allBookData[]=[
                    'id' => $book->id,
                    'isbn'=>$book->isbn,
                    'title'=>$detail->title,
                    'description'=>$detail->description,
                    'author'=>$detail->author->name,
                    'language'=>$detail->language->value,
                    'genre'=>$detail->genre->name,
                    'cover_path'=>$detail->cover_path,
                    'keywords'=>$keywords,
                    'created_at'=>$detail->created_at->toDateTimeString(),
                    'updated_at'=>$detail->updated_at->toDateTimeString(),
                ];
            }
        }

        return view('home')->with('books', $allBookData);
    }


    public function create(Request $request)
    {
        $keywords = $request->input('keyword', '');
        $keywordsArr = [];

        if($keywords !== '') {
            $keywordsArr = explode(',', $keywords);
        }

        $input = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:255',
            'description' => 'required|string|max:1000',
            'genre' => 'required|string|min:3|max:255',
            'language' => 'required|string|in:English,Hungarian',
            'isbn' => 'required|string|size:13',
            'cover_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'keywords' => 'nullable|string',
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
                    'name' => $input['genre'],
                ])
                ->id;

            $bookId = Book::query()
                ->firstOrCreate(['isbn' => $input['isbn']])
                ->id;

            $keywords = array_filter(array_map('trim', explode(',', $input['keywords'] ?? '')));

            foreach ($keywords as $word) {
                Keyword::query()->firstOrCreate([
                    'book_id' => $bookId,
                    'language_id' => $languageId,
                    'keyword' => $word,
                ]);
            }

            BookDetail::create([
                'title' => $input['title'],
                'description' => $input['description'],
                'author_id' => $authorId,
                'genre_id' => $genreId,
                'language_id' => $languageId,
                'book_id' => $bookId,
            ]);

            return view('/get-books')->with('success', 'Book created!!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}

