<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class TrackData extends BaseController {

    public function __construct() {
        
    }

    public function getAddressInPost($post_message, $id_province) {
        $post = new \App\Posts();
        $streets = \App\Streets::getStreetByProvince($id_province);
        $wards = \App\Wards::getWardByProvince($id_province);
        $districts = \App\Districts::getDistrictsByProvinceId($id_province);
        $zones = \App\Zones::getZonesByProvince($id_province);
        $post->message = $post_message;
        $post->street = $this->compareAddress($streets, $post_message, 'đường ', FALSE);
        $post->ward = $this->compareAddress($wards, $post_message, '', FALSE);
        $post->district = $this->compareAddress($wards, $post_message, '', FALSE);
        $post->zone = $this->compareAddress($zones, $post_message, '', TRUE);
        $post->province = \App\Provinces::getProvince($id_province)->name;
        $post->save();
    }

    private function compareAddress($arrayAddress, $message, $pre, $multi_result) {
        $post_message_tolower = mb_strtolower($message);
        $result = '';
        foreach ($arrayAddress as $item) {
            if ($item != null) {
                if (strlen($item) <= 3) {
                    $item = $pre . $item;
                }
                $search_result = strpos($post_message_tolower, mb_strtolower($item));
                if ( $search_result !== FALSE && $multi_result) {
                    $result .= '|'.$item.'|';
                }else if($search_result !== FALSE && $multi_result == FALSE){
                    return $item;
                }
            }
        }
        return $result;
    }

}
