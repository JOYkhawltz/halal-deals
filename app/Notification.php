<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $fillable = ['from_id', 'notify_view_users', 'notifiers_id', 'notify_msg', 'type', 'status'];

}
