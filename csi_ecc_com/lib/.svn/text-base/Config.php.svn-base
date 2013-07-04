<?php
date_default_timezone_set("Asia/Shanghai");
/**
 * 处理整个项目中的配置文件信息
 *
 * @author ericfu
 * @version 1.0
 * @created 18-六月-2008 17:32:31
 */

// 判断运行环境,设定环境标识
// 网购现有发布流程: dev->gamma->idc
// 运行环境标识优先级: dev > gamma > idc
$_ENV_FLAG = '';
// if (file_exists(ROOT_DIR . 'etc/dev.inecfg.inc.php')) {
	// $_ENV_FLAG = 'dev.';
// } elseif (file_exists(ROOT_DIR . 'etc/gamma.inecfg.inc.php')) {
	// $_ENV_FLAG = 'gamma.';
// }
$_ENV_FLAG = Config::getEnvName();

require_once ROOT_DIR.'etc/'.$_ENV_FLAG . 'inecfg.inc.php';
//require_once ROOT_DIR.'etc/'.$_ENV_FLAG . 'extcfg.inc.php';
require_once ROOT_DIR . 'inc/constant.inc.php';
require_once ROOT_DIR . 'lib/DB.php';
require_once ROOT_DIR . 'lib/MSSQL.php';
require_once ROOT_DIR . 'lib/TTC.php';
require_once ROOT_DIR . 'lib/TTC2.php';

class Config
{
	/**
	 * 错误编码
	 *
	 * @var int
	 */
	public static $errCode = 0;

	/**
	 * 错误信息
	 *
	 * @var string
	 */
	public static $errMsg = '';

	/**
	 * 保存项目中DB的句柄
	 *
	 * @var array
	 */
	private static $DBResMap = array();

	/**
	 * 保存项目中MSDB的句柄
	 *
	 * @var array
	 */
	private static $MSDBResMap = array();

	/**
	 * 保存项目中MemCache的句柄
	 *
	 * @var array
	 */
	private static $CacheResMap = array();

	/**
	 * 保存项目中TTC的句柄
	 *
	 * @var array
	 */
	private static $TTCResMap = array();
	private static $TTC2ResMap = array();
	/**
	 * 保存项目中TMem的句柄
	 *
	 * @var array
	 */
	private static $TMemResMap = array();
	/**
	 * DB的配置
	 *
	 * @var array
	 */
	private static $DBCfg;
	/**
	 * DB的配置
	 *
	 * @var array
	 */
	private static $MSDBCfg;
	/**
	 * IP的配置
	 *
	 * @var array
	 */
	private static $IPCfg;
	/**
	 * 保存项目中TTC的配置
	 *
	 * @var array
	 */
	private static $TTCCfg;
	/**
	 * 保存项目中MemCache的配置
	 *
	 * @var array
	 */
	private static $CacheCfg = array();

	/**
	 * 保存来自外部系统的IP Port的配置
	 *
	 * @var array
	 */
	private static $ExtIPCfg = array();


	/**
	 * 保存项目中TMem的配置
	 *
	 * @var array
	 */
	private static $TMemCfg;
	
