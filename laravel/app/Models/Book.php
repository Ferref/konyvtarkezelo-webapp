<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['isbn'];
    public function detail()
    {
        return $this->hasOne(BookDetail::class);
    }
}
