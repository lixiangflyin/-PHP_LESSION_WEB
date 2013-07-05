<?php
//设置二手商品最新二手和二手特价缓存
class ISecondCache {
	
	private static $expires = 86400;
	
	private static $keyPre = 'second_products_key_pre_';
	
	//设置二手商品最新二手和二手特价缓存
	public static function setSecondProduct($site_id, $products) {
		return IPageCahce::setCacheData(self::$keyPre . $site_id, serialize($products), self::$expires);
	}
	
	//获取二手商品最新二手和二手特价缓存
	public static function getSecondProduct($site_id) {
		return unserialize(IPageCahce::getCacheData(self::$keyPre . $site_id));
	}
}