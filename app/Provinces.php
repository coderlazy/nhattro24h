<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model {

    protected $table = 'provinces';

    public static function insertData($name, $real_id) {
        $province = new \App\Provinces();
        $province->name = $name;
        $province->province_id = $real_id;
        $province->save();
        return $province->id;
    }

    public static function getProvince($id) {
        return \App\Provinces::find($id);
    }

    public static function updateRealId($name, $id) {
        $province = \App\Provinces::where('name', 'like', '%' . $name . '%')->first();
        if ($province) {
            $province->province_id = $id;
            $province->save();
            return $province->id;
        }
        return false;
    }
}
