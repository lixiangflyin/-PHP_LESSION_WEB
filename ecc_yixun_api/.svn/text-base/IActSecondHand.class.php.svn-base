<?php
/**
 * 前台用户获取二手特卖相关信息类
 * @author oscarzhu
 * @version 1.0
 * @created 03-五月-2011 15:26:06
 */
class IActSecondHand
{	
	public static $c3BaseId = 100000000;
	public static $c2BaseId = 10000;
	public static $pageSize = 30;
	
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 设置缓存中保存时间
	 */
	private static $saveTime = 300;//5分钟
	
	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * 获取错误信息
	 */
	public static function getErrMsg()
	{
		return self::$errMsg;
	}
	
	//从拍拍拉取数据
	function getProuductFromPaiPai($input)
	{
		$input['key'] = '二手';
		return ISearch::gets($input);
	}
	
	public static function getProducts($id,$page,$level=2)
	{
		$wid = IUser::getSiteId();
		$input = array(
					'currentPage'	=>	$page,
					'pageSize'	=>	IActSecondHand::$pageSize,
					"sort" => 6,
					"desc" => 1,
					"day" => 0,
					"price" => 0,
					"option" => '',
					"classId"	=> $id,
					"categorylevel" 	=>	$id ? $level : '',
					"areacode"	=>	$wid
					);
		return self::getProuductFromPaiPai($input);			
	}
	
	/*
	 * 
	 * 根据商品聚类目录导航
	 */
	public static function getCategory()
	{
		$wid = IUser::getSiteId();
		$input = array(
					'currentPage'	=>	1,
					'pageSize'	=>	1,
					"sort" => 6,
					"desc" => 1,
					"day" => 0,
					"price" => 0,
					"option" => '',
					"classId"	=>	0,
					"areacode"	=>	$wid
					);
		$data = self::getProuductFromPaiPai($input);
		$category1 = self::_getCategory1Name($data['classes']);
		$category2 = self::_getCategory2Name($data['classes']);
		$category3 = self::_getCategory3Name($data['classes']);
		
		return array('c2'=>$category1,'c3'=>$category2,'c4'=>$category3);
	}
	
	//三级小类名
	private static function _getCategory3Name($data)
	{
		$result = array();
		$tmp = array();
		foreach( $data as $val )
		{
			if($val['id']>IActSecondHand::$c3BaseId)
				$tmp[] = $val['id']-IActSecondHand::$c3BaseId;
		}
		$ret = self::getCategorysName($tmp,3);
		$tmp = array();
		foreach( $ret as $val )
		{
			$tmp['id'] = $val['id'];
			$tmp['name'] = $val['name'];
			$result[$val['parent_id']][] = $tmp;
		} 
		//var_dump($result);
		return $result;
	}
	
	//二级小类名
	private static function _getCategory2Name($data)
	{
		$result = array();
		$tmp = array();
		foreach( $data as $val )
		{
			if( ($val['id']>IActSecondHand::$c2BaseId) && ($val['id']<IActSecondHand::$c3BaseId) )
				$tmp[] = $val['id'] - IActSecondHand::$c2BaseId;
		}
		//var_dump($tmp);
		$ret = self::getCategorysName($tmp,2);
		$tmp = array();
		foreach( $ret as $val )
		{
			$tmp['id'] = $val['id'];
			$tmp['name'] = $val['name'];
			$result[$val['parent_id']][] = $tmp;
		} 
		//var_dump($result);
		return $result;
	}

	//一级小类名
	private static function _getCategory1Name($data)
	{
		$result = array();
		$tmp = array();
		foreach( $data as $val )
		{
			if($val['id']<IActSecondHand::$c2BaseId)
				$tmp[] = $val['id'];
		}
		$ret = self::getCategorysName($tmp,1);
		$tmp = array();
		foreach( $ret as $val )
		{
			$tmp['id'] = $val['id'];
			$tmp['name'] = $val['name'];
			$result[] = $tmp;
		} 
		//var_dump($result);
		return $result;
	}
		
	//类名
	private static function getCategorysName($ids,$type)
	{
		$ret = ICategoryTTC::gets(($ids),array('level'=>$type));
		return $ret;
	}	
}