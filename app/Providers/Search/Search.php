<?php

namespace App\Providers\Search;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author LazyCode
 */
class Search {

    private $street;
    private $ward;
    private $district;
    private $province;
    private $zone;

    public function __construct() {
        
    }

    public function findAddress($province_id, $key_word) {
        $address = '';
        $this->street = (new \App\Streets())->findLocation($province_id, $key_word);
        $this->ward = (new \App\Wards())->findLocation($province_id, $key_word);
        $this->district = (new \App\Districts())->findLocation($province_id, $key_word);
        $this->zone = (new \App\Zones())->findLocation($province_id, $key_word);
        $this->province = $province_id;
        if (!$this->getStreet()) {
            $address .= $this->getStreet() . ' ';
        }
        if (!$this->getZone()) {
            $address .= $this->getZone() . ' ';
        }
        if (!$this->getWard()) {
            $address .= $this->getWard() . ' ';
        }

        if (!$this->getDistrict()) {
            $address .= $this->getDistrict() . ' ';
        }
        return $address;
    }

    function getStreet() {
        $result = '';
        if (count($this->street) > 0) {
            foreach ($this->street as $st) {
                $result .= $st . ', ';
            }
        }
        return false;
    }

    function getWard() {
        return $this->ward;
        $result = 'Ward: ';
        if (count($this->ward) > 0) {
            foreach ($this->ward as $st) {
                $result .= $st . ', ';
            }
            return $result;
        }
        return false;
    }

    function getDistrict() {
        return $this->district;
        $result = 'District: ';
        if (count($this->district) > 0) {
            foreach ($this->district as $st) {
                $result .= $st . ', ';
            }
            return $result;
        }
        return false;
    }

    function getProvince() {
        return $this->province;
    }

    function setStreet($street) {
        $this->street = $street;
    }

    function setWard($ward) {
        $this->ward = $ward;
    }

    function setDistrict($district) {
        $this->district = $district;
    }

    function setProvince($province) {
        $this->province = $province;
    }

    function getZone() {
        return $this->zone;
        $result = 'Zone: ';
        if (count($this->zone) > 0) {
            foreach ($this->zone as $st) {
                $result .= $st . ', ';
            }
            return $result;
        }
        return false;
    }

    function setZone($zone) {
        $this->zone = $zone;
    }

}
