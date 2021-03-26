<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model {

    protected $fillable = [
        'page_name', 'content_name', 'content_body',
    ];

}
