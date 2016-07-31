<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Providers\Search\Address as Address;

class Districts extends Model implements Address {

    protected $table = 'districts';

    public static function insertData($name, $province_id) {
        $district = new \App\Districts();
        $district->name = $name;
        $district->province_id = $province_id;
        $district->save();
        return $district->id;
    }

    public static function getDistrict($id) {
        return \App\Districts::find($id);
    }

    public static function insertListDistrict($arrayDistricts, $id_province) {
        foreach ($arrayDistricts as $item) {
            $district_id = \App\Districts::insertData($item->name, $id_province);
            \App\Wards::insertListWard($item->wards, $district_id);
            \App\Streets::insertListStreet($item->streets, $district_id);
        }
    }

    public static function getDistrictsByProvinceId($id_province) {
        $districts = \App\Provinces::where('provinces.id', '=', $id_province)
                ->leftJoin('districts', 'districts.province_id', '=', 'provinces.id')
                ->lists('districts.name');
        return $districts;
    }

    public function findLocation($province_id, $key_word) {
        $districts = \App\Provinces::where('provinces.id', '=', $province_id)
                ->where('districts.name', 'like', '%' . $key_word . '%')
                ->leftJoin('districts', 'districts.province_id', '=', 'provinces.id')
                ->lists('districts.name');
        return $districts;
    }

}
