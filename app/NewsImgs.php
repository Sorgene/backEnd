<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class NewsImgs extends Model
{

    protected $table = 'news_imgs';


    protected $keyType = 'integer';


    protected $fillable = ['news_id', 'img_url', 'sort', 'created_at', 'updated_at',];


}