	/**
	 * 初始化配置变量
	 */
	private static function init()
	{
		global $_DB_CFG, $_MSDB_CFG, $_CACHE_CFG, $_IP_CFG, $_EXT_IP_CFG, $_TTC_CFG, $_TMEM_CFG;

		// TTC 配置
		if (empty(self::$TTCCfg)) {
			if(isset($_TTC_CFG)){
				self::$TTCCfg = &$_TTC_CFG;
			} else {
				self::$TTCCfg = '';
			}
		}

		// DB 配置
		if (empty(self::$DBCfg)) {
			if(isset($_DB_CFG)){
				self::$DBCfg = &$_DB_CFG;
			} else {
				self::$DBCfg = '';
			}
		}

		// MSDB 配置
		if (empty(self::$MSDBCfg)) {
			if(isset($_MSDB_CFG)){
				self::$MSDBCfg = &$_MSDB_CFG;
			} else {
				self::$MSDBCfg = '';
			}
		}

		if(empty(self::$CacheCfg)){
			if(isset($_CACHE_CFG)){
				self::$CacheCfg = &$_CACHE_CFG;
			} else {
				self::$CacheCfg = '';
			}
		}

		// 内部 ip 配置
		if (empty(self::$IPCfg)) {
			if(isset($_IP_CFG)){
				self::$IPCfg = &$_IP_CFG;
			} else {
				self::$IPCfg = '';
			}
		}

		// 其他 ip 配置
		if (empty(self::$ExtIPCfg)) {
			if(isset($_EXT_IP_CFG)){
				self::$ExtIPCfg = &$_EXT_IP_CFG;
			} else {
				self::$ExtIPCfg = '';
			}
		}
		
		// TMEM 配置
		if (empty(self::$TMemCfg)) {
			if(isset($_TMEM_CFG)){
				self::$TMemCfg = &$_TMEM_CFG;
			} else {
				self::$TMemCfg = '';
			}
		}
	}

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearERR()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * 获得不分 set 的 memcache 对象
	 *
	 * @param	key		资源的key
	 * @return	Memcache		memcache 对象, 出错 false
	 */
	public static function getCache($key)
	{
		self::init();
		self::clearERR();

		// 如果在前面已创建该 cache 资源，则直接返回
		if (isset(self::$CacheResMap[$key]))
		{
			return self::$CacheResMap[$key];
		}

		// 判断参数
		if (!isset(self::$CacheCfg[$key]))
		{
			self::$errCode = 20000;
			self::$errMsg = "no cache config info for key {$key}";
			return false;
		}

		// cache 配置
		$cfg = self::$CacheCfg[$key];

		// 自动判断是单节点还是多节点 memcache 连接(一级 key 中有 host)
		$MemCache = new Memcache;
		if (isset($cfg['IP'])) {
			// 单节点连接
			$MemCache->connect($cfg['IP'], $cfg['PORT']);
		} else {
			// 多节点连接
			foreach ($cfg['servers'] as $server){
				$MemCache->addServer($server['IP'], $server['PORT'], 0);
			}
			if ($MemCache === false){
				self::$errCode = 20001;
				self::$errMsg = "add memcache server failed";
				return false;
			}
		}
		// 保存到类属性中
		self::$CacheResMap[$key] = $MemCache;
		return 	self::$CacheResMap[$key];
	}

	/**
	 * 获得 DB 对象
	 *
	 * 由于数据库不同于一般的 server ip/port ，这里不支持 $node 参数指定节点，以免出现不必要的问题。
	 * @modified myforchen 将DB的本地按照机器和端口作为key来保存
	 * @param	string	$key		返回 DB 对象
	 * @param	int		$node
	 * @return	DB	DB 对象, 出错 false
	 */
	public static function getDB($key, $charset = NULL)
	{
		self::init();
		self::clearERR();

		// 判断参数
		if (!isset(self::$DBCfg[$key]) || empty(self::$DBCfg[$key]['IP'])){
			self::$errCode = 20000;
			self::$errMsg = "no DB config info for key {$key}";
			return false;
		}

		$cfg = self::$DBCfg[$key];
		$cfg['PORT'] = empty($cfg['PORT']) ? 3306 : $cfg['PORT'];

		$cacheKey = $cfg['IP'] . '_' . $cfg['PORT'] . '_' . $cfg['USER'] . (empty($charset) ? '' : ('_' . $charset));

		// 如果在前面已创建该 DB 资源，则直接返回
		if (isset(self::$DBResMap[$cacheKey])){
			self::$DBResMap[$cacheKey]->selectDB($cfg['DB']);
			return self::$DBResMap[$cacheKey];
		}

		// 创建 DB 对象
		$DB = new DB($cfg['IP'], $cfg['PORT'], $cfg['DB'], $cfg['USER'], $cfg['PASSWD']);
		if (empty($DB) || $DB->errCode > 0) {
			self::$errCode = 20001;
			self::$errMsg = "create DB connnect failed for {$key}: " . $DB->errCode . " " . $DB->errMsg;
			return false;
		}

		if (!empty($charset)){
			if($DB->setCharset($charset) === false){
				self::$errCode = 20002;
				self::$errMsg = "change DB client charset failed for {$key}";
				return false;
			}
		}
		// 保存到类属性中
		self::$DBResMap[$cacheKey] = $DB;
		return self::$DBResMap[$cacheKey];
	}

