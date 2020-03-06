<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'img', 'title','sort','content',
    ];

    public function news_images()
    {
        return $this->hasMany('App\NewsImgs');
    }
}
