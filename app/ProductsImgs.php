<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $products_id
 * @property string $img_url
 * @property int $sort
 * @property string $created_at
 * @property string $updated_at
 */
class ProductsImgs extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */

    protected $table = 'products_imgs';

    protected $keyType = 'integer';

    /**
     * @var array
     */

    protected $fillable = ['products_id', 'img_url', 'sort', 'created_at', 'updated_at'];

}
