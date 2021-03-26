<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model {

    protected $table="order_master";
    protected $fillable = ['user_id','order_number','name','phone','address','city','country','zipcode','payment_gateway', 'total_amount', 'discount_amount', 'pay_amount',
        'currency', 'txn_id', 'chrage_id', 'ip_address', 'status'];

}
