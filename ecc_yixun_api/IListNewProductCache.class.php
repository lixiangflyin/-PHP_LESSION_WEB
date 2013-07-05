<?php
//设置List页最新商品缓存
class IListNewProductCache {
	
	private static $expires = 86400;
	
	private static $keyPre = 'list_new_products_key_pre_';
	
	//设置List页最新商品缓存
	public static function setListNewProduct($site_id, $c3Id, $products) {
		return IPageCahce::setCacheData(self::$keyPre . $site_id . $c3Id, serialize($products), self::$expires);
	}
	
	//获取List页最新商品缓存
	public static function getListNewProduct($site_id, $c3Id) {
		return unserialize(IPageCahce::getCacheData(self::$keyPre . $site_id . $c3Id));
	}
}