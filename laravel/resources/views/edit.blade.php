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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src={{asset('js/handler.js')}} defer></script>

</head>
<body>
    <div class="app-container">
        <div id="left-panel">
            <div class="navbar">
                <button id="hamburger"><i class="fa fa-times" aria-label="Toggle"></i></button>
            </div>
        <div id="book-edit">
            <h2>Edit book: {{ $book['title'] }}</h2>
            <form action="/edit-book/{{$book['id']}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                <input list="keywords" name="keywords" placeholder="Comma separated" value="{{ request('keywords') }}">
                <datalist id="keywords">
                    @foreach($selection['keywords'] as $keywords)
                        <option value="{{ $keywords }}">{{ $keywords }}</option>
                    @endforeach
                </datalist>

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
        </div>

        @if(!empty($book['cover_path']))
            <div class="book-cover book-cover-big">
                <img src="{{ asset($book['cover_path']) }}" alt='cover-img'>
            </div>
        @endif
    </div>
</body>
</html>
