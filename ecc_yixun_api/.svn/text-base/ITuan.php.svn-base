<?php
//require_once('Config.php');
//require_once('DB.php');
//require_once('Logger.php');
//require_once('TTC.php');
//require_once('TTC2.php');
//require_once(PHPLIB_ROOT . 'dao/IProductListDao.php');
//require_once(PHPLIB_ROOT . 'dao/IProductHeapListDao.php');
//require_once(PHPLIB_ROOT . 'api/inc/IPageCacheTTC.php');
//require_once(PHPLIB_ROOT . 'api/IProduct.php');
//require_once(PHPLIB_ROOT . 'api/IProductRelativity.php');

/**
 * 团购接口
 * @author kunjiang
 * @version 1.0
 */
class ITuan
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;


	/**
	 * 错误消息
	 */
	public static $errMsg  = '';


	public static $NOTFOUND = 11111;

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	public static function getWishCount($site_id, $product_id = 0){
		self::clearErr();
		$LOVE_KEY = self::getLoveKey($site_id);

		$info = self::getCacheData($LOVE_KEY);

		if( false === $info && self::$errCode === self::$NOTFOUND){
			return 0;
		}

		if( false === $info )	return false;

		$info = unserialize($info);

		return empty($product_id) ? $info : ( isset( $info[$product_id] ) ? $info[$product_id] : 0 );
	}


	private static function clearLoveDityData($site_id){

		self::clearErr();

		$LOVE_KEY = self::getLoveKey($site_id);

		$loveData = self::getCacheData($LOVE_KEY);

		if( false === $loveData ){
			return self::$NOTFOUND === self::$errCode ? true : false;
		}

		$loveData = unserialize($loveData);

		$c1idUrl = IProductRelativity::$c1idUrl;

		$product_ids = array();

		$current = null;

		$next = null;

		$error = true;

		foreach($c1idUrl as $c1id => $url ){
			$current = self::getCurrentPeriod($site_id, $c1id);

			if( false !== $current ){
				$next = self::getCurrentPeriod($site_id, $c1id);

				if(false === $next){
					$error = true;
				}
			}
			else{
				$error = true;
			}
		}

		if( true === $error ){
			return false;
		}

		if( !isset( $current['list']) || !isset( $next['list'] ) ){
			self::$errCode =  self::$NOTFOUND2;
			self::$errMsg  =  ( !isset( $current['list']) ? 'current' : 'next' ) . 'data format error';

			return false;
		}

		$res = array_merge( $current['list'], $next['list'] );

		foreach($res as $item){
			$product_ids[ $item['product_id'] ] = $item['product_id'];
		}

		foreach($loveData as $key => $count){
			if(!isset( $product_ids[ $key ]  )){
				unset($loveData[$key]);
			}
		}

		return	self::setCacheData($LOVE_KEY, seralize($loveData));
	}

	public static function setLove($site_id, $product_id){

		self::clearErr();

		self::clearLoveDityData($site_id);

		$LOVE_KEY = self::getLoveKey($site_id);

		$loveData = self::getCacheData($LOVE_KEY);

		if( false === $loveData && self::$errCode !== self::$NOTFOUND){
			return false;
		}

		$loveData = false === $loveData ? array() : unserialize($loveData);

		$loveData[ $product_id ] = isset( $loveData[ $product_id ] ) ? ( intval( $loveData[ $product_id ] ) + 1 ) : 1;

		return self::setCacheData($LOVE_KEY, serialize($loveData) );
	}


	private static function getLoveKey($site_id){
		return "list_icson_com_tuan_love_$site_id";
	}

	public static function getCurrentPeriod($site_id, $c1id = 0 ){

		self::clearErr();

		if( is_array($c1id) || empty( $c1id ) ){

			if( empty( $c1id ) ){
				$c1id = array();

				foreach( IProductRelativity::$c1idUrl as $id => $url ){
					$c1id[] =  $id;
				}
			}

			$keys = array();
			$maps = array();
			foreach($c1id as $id){
				$key = self::getTuanKey($site_id, $id);
				$keys[] = $key;
				$maps[ $key ] = $id;
			}

			$val =  self::getCacheData( $keys );

			if( false == $val ){
				return false;
			}

			$result = array();

			foreach($val as $data){
				if( isset( $maps[ $data['cid'] ] ) ){
					$content = unserialize( $data['content'] );

					if(!empty($content)){
						$result[ ] = array_merge( unserialize( $data['content'] ), array("c1id" => $maps[ $data['cid'] ] ) );
					}
				}
			}

			return $result;
		}

		$key = self::getTuanKey($site_id, $c1id);
		$val =  self::getCacheData( $key );

		if( false !== $val){
			$val = unserialize($val);
		}

		return $val;
	}

	public static function getNextPeriod($site_id, $c1id){

		self::clearErr();
		if( is_array($c1id) || empty( $c1id ) ){

			if( empty( $c1id ) ){
				$c1id = array();

				foreach( IProductRelativity::$c1idUrl as $id => $url ){
					$c1id[] =  $id;
				}
			}

			$keys = array();
			$maps = array();
			foreach($c1id as $id){
				$key = self::getTuanKey($site_id, $id, false);
				$keys[] = $key;
				$maps[ $key ] = $id;
			}

			$val =  self::getCacheData( $keys );

			if( false == $val ){
				return false;
			}

			$result = array();

			foreach($val as $data){
				if( isset( $maps[ $data['cid'] ] ) ){
					$result[ ] = array_merge( unserialize( $data['content'] ), array("c1id" => $maps[ $data['cid'] ] ) );
				}
			}

			return $result;
		}

		$key = self::getTuanKey($site_id, $c1id, false);

		$val =  self::getCacheData( $key );

		if( false !== $val){
			$val = unserialize($val);
		}

		return $val;
	}

	public  static function setCurrentPeriodData($site_id, $c1id, $data){
		$key = self::getTuanKey($site_id, $c1id);

		return self::setCacheData( $key , serialize($data));
	}

	public  static function setNextPeriodData($site_id, $c1id, $data){
		self::clearErr();

		$key = self::getTuanKey($site_id, $c1id, false);

		return self::setCacheData( $key, serialize($data));
	}

	private static function getTuanKey($site_id, $c1id, $thisPeriod = true){
		$thisPeriod = $thisPeriod ? '1' : '0';

		return "list_icson_com_tuan_data_{$site_id}_{$thisPeriod}_{$c1id}";
	}

	/**
	 * 根据提供的KEY获得cache的数据
	 *
	 * @param key    cache的Key
	 */
	private static function getCacheData($key){

		if( is_array($key) ){
			$v = IPageCacheTTC::gets($key);

			if ($v === false) {
				self::$errCode = IPageCacheTTC::$errCode;
				self::$errMsg  = IPageCacheTTC::$errMsg;
				return false;
			}

			return $v;

		}

		$v = IPageCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg  = IPageCacheTTC::$errMsg;
			return false;
		}
		if (count($v)!=1) {
			self::$errCode = self::$NOTFOUND;
			self::$errMsg  = "count not 1";
			return false;
		}

		return $v[0]['content'];
	}

	/**
	 * 根据提供的KEY存储cache的数据
	 * 如果数据已经存在，这直接覆盖，存在的话新增一条记录
	 *
	 * @param key    cache的Key
	 */
	private static function setCacheData($key, $value, $expire=10)
	{
		$v = IPageCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg  = IPageCacheTTC::$errMsg;
			return false;
		}
		$expire = intval($expire);
		$item = array();
		$item['cid'] = $key;
		$item['content'] = $value;
		$item['expiretime'] = time()+$expire;
		$item['updatetime'] = time();
		if ($v!=false) {
			IPageCacheTTC::remove($key);
		}
		$v = IPageCacheTTC::insert($item);
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg  = IPageCacheTTC::$errMsg;
			return false;
		}
		return true;
	}

	/**
	 *
	 * 判断是否去过团购页
	 * @param $isSet
	 */
	public static function checkTuanSn($isSet = false) {
		$key = '12@*76Rwlll';

		$ts = isset($_COOKIE['tuan_icson_ts']) ? $_COOKIE['tuan_icson_ts'] : 0;
		$sn = isset($_COOKIE['tuan_icson_sn']) ? $_COOKIE['tuan_icson_sn'] : 0;

		if ($isSet) {
			$ts = time();
			$sn = md5($ts . md5($key));
			setrawcookie("tuan_icson_ts", $ts, 0, '/', '.51buy.com');
			setrawcookie("tuan_icson_sn", $sn, 0, '/', '.51buy.com');
		} else {
			if (empty($ts) || empty($sn)) {
				return false;
			}
			$snVfy = md5($ts . md5($key));
			$nts = time();
			if ($sn == $snVfy) {
				return true;
			}
			return false;
		}
	}

	/**
	 *
	 * 获取首页团购
	 * @param int $wid
	 */
	public static function getTuanIndex($wid) {
		Logger::init();
		$cacheContent = IPageCahce::getCachePage('tuan', 'tuan_top', $wid);
		if (empty($cacheContent)) {
			Logger::ERR("empty cache:" . IPageCahce::$errCode . ',' . IPageCahce::$errMsg);
			for ($i = 0;$i < 5;$i++) {
				sleep(2);
				$cacheContent = IPageCahce::getCachePage('tuan', 'tuan_top', $wid);
				if (!empty($cacheContent)) {
					Logger::ERR("refetch cache success");
					break;
				}
			}
		}
		return $cacheContent;
	}

}

