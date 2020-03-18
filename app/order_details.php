<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    protected $table = 'orders';


    // protected $keyType = 'integer';


    protected $fillable = ['user_id','recipient_name','recipient_phone','recipient_address','shipment_time','total_price',];

}
