<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model {

    protected $table="order_details";
    protected $fillable = ['user_id','order_id','type','voucher_id','bus_ID','advert_id','quantity','item_price','status'];

}
