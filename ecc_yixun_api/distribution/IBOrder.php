<?php


require_once('dao/IRetailerShopDao.php');

/*
	错误码定义
	401 : 分销商帐号空
	402 : 搜索条件参数错误
	
*/

class IBOrder
{
	private static $debug = true;

    public static $errCode = 0;

    /**
     * 错误信息
     */
    public static $errMsg = '';

	private static function logger($str)
	{
		if (self::$debug)
		 {
			Logger::info($str);
		}
	}
	
	/**
	 * 获取门店信息 
	 */
	public static function getShop($retailerId)
	{
		if (!isset($retailerId))
		{
			self::$errCode = 401;
			self::$errMsg = 'retailer ID is null';
			self::logger(basename ( __FILE__, '.php' ) . " |" . __LINE__ . "retailer ID null" );
			
			return false;
		}
		$res = IRetailerShopDao::getAll(array('retailerId' => $retailerId));
		if (false === $res)
		{
			self::$errCode = IRetailerShopDao::$errCode;
			self::$errCode = IRetailerShopDao::$errMsg;
			
			return false;
		}
		$ret = array();
		$index = 0;
		foreach ($res AS $shop)
		{
			$ret[$index] = array(
				'shopName' 	=> $shop['shopName'],
				'shopId'	=> $shop['shopId']
				);
			$index ++;
		}
		
		return $ret;
	}
	
	/**
	 *	搜索订单 
	 */
	public static function searchOrder($condition)
	{
		if (!is_array($condition))
		{
			self::$errCode = 402;
			self::$errMsg = 'search condition is not array';
			self::logger(basename ( __FILE__, '.php' ) . " |" . __LINE__ . "conition not array" );
			
			return false;
		}
		
	}

}
