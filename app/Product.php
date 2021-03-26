<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Product extends Model {

    protected $primaryKey = 'prod_ID'; // or null
    public $incrementing = false;
    protected $fillable = ['prod_ID', 'bus_ID', 'name', 'brief_description', 'detailed_description',
        'smallprint', 'normal_price', 'actual_deal','type','sub_type', 'price_verified', 'price_verified_date', 'address_required', 'postage_cost', 'status', 'commission_type', 'commission_rate', 'additional_rate','discount_id','discount_price'];

    public function business() {
        return $this->belongsTo('App\Business', 'bus_ID', 'bus_ID');
    }

    public function vendor($id) {
        return User::findorFail($id);
    }

    public function images() {
        return $this->hasMany('App\ProductImage', 'prod_ID', 'prod_ID');
    }

    public function defaultPic() {
        return $this->hasOne('App\ProductImage', 'prod_ID', 'prod_ID')->where('is_default', '1')->where('status', '1');
    }

}
