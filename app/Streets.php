<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Providers\Search\Address as Address;

class Streets extends Model implements Address {

    protected $table = 'streets';

    public static function insertData($name, $ward_id) {
        $street = new \App\Streets();
        $street->name = $name;
        $street->district_id = $ward_id;
        $street->save();
    }

    public static function getStreet($id) {
        return \App\Streets::find($id);
    }

    public static function insertListStreet($arrayStreets, $district_id) {
        foreach ($arrayStreets as $item) {
            \App\Streets::insertData($item->name, $district_id);
        }
    }

    public static function getStreetByProvince($id_province) {
        $streets = \App\Provinces::where('provinces.id', '=', $id_province)
                ->leftJoin('districts', 'districts.province_id', '=', 'provinces.id')
                ->leftJoin('streets', 'streets.district_id', '=', 'districts.id')
                ->lists('streets.name');
        return $streets;
    }

    public function findLocation($province_id, $key_word) {
        $streets = \App\Provinces::where('provinces.id', '=', $province_id)
                ->leftJoin('districts', 'districts.province_id', '=', 'provinces.id')
                ->leftJoin('streets', 'streets.district_id', '=', 'districts.id')
                ->where('streets.name', '=', $key_word)
                ->lists('streets.name');
        return $streets;
    }

}
