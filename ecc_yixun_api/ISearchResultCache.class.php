<?php
//设置搜索结果设置的缓存
class ISearchResultCache {
	
	private static $expires = 86400;
	
	private static $redirectKeyPre = 'redirect_search_result_key_pre_';
	
	private static $htmlKeyPre = 'html_search_result_key_pre_';
	
	//设置搜索结果跳转缓存
	public static function setSearchResultRedirect($key, $url) {
		$key = md5($key);
		return IPageCahce::setCacheData(self::$redirectKeyPre . $key, serialize($url), self::$expires);
	}
	
	//获取搜索结果缓存
	public static function getSearchResultRedirect($key) {
		$key = md5($key);
		return unserialize(IPageCahce::getCacheData(self::$redirectKeyPre . $key));
	}
	
	//设置搜索结果html缓存
	public static function setSearchResultHtml($key, $content) {
		$key = md5($key);
		return IPageCahce::setCacheData(self::$htmlKeyPre . $key, serialize($content), self::$expires);
	}
	
	//获取搜索结果html缓存
	public static function getSearchResultHtml($key) {
		$key = md5($key);
		return unserialize(IPageCahce::getCacheData(self::$htmlKeyPre . $key));
	}
}