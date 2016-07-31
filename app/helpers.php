<?php

function arrayTypeOfPost() {
    return ['Phòng trọ, nhà trọ', 'Nhà thuê nguyên căn', 'Cho thuê căn hộ', 'Tìm bạn ở ghép'];
}

function arrayProvince() {
    return App\Provinces::lists('name')->toArray();
}

function arrayCityInProvince($id_province) {
    return App\Districts::where('province_id', $id_province)->lists('name')->toArray();
}

function arrayWard() {
    return ['Phòng trọ, nhà trọ', 'Nhà thuê nguyên căn', 'Cho thuê căn hộ', 'Tìm bạn ở ghép'];
}

function arrayPrice() {
    return ['Phòng trọ, nhà trọ', 'Nhà thuê nguyên căn', 'Cho thuê căn hộ', 'Tìm bạn ở ghép'];
}

function arrayArea() {
    return ['Phòng trọ, nhà trọ', 'Nhà thuê nguyên căn', 'Cho thuê căn hộ', 'Tìm bạn ở ghép'];
}

function arrayObject() {
    return ['Phòng trọ, nhà trọ', 'Nhà thuê nguyên căn', 'Cho thuê căn hộ', 'Tìm bạn ở ghép'];
}

function vn_str_filter($str) {

    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd' => 'đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D' => 'Đ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );

    foreach ($unicode as $nonUnicode => $uni) {

        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }

    return $str;
}
