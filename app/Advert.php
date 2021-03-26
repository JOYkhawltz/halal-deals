<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Advert extends Model {

    protected $primaryKey = 'advert_ID'; // or null
    public $incrementing = false;
    protected $fillable = [
        'advert_ID','advert_type', 'prod_ID', 'bus_ID', 'title','youtube_url', 'date_start', 'date_finish', 'deal_start', 'deal_end','voucher_expiry', 'smallprint', 'other_options_available',
        'spec_times','postage','hotoffer', 'spec_times_details', 'new_cust_only', 'reservation_request_immediate','commission_rate','additional_rate', 'cost_price', 'hd_price', 'status','voucher_amount','total_voucher'
    ];

    public function setDateStartAttribute($value) {
        if(!empty($value))
        $this->attributes['date_start'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setDateFinishAttribute($value) {
        if(!empty($value))
        $this->attributes['date_finish'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setDealStartAttribute($value) {
        $this->attributes['deal_start'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setDealEndAttribute($value) {
        $this->attributes['deal_end'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'prod_ID', 'prod_ID');
    }

    public function business(){
        return $this->belongsTo('App\Business','bus_ID','bus_ID');
    }

}
