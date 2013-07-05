<?php

class IAdSystem {
	
	public static function getAdByChannel($site_id, $channel_name) {
		$key = "adsys_ads_{$site_id}_{$channel_name}";
		$res = IPageCahce::getCacheData($key);
		if(!empty($res)) {
			return unserialize($res);
		} else {
			throw new BaseException(101, "Failed to get ads by channel name $channel_name.");
		}
	}
	
	public static function getAdByPosition($site_id, $position_name) {
		$res = IAdPosition::findPositions(array(
			'name' => $position_name,
			'status' => 1
		));
		if(empty($res))
			throw new BaseException(101, "Failed to find position with name $position_name.");
			
		$position = $res[0];
		$maps = IAdMap::findAdMaps(array(
			'pid' => $position['pid'],
			'site_id' => $site_id,
			'status' => 1
		));
		$ads = array();
		foreach ($maps as $map) {
			$ad = IAdInfo::getAdvertise($map['aid']);
			$now = date('Y-m-d H:i');
			if($ad['starttime'] <= $now && $ad['endtime'] >= $now) {
				$ads[] = array(
					'aid' => $ad['aid'],
					'url' => $ad['url'],
					'img_wide' => $ad['adurl'],
					'img_narrow' => $ad['adurl2'],
					'content' => $ad['content'],
					'w_width' => $position['width'],
					'w_height' => $position['height'],
					'n_width' => $position['width2'],
					'n_height' => $position['height2']
				);
			}
		}
		return $ads;
	}
}