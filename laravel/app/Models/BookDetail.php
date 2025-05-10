<?php

namespace App\Models;

use Faker\Calculator\Isbn;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class BookDetail extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author_id',
        'genre_id',
        'language_id',
        'cover_path',
        'isbn',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function keywords()
    {
        return $this->hasMany(Keyword::class, 'book_id');
    }

}
