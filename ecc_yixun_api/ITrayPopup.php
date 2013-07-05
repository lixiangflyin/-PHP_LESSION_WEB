<?php
/**
 * 网页托盘区弹出提示内容管理
 * 后续可以把这里切换到新管理平台上
 * @author myforchen
 *
 */

class ITrayPopup {
	/**
	 * 消息类型常量
	 */
	const UNREGISTERED = 1; // 未注册
	const NO_ORDER_USER = 2; // 没有下订单的
	const GOLD_MEDAL_LEVEL = 3; // 金牌会员
	const SUZHOU_USER = 4;//苏州地区用户

	const TEMP_KEY_PREFIX = 'tray_popup_';

	public static $db_key = array(
		1	=> 'FTipContent',
		2	=> 'NobuyTipContent',
		3	=> 'AdTipContent',
		4	=> 'SuzhouTipContent',
	);

	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}

	/**
	 * 获取消息内容
	 * @param int $type 消息类型
	 */
	public static function getContent($type, $wh_id = 1){
		self::clearERR();

		$key = self::TEMP_KEY_PREFIX . $wh_id . '_' . $type;
		$ret = IPageCacheTTC::get( $key );

		if ($ret === false) {
			self::setERR(IPageCacheTTC::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . "IPageCacheTTC get faild " . IPageCacheTTC::$errMsg);
			return false;
		}

		if(count($ret) <= 0){
			self::setERR(8701, 'content of ' . $type . ' not exists');
			return false;
		}
	
		// 暂时没有过期时间的判断
		return $ret[0]['content'];
	}

	/**
	 * 从ERP同步过来
	 * @param int $wh_id 城市站ID
	 */
	public static function setContent($type, $content, $wh_id = 1){
		self::clearERR();
	
		$key = self::TEMP_KEY_PREFIX . $wh_id . '_' . $type;
		$pageCache = IPageCacheTTC::get($key);
		if($pageCache === false){
			self::setERR(IPageCacheTTC::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . "IPageCacheTTC get faild " . IPageCacheTTC::$errMsg);
			return false;
		}

		$curTime = time();
		$param = array(
			'cid'			=> $key,
			'content'		=> $content,
			'expiretime'	=> $curTime + 300,
			'updatetime'	=> $curTime,
		);

		if(count($pageCache) <= 0){
			$ret = IPageCacheTTC::insert($param);
			if($ret === false){
				self::setERR(IPageCacheTTC::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . "IPageCacheTTC insert faild " . IPageCacheTTC::$errMsg);
				return false;
			}
		} else {
			$ret = IPageCacheTTC::update($param);
			if($ret === false){
				self::setERR(IPageCacheTTC::$errCode, basename(__FILE__, '.php') . " |" . __LINE__ . "IPageCacheTTC update faild " . IPageCacheTTC::$errMsg);
				return false;
			}
		}

		return true;
	}
}

// End Of Script