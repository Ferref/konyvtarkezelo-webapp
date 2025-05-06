<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Könyvtárkezelő</title>
</head>
<body>
<div id="books">
    <form action="/create-book" method="POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Write the title!">

        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Write the description!"></textarea>

        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre" placeholder="Write the genre!">

        <label for="language">Language</label>
        <select id="language" name="language">
            <option value="en">English</option>
            <option value="hu">Hungarian</option>
        </select>

        <label for="description">Description</label>
        <textarea name="description" placeholder="..."></textarea>
        <button type="submit">Create Book</button>
    </form>
</div>
</body>
</html>
