<?php

namespace App\Http\Controllers;

// Models
use App\Models\Author;
use App\Models\BookDetail;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Keyword;

// Libs
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function editBook(Request $request, BookDetail $book)
    {
        $input = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:255',
            'description' => 'required|string|max:1000',
            'genre' => 'required|string|min:3|max:255',
            'language' => 'required|string|in:English,Hungarian',
            'isbn' => 'required|string|size:13',
            'cover_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'keywords' => 'nullable|string',
        ]);

        try {
            $input = array_map('strip_tags', $input);

            foreach (['title','author','genre','language', 'keywords'] as $f)
                if (isset($input[$f])) $input[$f] = ucwords(strtolower($input[$f]));

            // Replacing cover path if new cover path available
            $input['existing_cover_path'] = $book['cover_path'];

            if ($request->hasFile('cover_path')) {
                $file = $request->file('cover_path');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('covers'), $name);
                $cover = 'covers/' . $name;
            } else {
                $cover = $input['existing_cover_path'];
            }

            // Update other fields
            $book->update(['isbn' => $input['isbn']]);
            $authorId = Author::query()->firstOrCreate(['name' => $input['author']])->id;
            $languageId = Language::query()->firstOrCreate(['value' => $input['language']])->id;
            $genreId = Genre::query()->firstOrCreate([
                'language_id' => $languageId,
                'name' => $input['genre'],
            ])->id;

            $book->update([
                'title' => $input['title'],
                'description' => $input['description'],
                'cover_path' => $cover,
                'author_id' => $authorId,
                'genre_id' => $genreId,
                'language_id' => $languageId,
            ]);

            $keywords = array_filter(array_map('trim', explode(',', $input['keywords'] ?? '')));
            Keyword::query()->where('book_id', $book->id)->delete();
            foreach ($keywords as $word) {
                Keyword::query()->firstOrCreate([
                    'book_id' => $book->id,
                    'language_id' => $languageId,
                    'keyword' => $word,
                ]);
            }
        }
        catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect('/get-books')->with('success', 'Book updated!');
    }

    public function showEditBookForm(Request $request, BookDetail $book){
        $bookDetails = $book->toArray();

        $selection = [
            'titles' => BookDetail::query()->pluck('title')->unique()->values()->all(),
            'authors' => Author::query()->pluck('name')->unique()->values()->all(),
            'languages' => Language::query()->pluck('value')->unique()->values()->all(),
            'genres' => Genre::query()->pluck('name')->unique()->values()->all(),
            'isbn' => BookDetail::query()->pluck('isbn')->unique()->values()->all(),
            'keywords' => Keyword::query()->pluck('keyword')->unique()->values()->all(),
        ];

        return view('edit', ['book' => $bookDetails, 'selection' => $selection]);
    }

    public function deleteBook(BookDetail $book){
        $book->delete();
        return redirect('/get-books');
    }

    public function getBooks(Request $request)
    {
        $filters = $request->only(['title','author','description','genre','language','keywords', 'isbn']);
        $query = BookDetail::query()->with(['author','language','genre','keywords']);

        $selection = [
            'titles' => BookDetail::query()->pluck('title')->unique()->values()->all(),
            'authors' => Author::query()->pluck('name')->unique()->values()->all(),
            'languages' => Language::query()->pluck('value')->unique()->values()->all(),
            'genres' => Genre::query()->pluck('name')->unique()->values()->all(),
            'isbn' => BookDetail::query()->pluck('isbn')->unique()->values()->all(),
            'keywords' => Keyword::query()->pluck('keyword')->unique()->values()->all(),
        ];

        // Filtering results by input
        if(!empty($filters['isbn'])){
            $query->where('isbn','like','%'.$filters['isbn'].'%');
        }
        if(!empty($filters['title'])){
            $query->where('title','like','%'.$filters['title'].'%');
        }
        if(!empty($filters['description'])){
            $query->where('description','like','%'.$filters['description'].'%');
        }
        if(!empty($filters['genre'])){
            $query->whereHas('genre', fn($g)=>$g->where('name','like','%'.$filters['genre'].'%'));
        }
        if(!empty($filters['language'])){
            $query->whereHas('language', fn($l)=>$l->where('value',$filters['language']));
        }
        if (!empty($filters['keywords'])) {
            $terms = array_filter(array_map('trim', explode(',', $filters['keywords'])));
            foreach ($terms as $term) {
                $query->whereHas('keywords', function ($q) use ($term) {
                    $q->where('keyword', 'like', '%' . $term . '%');
                });
            }
        }

        if(!empty($filters['author'])){
            $query->whereHas('author', fn($a)=>$a->where('name','like','%'.$filters['author'].'%'));
        }

        // Get results by filters
        $books = $query->get()->map(function(BookDetail $book){
                $keywords = $book->keywords->pluck('keyword')->implode(', ');
                return [
                    'id' => $book->id,
                    'isbn' => $book->isbn,
                    'title' => $book->title,
                    'description' => $book->description,
                    'author' => $book->author->name,
                    'language'=> $book-> language->value,
                    'genre'=> $book-> genre->name,
                    'cover_path'=> $book->cover_path,
                    'keywords' => $keywords,
                    'created_at' => $book->created_at->toDateTimeString(),
                    'updated_at' => $book->updated_at->toDateTimeString(),
                ];
            });

        $books = $books->sortByDesc('created_at');

        return view('home',['books'=>$books, 'selection'=>$selection]);
    }

    public function create(Request $request)
    {
        // Keywords stored as string separated by comma
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
            'cover_path' => 'nullable|file|max:2048|mimes:jpg,jpeg,png',
            'keywords' => 'nullable|string',
        ]);

        $input = array_map('strip_tags', $input);

        // Captilize input-fields before inserting
        foreach (['title','author','genre','language', 'keywords'] as $f)
            if (isset($input[$f])) $input[$f] = ucwords(strtolower($input[$f]));

        try {
            $cover_path = null;

            if($request->hasFile('cover_path')){
                $coverFile = $request->file('cover_path');
                $coverFileName = time().'.'.$coverFile->getClientOriginalName();
                $coverFile->move(public_path('covers'), $coverFileName);
                $cover_path = 'covers/' . $coverFileName;
            }
            else {
                $cover_path = 'covers/no-cover.png';
            }

            $authorId = Author::query()->firstOrCreate(['name' => $input['author']])->id;
            $languageId = Language::query()->firstOrCreate(['value' => $input['language']])->id;
            $genreId = Genre::query()->firstOrCreate(['language_id' => $languageId, 'name' => $input['genre']])->id;
            $keywords = array_filter(array_map('trim', explode(',', $input['keywords'] ?? '')));

            foreach ($keywords as $word) {
                Keyword::query()->firstOrCreate([
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
                'isbn' => $input['isbn'],
                'cover_path' => $cover_path,
            ]);

            return view('/get-books')->with('success', 'Book created!!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}

