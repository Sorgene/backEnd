<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'img', 'title','sort','content',
    ];
// order by one to more
    public function news_imgs()
    {
        return $this->hasMany('App\NewsImgs','news_id','id')->orderby('sort','desc');
    }
}

