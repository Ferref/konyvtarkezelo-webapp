<?php

namespace App\Models;

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
        'book_id',
        'cover_path',
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

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function keywords()
    {
        return $this->hasMany(Keyword::class, 'book_id', 'book_id');
    }
}
