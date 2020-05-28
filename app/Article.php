<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{

    protected $table = 'articles';

    protected $guarded = [
        'id',
    ];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
