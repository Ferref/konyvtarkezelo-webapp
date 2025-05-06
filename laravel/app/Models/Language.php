<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['value'];

    public function details()
    {
        return $this->hasMany(BookDetail::class);
    }

    public function genres()
    {
        return $this->hasMany(Genre::class);
    }
}
