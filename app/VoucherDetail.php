<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VoucherDetail extends Model {
    protected $table ='voucher_details';
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'order_id','advert_ID','voucher_ID','bus_ID','status','redeem','purchasing_user'
    ];

 

}
