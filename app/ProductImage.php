<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

    protected $fillable = ['image_name', 'prod_ID', 'is_default', 'status'];

}
