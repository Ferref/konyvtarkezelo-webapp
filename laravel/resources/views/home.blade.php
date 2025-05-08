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
</head>
<body>
<div class="app-container">
    <div id="search-panel">
        <form action="/create-book" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Write the title!">

            <label for="author">Author</label>
            <input type="text" id="author" name="author" placeholder="Write the author!">

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Write the description!"></textarea>

            <label for="keywords">Keywords (optional)</label>
            <textarea id="keywords" name="keywords" placeholder="Write keywords separated by ',' !"></textarea>

            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" placeholder="Write the genre!">

            <label for="language">Language</label>
            <select id="language" name="language">
                <option value="">All</option>
                <option value="English">English</option>
                <option value="Hungarian">Hungarian</option>
            </select>

            <label for="genre">ISBN</label>
            <input type="text" id="isbn" name="isbn" placeholder="Write the isbn!">

            <label for="cover_path">Cover</label>
            <input type="file" id="cover_path" name="cover_path"><br>

            <button type="submit">Create Book</button>
        </form>
        <form action="/get-books" method="GET">
            <button type="submit">Search Book</button>
        </form>

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
                        <p>Description :{{ $book['description'] }}</p>
                        <p>Author :{{ $book['author'] }}</p>
                        <p>Language :{{ $book['language'] }}</p>
                        <p>Genre: {{ $book['genre'] }}</p>
                        <p>Created at: {{ $book['created_at'] }}</p>
                        <p>Updated at: {{ $book['updated_at'] }}</p>
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
