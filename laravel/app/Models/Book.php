<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['isbn'];
    public function details()
    {
        return $this->hasMany(BookDetail::class);
    }

}
