<?php

/*require_once("Config.php");
TMAutoload::getInstance()->execute();*/

class IProductPool {
	
	public static function getProductsByChannel($site_id, $channel_name) {
		$key = "productpool_places_{$site_id}_{$channel_name}";
		$res = IPageCahce::getCacheData($key);
		if($res === false)
			throw new BaseException(101, "Failed to find product keys from ttc with site id $site_id and channel name $channel_name.");
			
		$products = array();
		$product_keys = unserialize($res);
		foreach ($product_keys as $k) {
			$tmp = explode('_', $k);
			$place_id = $tmp[3];
			$res = IPageCahce::getCacheData($k);
			if($res === false)
				throw new BaseException(102, "Failed to find products from ttc with key $k.");
				
			$products[$place_id] = unserialize($res);
		}
		
		return $products;
	}
}

/*try {
	$res = IProductPool::getProductsByChannel(1, 'morning_market');
	var_dump($res);
} catch(BaseException $e) {
	echo $e->errCode . ' : ' . $e->errMsg . "\n";
	throw $e;
}*/