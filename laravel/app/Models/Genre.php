<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Genre extends Model
{
    protected $fillable = ['language_id', 'name'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function details()
    {
        return $this->hasMany(BookDetail::class);
    }
}
