<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Providers\Search\Address as Address;

class Zones extends Model implements Address{
    protected $table = 'zones';
    public static function insertData($province_id, $name, $acronym_name) {
        $ward = new \App\Zones();
        $ward->name = $name;
        $ward->acronym_name = $acronym_name;
        $ward->province_id = $province_id;
        $ward->save();
    }
    public static function getZonesByProvince($id_province) {
        return \App\Zones::where('province_id', '=', $id_province)->lists('acronym_name');
    }

    public function findLocation($province_id, $key_word) {
        return \App\Zones::where('province_id', '=', $province_id)
                ->where('acronym_name', 'like', '%'.$key_word.'%')
                ->lists('acronym_name');
    }

}
