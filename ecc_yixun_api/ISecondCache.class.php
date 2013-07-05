<?php
//���ö�����Ʒ���¶��ֺͶ����ؼۻ���
class ISecondCache {
	
	private static $expires = 86400;
	
	private static $keyPre = 'second_products_key_pre_';
	
	//���ö�����Ʒ���¶��ֺͶ����ؼۻ���
	public static function setSecondProduct($site_id, $products) {
		return IPageCahce::setCacheData(self::$keyPre . $site_id, serialize($products), self::$expires);
	}
	
	//��ȡ������Ʒ���¶��ֺͶ����ؼۻ���
	public static function getSecondProduct($site_id) {
		return unserialize(IPageCahce::getCacheData(self::$keyPre . $site_id));
	}
}