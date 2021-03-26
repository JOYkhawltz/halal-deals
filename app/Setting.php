<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model {

    public $timestamps = false;

    public static function mysql_version() {
        $sql = 'SELECT VERSION() as version';
        $version = DB::select($sql);
        if (is_array($version) && isset($version[0]->version))
            return $version[0]->version;
        else
            return 'NA';
    }

}
