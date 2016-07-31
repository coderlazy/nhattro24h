<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Providers\Search\Search;

class Home extends BaseController {

    public function __construct() {
        
    }

    public function index() {
//        $trackData = new \App\Http\Controllers\TrackData();
//        $datas = \App\Streets::getStreetByProvince(2);
//        $datas = $this->getDistricts(2);
//        $datas = $this->getWards(2);
//        $datas = $this->getZones(2);
//        $str = "";
//        foreach ($datas as $data){
//            if(strlen($data) < 5 && strlen($data) > 0){
//                $str .= "<w>đường ".$data."</w>\n";
//            }else if(strlen($street) > 0){
//                $str .= "<w>".$data."</w>\n";
//            }
//        }
//        $trackData->getAddressInPost($p3, 2);
//        $this->importDataUniversity('university_hanoi.json', 2);
        $this->parseJsob();
        return view('home.index', compact("str"));
    }

    public function importDataProvince($json) {
        $data = json_decode(file_get_contents($json));
        foreach ($data as $item) {
            $id_province = \App\Provinces::updateRealId($item->name, $item->id);
            if ($id_province === false) {
                $id_province = \App\Provinces::insertData($item->name, $item->id);
            }
            \App\Districts::insertListDistrict($item->districts, $id_province);
        }
    }

    public function importDataUniversity($json, $provice) {
        $data = json_decode(file_get_contents($json));
        foreach ($data as $item) {
            $item->title = str_replace('(*)', '', $item->title);
            $acronym_name = mb_strtolower($item->title);
            $acronym_name = str_replace('trường', '', $acronym_name);
            $acronym_name = str_replace('đại học', '', $acronym_name);
            $acronym_name = str_replace('học viện', '', $acronym_name);
            $acronym_name = str_replace('đh', '', $acronym_name);
            $temp = str_replace(mb_strtolower(\App\Provinces::getProvince($provice)->name), '', $acronym_name);
            if (strlen(trim($temp)) != 0) {
                $acronym_name = $temp;
            }
            $acronym_name = trim($acronym_name);
            \App\Zones::insertData($provice, $item->title, $acronym_name);
        }
    }

    public function getWards($id_province) {
        return \App\Wards::getWardByProvince($id_province);
    }

    public function getStreets() {
        
    }

    public function getZones($id_province) {
        return \App\Zones::getZonesByProvince($id_province);
    }

    public function getDistricts($id_province) {
        return \App\Districts::getDistrictsByProvinceId($id_province);
    }

    public function parseJsob() {
        $data = file_get_contents('out.txt');
        $data = json_decode($data);
        $prefix_place = ["o", "khu vuc", "tai", "dia chi", "ngo", "đc", "khu", "gan"];
        $search = new Search();
        $result = '';
        for ($i = 0; $i < count($data); $i++) {
            $word_massage = $data[$i]->message[0];
            for ($j = 0; $j < count($word_massage);$j++) {
                $pre_fix = vn_str_filter($word_massage[$j]->value);
                if (in_array($pre_fix, $prefix_place)) {
                    for ($k = $j+1; $k < count($word_massage);$k++) {
                        $result_temp = $search->findAddress(2, $word_massage[$k]->value);
                        if(strlen($result_temp) > 0){
                            dd($result_temp);
                            $result .= $result_temp;
                        }
                    }
                }
            }
            dd($result);
        }
    }

}
