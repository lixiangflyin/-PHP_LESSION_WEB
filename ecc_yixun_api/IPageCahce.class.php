<?php
//上海站加入团购入口
class IPageCahce {
	/**
	 * 键值前缀
	 */
	private static $prefix = 'page_';

	/**
	 * 缓存时间
	 */
	private static $caheTime = 300;

	/**
	 * 默认分仓
	 */
	private static $defindId = 1;

	/**
	 * debug模式
	 */
	public static $debug = false;
		
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	public static function logger($msg)
	{
		if( self::$debug )
			Logger::info($msg);
	}
		
	/**
	 * 获取页面缓存键值
	 * @param string $mod 模块名
	 * @param string $func 方法名
	 * @param string $wid 分仓号
	 * @param array $params 其他参数, 加入了活动页功能, 需要一个活动ID
	 * @return string 键值
	 */
	public static function getCacheKey($mod, $func, $wid='', $params=null)
	{
		if (empty($wid)) {
			$wid = self::$defindId;
		}

		$append = is_array($params) ? implode('_', $params) : $params; //暂时用 "_" 直接连接

		return self::$prefix . "_{$mod}_{$func}_{$wid}" . (is_null($append) ? '' : "_{$append}");
	}

	/**
	 * 获取页面缓存
	 * @param string $mod 文件名
	 * @param string $func 方法名
	 * @param string $wid 分仓号
	 * @return string 缓存数据
	 */
	public static function getCachePage($file, $func, $wid='', $params=null)
	{
		if (empty($wid)) {
			$wid = self::$defindId;
		}

		$mod = str_replace('.php', '', basename($file));
		$func = str_replace('page_', '', $func);
		$key = self::getCacheKey($mod, $func, $wid, $params);

		return self::getCacheDataFromKey($key);
	}

	/**
	 * 根据提供的KEY获得cache的数据
	 * @param key	cache的Key
	 * @return string 缓存数据
	 */
	public static function getCacheData($key)
	{
		$v = IPageCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg  = IPageCacheTTC::$errMsg;
			return false;
		}

		if (count($v) != 1) {
			self::$errCode = 11111;
			self::$errMsg  = "count not 1";
			return false;
		}

		$t = time();
		if ($v[0]['expiretime'] < $t) {
			//IPageCacheTTC::remove($key);
			return false;
		}

		return $v[0]['content'];
	}

	/**
	 * 根据提供的KEY存储cache的数据
	 * 如果数据已经存在，这直接覆盖，存在的话新增一条记录
	 * @param string $key 缓存的键
	 * @param string $value 缓存的值
	 * @param int $expire 缓存的时间
	 * @return bool
	 */
	public static function setCacheData($key, $value, $expire=300)
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

		if ($v != false && count($v) > 0 ) 
		{
			IPageCacheTTC::update($item);
		} else {
			IPageCacheTTC::remove($key);
			$v = IPageCacheTTC::insert($item);
			for($i = 0;$i < 5;$i++) {
				if($v) {
					break;
				}
				Logger::info('insert ttc error'.$i);
				self::extLog($key, IPageCacheTTC::$errMsg);
				$v = IPageCacheTTC::insert($item);
				sleep(2);
			}
		}
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg  = IPageCacheTTC::$errMsg;
			return false;
		}
		return true;
	}

	/**
	 * 根据提供的KEY获得cache的数据
	 * @param string $key 缓存的键
	 * @return string 缓存数据
	 */
	public static function getCacheDataFromKey($key)
	{
		$v = IPageCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg  = IPageCacheTTC::$errMsg;
			return false;
		}

		if (count($v) != 1) {
			self::$errCode = 11111;
			self::$errMsg  = "count not 1";
			return false;
		}

		return unserialize($v[0]['content']);
	}

	/**
	 * 缓存数据
	 * @param object $obj  类名
	 * @param string $function 方法名
	 * @param array $param  参数数组
	 * @param string $cacheTimeout 缓存时间
	 * @param string $namespace 空间名
	 * @param bool $reset 是否强制涮新缓存
	 * @param array $options 其他设置，比例key值指定
	 * @return string 缓存数据
	 */
	public static function cached(&$obj, $function, array $param, $cacheTimeout=300, $namespace='', $reset=false, $options=array()) {
		if (!empty($options['key'])) {
			$key = $options['key']; //如果指明了key, 则直接使用
		}
		else {
			$key = $namespace . "_" . get_class($obj) . '_' . $function . '_' . md5(serialize($param)); //反之则拼装
		}

		//如果没有指定重新获取数据，则判断缓存是否过期
		$result = (!$reset) ? self::getCacheData($key) : false;

		//如果参数设置为重置，或者已经过期，则重新设置数据
		if ($reset || $result===false) {
			self::Logger('cache miss: ' . $key);

			$resultNew = call_user_func_array(array(&$obj, $function), $param);
			if ($resultNew) {
				//如果返回为key->value数据格式，则使用返回结果中的key做键值保存数据
				if (is_array($resultNew) && isset($resultNew['key'])) {
					self::setCacheData($resultNew['key'], serialize($resultNew['value']), $cacheTimeout);
				}
				else {
					self::setCacheData($key, serialize($resultNew), $cacheTimeout);
				}

				return $resultNew;
			}
			else {
				return false;
			}
		}

		//如果已经执行取得结果
		if ($result) {
			self::Logger('cache hit: ' . $key);
			return unserialize($result);
		}

		return '';
	}
	
	/**
	 * 额外日志，用于插入ttc失败报警
	 * @param $key			
	 * @param $errorStr
	 */
	private static function extLog($key, $errorStr) {
		$logDir = LOG_ROOT . date("Ymd") . '/';
		if ( !file_exists($logDir) ) {
			@umask(0);
			@mkdir($logDir, 0777, true);
		}

		$fp	= fopen($logDir . "insertttcerror", 'a');
		$str = date('Y-m-d H:i:s') . "\t" . "key:" . $key . "\t" . $errorStr;
		fwrite($fp, $str . "\n");
		fclose($fp);
	}
}