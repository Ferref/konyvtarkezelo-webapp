<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Könyvtárkezelő</title>
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
</head>
<body>
<div class="app-container">
    <div id="search-panel">
        <form action="/create-book" method="POST">
            @csrf
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Write the title!">

            <label for="author">Author</label>
            <input type="text" id="author" name="author" placeholder="Write the author!">

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Write the description!"></textarea>

            <label for="keywords">Keywords</label>
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
            @foreach($books as $b)
                <h2>{{ $b['title'] }}</h2>
                <p>Isbn: {{ $b['isbn'] }}</p>
                <p>Description :{{ $b['description'] }}</p>
                <p>Author :{{ $b['author'] }}</p>
                <p>Language :{{ $b['language'] }}</p>
                <p>Genre: {{ $b['genre'] }}</p>
                <p>Created at: {{ $b['created_at'] }}</p>
                <p>Updated at: {{ $b['updated_at'] }}</p>
            @endforeach
        @endif
    </div>
</div>
</body>
</html>
