<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

    use Notifiable,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id', 'social_id','cust_id', 'account_type', 'first_name', 'last_name', 'email', 'password', 'image','title','dob', 'phone', 'active_token', 'reset_token','terms_and_cond_agreed','terms_and_cond_date', 'status', 'last_login_at','cust_email_notification','cust_phone_notification','address1',
        'address2','country','town','city','post_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setFirstNameAttribute($value) {
        $this->attributes['first_name'] = ucfirst($value);
    }

    public function setLastNameAttribute($value) {
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }

    public function business() {
        return $this->hasOne('App\Business', 'user_id', 'id');
    }

}
