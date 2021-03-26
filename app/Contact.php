<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model {

    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone_no', 'subject', 'message', 'reply_message', 'reply_status',];

}
