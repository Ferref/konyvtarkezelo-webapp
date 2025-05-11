<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookhandler</title>
    <link rel="icon" href={{'stack-of-books.ico'}} type='image/x-icon'>
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
</head>
<body>
    <div class="app-container">
        <div id="book-edit">
            <h2>Edit book: {{ $book['title'] }}</h2>
            <form action="/edit-book/{{$book['id']}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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

                <button type="submit">Edit Book</button>
            </form>

            <form action="/get-books" method="GET">
                <button>Cancel</button>
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

        @if(!empty($bookDetails['cover_path']))
            <div class="book-cover book-cover-big">
                <img src="{{ asset($bookDetails['cover_path']) }}" alt='cover-img'>
            </div>
        @endif
    </div>
</body>
</html>
