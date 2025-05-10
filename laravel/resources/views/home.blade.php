<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Könyvtárkezelő</title>
    <link rel="icon" href={{'stack-of-books.ico'}} type='image/x-icon'>
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="app-container">
    <div id="left-panel">
        <div id="search-create-panel">
            <form action="/get-books" method="GET" enctype="multipart/form-data">
                @csrf

                <label for="title">Title <i class="fa fa-search"></i></label>
                <input list="titles" id="title" name="title" placeholder="Write the title!" value="{{ request('title') }}">
                <datalist id="titles">
                    @foreach($selection['titles'] as $title)
                        <option value="{{ $title }}">{{ $title }}</option>
                    @endforeach
                </datalist>

                <label for="author">Author <i class="fa fa-search"></i></label>
                <input list="authors" id="author" name="author" placeholder="Write the author!" value="{{ request('author') }}">
                <datalist id="authors">
                    @foreach($selection['authors'] as $author)
                        <option value="{{ $author }}">{{ $author }}</option>
                    @endforeach
                </datalist>

                <label for="genre">Genre <i class="fa fa-search"></i></label>
                <input list="genres" id="genre" name="genre" placeholder="Write the genre!" value="{{ request('genre') }}">
                <datalist id="genres">
                    @foreach($selection['genres'] as $genre)
                        <option value="{{ $genre }}">{{ $genre }}</option>
                    @endforeach
                </datalist>

                <label for="keywords">Keywords (optional) <i class="fa fa-search"></i></label>
                <input list="keywords-list" id="keywords" name="keywords" placeholder="Comma separated" value="{{ request('keywords') }}">

                <label for="language">Language <i class="fa fa-search"></i></label>
                <input list="languages" id="language" name="language" placeholder="Write the language!" value="{{ request('language') }}">
                <datalist id="language">
                    @foreach($selection['languages'] as $language)
                        <option value="{{ $language }}">{{ $language }}</option>
                    @endforeach
                </datalist>

                <label for="isbn">ISBN <i class="fa fa-search"></i></label>
                <input list="isbns" id="isbn" name="isbn" placeholder="Write the isbn!" value="{{ request('isbn') }}">
                <datalist id="isbns">
                    @foreach($selection['isbns'] ?? [] as $isbn)
                        <option value="{{ $isbn }}">{{ $isbn }}</option>
                    @endforeach
                </datalist>

                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Write the description!">{{ request('description') }}</textarea>

                <label for="cover_path">Cover</label>
                <input type="file" id="cover_path" name="cover_path">

                <button type="submit">Search Book</button>
                <button type="submit" formmethod="POST" formaction="/create-book">Create Book</button>
            </form>
        </div>
        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div id="books-panel">
        @if(!empty($books))
            @foreach($books as $book)
                <div class="book-card">
                    @if(!empty($book['cover_path']))
                        <div class="book-cover">
                            <img src="{{ asset($book['cover_path']) }}" alt='cover-img'>
                        </div>
                    @endif
                    <div class="book-data">
                        <h2>{{ $book['title'] }}</h2>
                        <p>Isbn: {{ $book['isbn'] }}</p>
                        <p>Description: {{ $book['description'] }}</p>
                        <p>Author: {{ $book['author'] }}</p>
                        <p>Language: {{ $book['language'] }}</p>
                        <p>Genre: {{ $book['genre'] }}</p>
                        <p>Created at: {{ $book['created_at'] }}</p>
                        <p>Updated at: {{ $book['updated_at'] }}</p>
                        <p>Keywords: {{ $book['keywords'] }}</p>
                    </div>
                    <form action="/edit-book/{{$book['id']}}" name="edit-book" method="GET">
                        @csrf
                        <button name="edit-book">Edit book</button>
                    </form>
                    <form action="/delete-book/{{$book['id']}}" name="delete-book" method="POST">
                        @csrf
                        @method('DELETE')
                        <button name="delete-book">Delete book</button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>
</div>
</body>
</html>
