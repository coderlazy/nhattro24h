<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Providers\Search\Address as Address;

class Wards extends Model implements Address{

    protected $table = 'wards';

    public static function insertData($name, $pre, $district_id) {
        $ward = new \App\Wards();
        $ward->name = $name;
        $ward->district_id = $district_id;
        $ward->pre = $pre;
        $ward->save();
    }

    public static function getWard($id) {
        return \App\Wards::find($id);
    }

    public static function insertListWard($arrayWards, $district_id) {
        foreach ($arrayWards as $item) {
            \App\Wards::insertData($item->name, $item->pre, $district_id);
        }
    }

    public static function getWardByProvince($id_province) {
        $wards = \App\Provinces::where('provinces.id', '=', $id_province)
                ->leftJoin('districts', 'districts.province_id', '=', 'provinces.id')
                ->leftJoin('wards', 'wards.district_id', '=', 'districts.id')
                ->lists('wards.name');
        return $wards;
    }

    public function findLocation($province_id, $key_word) {
         $wards = \App\Provinces::where('provinces.id', '=', $province_id)
                 ->where('wards.name', 'like', '%'.$key_word.'%')
                ->leftJoin('districts', 'districts.province_id', '=', 'provinces.id')
                ->leftJoin('wards', 'wards.district_id', '=', 'districts.id')
                ->lists('wards.name');
        return $wards;
    }

}
