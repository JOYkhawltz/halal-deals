<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model {

    protected $primaryKey = 'bus_ID'; // or null
    public $incrementing = false;
    protected $fillable = [
        'bus_ID', 'user_id', 'name', 'address1','address_longitude' ,'address_latitude', 'address2', 'town', 'city', 'post_code', 'prod_types', 'prod_sub_types', 'telphone_no', 'website', 'contact_name', 'contact_no', 'introduction', 'details', 'smallprint', 'halal_cert', 'alchohol_served', 'male_service', 'female_service', 'gender_segregated', 'family_area', 'commission_type', 'commission_rate', 'additional_rate', 'yt_link', 'hd_staff_link','wallet_amount', 'terms_and_cond_agreed', 'terms_and_cond_date'
    ];

    public function hd_staff() {
        return $this->hasOne('App\User', 'id', 'hd_staff_link')->where('type_id', '2');
    }

    public function user() {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

}
