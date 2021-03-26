<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Wallet extends Model {
    protected $table ='wallet';
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'user_id','amount','bank_name','account_holder_name','account_number','ifsc_code','micr_code','branch_name','status'
    ];

 

}
