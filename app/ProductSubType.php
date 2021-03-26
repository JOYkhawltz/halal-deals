<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubType extends Model {

    protected $fillable = [
        'parent_id', 'name', 'status',
    ];

}