	/**
	 * 获得 MSSQL DB 对象
	 *
	 * 由于数据库不同于一般的 server ip/port ，这里不支持 $node 参数指定节点，以免出现不必要的问题。
	 *
	 * @param	string	$key		返回 DB 对象
	 * @param	int		$node
	 * @return	DB	DB 对象, 出错 false
	 */
	public static function getMSDB($key)
	{
		self::init();
		self::clearERR();

		// 判断参数
		if (!isset(self::$MSDBCfg[$key]) || empty(self::$MSDBCfg[$key]['IP'])){
			self::$errCode = 20000;
			self::$errMsg = "no DB config info for key {$key}";
			return false;
		}

		$cfg = self::$MSDBCfg[$key];
		$cfg['PORT'] = empty($cfg['PORT']) ? 1433 : $cfg['PORT'];

		$cacheKey = $cfg['IP'] . '_' . $cfg['PORT'];

		// 如果在前面已创建该 DB 资源，则直接返回
		if (isset(self::$MSDBResMap[$cacheKey])){
			self::$MSDBResMap[$cacheKey]->selectDB($cfg['DB']);
			return self::$MSDBResMap[$cacheKey];
		}
		// 创建 DB 对象
		$MSDB = new MSSQL($cfg['IP'], $cfg['PORT'], $cfg['DB'], $cfg['USER'], $cfg['PASSWD']);
		if (empty($MSDB) || $MSDB->errCode > 0) {
			self::$errCode = 20001;
			self::$errMsg = "create DB connnect failed for {$key}: " . $MSDB->errCode . " " . $MSDB->errMsg;
			return false;
		}
		$ret = $MSDB->init();
		if (false === $ret) {
			self::$errCode = 20001;
			self::$errMsg = 'connect to msserveer failed[]' . $MSDB->errMsg;
			return false;
		}

		// 保存到类属性中
		self::$MSDBResMap[$cacheKey] = $MSDB;
		return self::$MSDBResMap[$cacheKey];
	}

	/**
	 * 获得 ip 和端口等
	 *
	 * @param	string	$key	资源的key
	 * @param	int		$node 	节点数字编号; 如果为 false 表示忽略，返回全部节点
	 * @return 	array	需要的 ip 端口等信息
	 */
	public static function getIP($key, $node = false)
	{
		self::clearERR();
		self::init();
		// 判断参数 key 是否存在
		if (!isset(self::$IPCfg[$key])){
			self::$errCode = 20000;
			self::$errMsg = "no config info for key {$key}";
			return false;
		}

		// 判断是否单节点
		$cfg = self::$IPCfg[$key];
		// 多节点方式
		if ($node === false) {
			// 直接返回
			return $cfg;
		} else {
			// 获得指定(不掩盖错误，不存在则返回错误)
			if (!isset($cfg[$node])) {
				self::$errCode = 20001;
				self::$errMsg = "no node for {$node} in {$key}";
				return false;
			} else {
				return $cfg[$node];
			}
		}
	}

	/**
	 * 获得外部 ip 配置信息
	 *
	 * @param	string	$key	资源的key
	 * @param	int		$node 	节点数字编号; 如果为 false 表示忽略，返回全部节点
	 * @return 	array	需要的 ip 端口等信息
	 */
	public static function getExtIP($key, $node = false)
	{
		self::clearERR();
		self::init();
		// 判断参数 key 是否存在
		if (!isset(self::$ExtIPCfg[$key]))
		{
			self::$errCode = 20000;
			self::$errMsg = "no config info for key {$key}";
			return false;
		}

		// 判断是否单节点
		$cfg = self::$ExtIPCfg[$key];
		// 多节点方式
		if ($node === false) {
			// 直接返回
			return $cfg;
		} else {
			// 获得指定(不掩盖错误，不存在则返回错误)
			if (!isset($cfg[$node])) {
				self::$errCode = 20001;
				self::$errMsg = "no node for {$node} in {$key}";
				return false;
			} else {
				return $cfg[$node];
			}
		}
	}

