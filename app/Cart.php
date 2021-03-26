<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $fillable = ['user_id', 'advert_ID', 'item_price', 'quantity','type', 'status'];

    public function AdvertDetails() {
        return $this->belongsTo('App\Advert', 'advert_ID', 'advert_ID');
    }
    public function postage() {
        return $this->belongsTo('App\Advert', 'advert_ID', 'advert_ID')->where('postage', '1');
    }
//
//    public function ProductDefaultImage() {
//        return $this->hasOne('App\ProductImage', 'prod_ID', 'prod_ID')->where('is_default', '1')->where('status','1');
//    }

}
