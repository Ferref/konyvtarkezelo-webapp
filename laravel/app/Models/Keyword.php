<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['book_id', 'language_id', 'keyword'];

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