	/**
	 * 获得 TTC 句柄
	 *
	 * @param	string	$key	资源的key
	 * @return 	TTC	返回TTC句柄
	 */
	public static function getTTC($key)
	{
		self::clearERR();
		self::init();
		// 如果在前面已创建该 ttc 资源，则直接返回
		if (isset(self::$TTCResMap[$key])){
			return self::$TTCResMap[$key];
		}
		// 判断参数
		if (!isset(self::$TTCCfg[$key])){
			self::$errCode = 20000;
			self::$errMsg = "no TTC config info for key {$key}";
			return false;
		}
		// cache 配置
		$cfg = self::$TTCCfg[$key];
		if (!isset($cfg['IP'])){
			$serv = configcenter4_get_serv($key, 0, 0);
			if ($serv == '0.0.0.0:0'){
				self::$errCode = 20001;
				self::$errMsg = "configcenter4_get_serv failed, {$key}";
				return false;
			}
			$cfg['IP'] = self::$TTCCfg[$key]['IP'] = $serv;
		}

		$ttc = new TTC($cfg);
		// 保存到类属性中
		self::$TTCResMap[$key] = $ttc;
		return 	self::$TTCResMap[$key];
	}

	/**
	 * 获得 TTC2 句柄(仅支持批量取的TTC)
	 *
	 * @param	string	$key	资源的key
	 * @return 	TTC2	返回TTC2句柄
	 */
	public static function getTTC2($key)
	{
		self::clearERR();
		self::init();
		// 如果在前面已创建该 ttc 资源，则直接返回
		if (isset(self::$TTC2ResMap[$key])){
			return self::$TTC2ResMap[$key];
		}

		// 判断参数
		if (!isset(self::$TTCCfg[$key])){
			self::$errCode = 20000;
			self::$errMsg = "no TTC config info for key {$key}";
			return false;
		}
		// cache 配置
		$cfg = self::$TTCCfg[$key];
		$ttc = new TTC2($cfg);
		// 保存到类属性中
		self::$TTC2ResMap[$key] = $ttc;
		return 	self::$TTC2ResMap[$key];
	}
	
	public static function getTMem($key)
	{
		self::clearERR();
		self::init();
		// 如果在前面已创建该 tmem 资源，则直接返回
		if (isset(self::$TMemResMap[$key])){
			return self::$TMemResMap[$key];
		}
	
		// 判断参数
		if (!isset(self::$TMemCfg[$key])){
			self::$errCode = ErrorConfig::getErrorCode('no_tmem_config');
			self::$errMsg = "no TMem config info for key {$key}";
			return false;
		}
		// cache 配置
		$cfg = self::$TMemCfg[$key];
		if(!isset($cfg['IP'])) {
			self::$errCode = ErrorConfig::getErrorCode('config_error');
			self::$errMsg = "no TMem server ip for key {$key}";
			return false;
		} else {
			if(!is_array($cfg['IP'])) {
				$cfg['IP'] = array( $cfg['IP'] );
			}
		}
	
		if(!isset($cfg['CONNECT_TIME'])) {
			$cfg['CONNECT_TIME'] = 2000;
		}
	
		if(!isset($cfg['SHOW_ERROR'])) {
			$cfg['SHOW_ERROR'] = 0;
		}
	
		if(!isset($cfg['TIMEOUT'])) {
			$cfg['TIMEOUT'] = 2000;
		}
	
		if(!isset($cfg['FREETIME'])) {
			$cfg['FREETIME'] = 5;
		}
	
		$tm = new tmem($cfg['CONNECT_TIME'], $cfg['SHOW_ERROR']);
		$tm->set_servers($cfg['IP'], $cfg['TIMEOUT'], $cfg['FREETIME']);
	
		// 保存到类属性中
		self::$TMemResMap[$key] = $tm;
		return 	self::$TMemResMap[$key];
	}

	/**
	 * 获得环境名称
	 *
	 * @return 	string	返回环境名称
	 */
	public static function getEnvName()
	{
		
		$envName = '';
		$phpConfig = get_cfg_var('env.name');
		if (!empty($phpConfig)) {
			$envName = $phpConfig . '.';
		}
		
		//return strlen(ENV_NAME) ? (ENV_NAME . '.') : '';
		return $envName;
	}
}

//End Of Script