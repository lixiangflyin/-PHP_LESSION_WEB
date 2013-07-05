<?php

class IArea {

	public static function getAreaInfoByDistrictId($districtId) {
		global $_District, $_City, $_Province;

		$result = array(
			'district' => '',
			'city' => '',
			'province' => '',
		);

		if (isset($_District[$districtId])) {
			$result['district'] =  $_District[$districtId]['name'];
			$result['city'] = $_City[$_District[$districtId]['city_id']]['name'];
			$result['province'] = $_Province[$_City[$_District[$districtId]['city_id']]['province_id']];
		}

		return $result;
	}

}