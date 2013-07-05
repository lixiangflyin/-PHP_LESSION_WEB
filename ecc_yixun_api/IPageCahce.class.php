<?php
//�Ϻ�վ�����Ź����
class IPageCahce {
	/**
	 * ��ֵǰ׺
	 */
	private static $prefix = 'page_';

	/**
	 * ����ʱ��
	 */
	private static $caheTime = 300;

	/**
	 * Ĭ�Ϸֲ�
	 */
	private static $defindId = 1;

	/**
	 * debugģʽ
	 */
	public static $debug = false;
		
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	public static function logger($msg)
	{
		if( self::$debug )
			Logger::info($msg);
	}
		
	/**
	 * ��ȡҳ�滺���ֵ
	 * @param string $mod ģ����
	 * @param string $func ������
	 * @param string $wid �ֲֺ�
	 * @param array $params ��������, �����˻ҳ����, ��Ҫһ���ID
	 * @return string ��ֵ
	 */
	public static function getCacheKey($mod, $func, $wid='', $params=null)
	{
		if (empty($wid)) {
			$wid = self::$defindId;
		}

		$append = is_array($params) ? implode('_', $params) : $params; //��ʱ�� "_" ֱ������

		return self::$prefix . "_{$mod}_{$func}_{$wid}" . (is_null($append) ? '' : "_{$append}");
	}

	/**
	 * ��ȡҳ�滺��
	 * @param string $mod �ļ���
	 * @param string $func ������
	 * @param string $wid �ֲֺ�
	 * @return string ��������
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
	 * �����ṩ��KEY���cache������
	 * @param key	cache��Key
	 * @return string ��������
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
	 * �����ṩ��KEY�洢cache������
	 * ��������Ѿ����ڣ���ֱ�Ӹ��ǣ����ڵĻ�����һ����¼
	 * @param string $key ����ļ�
	 * @param string $value �����ֵ
	 * @param int $expire �����ʱ��
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
	 * �����ṩ��KEY���cache������
	 * @param string $key ����ļ�
	 * @return string ��������
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
	 * ��������
	 * @param object $obj  ����
	 * @param string $function ������
	 * @param array $param  ��������
	 * @param string $cacheTimeout ����ʱ��
	 * @param string $namespace �ռ���
	 * @param bool $reset �Ƿ�ǿ�����»���
	 * @param array $options �������ã�����keyֵָ��
	 * @return string ��������
	 */
	public static function cached(&$obj, $function, array $param, $cacheTimeout=300, $namespace='', $reset=false, $options=array()) {
		if (!empty($options['key'])) {
			$key = $options['key']; //���ָ����key, ��ֱ��ʹ��
		}
		else {
			$key = $namespace . "_" . get_class($obj) . '_' . $function . '_' . md5(serialize($param)); //��֮��ƴװ
		}

		//���û��ָ�����»�ȡ���ݣ����жϻ����Ƿ����
		$result = (!$reset) ? self::getCacheData($key) : false;

		//�����������Ϊ���ã������Ѿ����ڣ���������������
		if ($reset || $result===false) {
			self::Logger('cache miss: ' . $key);

			$resultNew = call_user_func_array(array(&$obj, $function), $param);
			if ($resultNew) {
				//�������Ϊkey->value���ݸ�ʽ����ʹ�÷��ؽ���е�key����ֵ��������
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

		//����Ѿ�ִ��ȡ�ý��
		if ($result) {
			self::Logger('cache hit: ' . $key);
			return unserialize($result);
		}

		return '';
	}
	
	/**
	 * ������־�����ڲ���ttcʧ�ܱ���
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