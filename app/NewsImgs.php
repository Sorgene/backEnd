<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $new_id
 * @property string $img_url
 * @property int $sort
 * @property string $created_at
 * @property string $updated_at
 */
class NewsImgs extends Model
{

    protected $table = 'news_imgs';


    protected $keyType = 'integer';


    protected $fillable = ['new_id', 'img_url', 'sort', 'created_at', 'updated_at'];



}
