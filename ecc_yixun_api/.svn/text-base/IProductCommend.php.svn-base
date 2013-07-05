<?php
/**
 * 封装商品推荐的接口
 * @author 付学宝
 * @version 1.0
 * @updated 25-三月-2011 10:04:08
 */
class IProductCommend
{
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
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * 获得指定的价格推荐区间的数据
	 * 
	 * @param whid    仓库编号
	 * @param cate    类目编号
	 * @param level   级别1-3
	 * @param breed   品牌编号
	 * @param price   商品价格
	 */
	static function getPriceCommend($whid, $cate, $level, $breed, $price)
	{
		self::clearErr();
		$priceList = array(
			array(   0,	50,  25,  75),
			array(  50,	200, 100, 300),
			array( 200, 500, 250, 750),
			array( 500, 800, 480, 1120),
			array( 800,1000, 600, 1400),
			array(1000,1500,1050, 1950),
			array(1500,2000,1400, 2600),
			array(2000,2500,1750, 3250),
			array(2500,3000,2250, 3750),
			array(3000,4000,3000, 5000),
			array(4000,5000,3750, 6250),
			array(5000,7000,5600, 8400),
			array(7000,10000,8000, 12000),
			array(10000,20000,16000, 24000),
			array(20000,50000,42500, 57500),
			array(50000,100000,85000, 115000)
		);
		$price1 = 115000;
		$price2 = 1000000;
		
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$price = (empty($price)?0:intval($price));
		
		foreach ($priceList as $v){
			if ($v[0]*100 <= $price && $price <= $v[1] * 100) {
				$price1 = $v[2] * 100;
				$price2 = $v[3] * 100;
				break;
			}
		}
		$key   = self::_getPriceCommendKey($whid, $cate, $level, $breed, $price1, $price2);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}
		$where = 'ptype=0 and state=1 ';
		if ($whid > 0) {
			$where .= " AND wh_id={$whid}";
		}
		if ($breed > 0) {
			$where .= " AND breed={$breed}";
		}
		if ($cate > 0) {
			$paramcate = 'cate1';
			if ($level==1) {
				$paramcate = 'cate1';
			}else if($level==2){
				$paramcate = 'cate2';
			}else{
				$paramcate = 'cate3';
			}
			$where .= " AND {$paramcate}={$cate}";
		}
		$where .= " AND price>={$price1} AND price<={$price2}";
		
		$where .= " ORDER BY m1 DESC";
		$idList = IProductHeapListDao::getRows(array('distinct prod_id'), $where, 0, 10);
		if ($idList === false) {
			self::$errCode = IProductHeapListDao::$errCode;
			self::$errMsg  = IProductHeapListDao::$errMsg;
			return false;
		}
		$items = array();
		foreach ($idList as $v){
			$items[] = $v['prod_id'];
		}
		$vitems = IProduct::getProductsInfo($items, $whid);
		if ($vitems === false) {
			return false;
		}
		$v = self::setCacheData($key, serialize($vitems));
		if ($v==false) return false;
		return $vitems;
	}
	
	/**
	 * 获得指定类目的日销量TOP N
	 * 
	 * @param whid    仓库编号
	 * @param cate    类目编号
	 * @param level   级别1-3
	 * @param breed   品牌编号
	 * @param dnum    最近几天的销量,可选值:1-7
	 * @param num     产品数量
	 */
	static function getDaySaleTop($whid, $cate, $level, $breed, $dnum, $num)
	{
		self::clearErr();
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$num   = (empty($num)?1:intval($num));
		$num   = (($num>0)?$num:10);
		$dnum  = intval($dnum);
		$dnum  = (($dnum>7||$dnum<1)?$dnum:1);

		$key   = self::_getSaleTOPKey($whid, $cate, $level, $breed, 0, $dnum, $num);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}
		$where = 'ptype=0 and state=1';
		if ($whid > 0) {
			$where .= " AND wh_id={$whid}";
		}
		if ($breed > 0) {
			$where .= " AND breed={$breed}";
		}
		if ($cate > 0) {
			$paramcate = 'cate1';
			if ($level==1) {
				$paramcate = 'cate1';
			}else if($level==2){
				$paramcate = 'cate2';
			}else{
				$paramcate = 'cate3';
			}
			$where .= " AND {$paramcate}={$cate}";
		}

		$dfield = 'd'.$dnum;
		$where .= " ORDER BY {$dfield} DESC";
		$idList = IProductHeapListDao::getRows(array('distinct prod_id'), $where, 0, $num);
		if ($idList === false) {
			self::$errCode = IProductHeapListDao::$errCode;
			self::$errMsg  = IProductHeapListDao::$errMsg;
			return false;
		}
		$items = array();
		foreach ($idList as $v){
			$items[] = $v['prod_id'];
		}
		$vitems = IProduct::getProductsInfo($items, $whid);
		if ($vitems === false) {
			return false;
		}
		$v = self::setCacheData($key, serialize($vitems));
		if ($v==false) return false;
		return $vitems;
	}

	/**
	 * 获得指定类目的周销量TOP N
	 *  
	 * @param whid    仓库编号
	 * @param cate    类目编号
	 * @param level   级别1-3
	 * @param breed   品牌编号
	 * @param wnum    最近几周的销量,可选值:1-7
	 * @param num     产品数量
	 */
	static function getWeekSaleTop($whid, $cate, $level, $breed, $wnum, $num)
	{

		self::clearErr();
		$whid  = (empty($whid)?0:intval($whid));
//		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$num   = (empty($num)?1:intval($num));
		$num   = (($num>0)?$num:10);
		$wnum=intval($wnum);
		$wnum=(($wnum>7||$wnum<1)?$wnum:1);
		
		if(is_array($cate)){
			$_ids = array();
			foreach($cate as $cate_id){
				$_ids[] = empty($cate_id)? 0 : intval($cate_id);
			}
			$cate = implode(',', $_ids);
		}
		else{
			$cate  = (empty($cate)? 0 : intval($cate));
		}
		
		$key = self::_getSaleTOPKey($whid, $cate, $level, $breed, 1, $wnum, $num);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}
		$where = 'ptype=0 and state=1';
		if ($whid > 0) {
			$where .= " AND wh_id={$whid}";
		}
		if ($breed > 0) {
			$where .= " AND breed={$breed}";
		}
		if (!empty($cate)) {
			$paramcate = 'cate1';
			if ($level==1) {
				$paramcate = 'cate1';
			}else if($level==2){
				$paramcate = 'cate2';
			}else{
				$paramcate = 'cate3';
			}
			if(false === strpos($cate, ",")){
				$where .= " AND {$paramcate}={$cate}";
			}
			else{
				$where .= " AND {$paramcate} in({$cate})";
			}
		}
		
		$wfield = 'w'.$wnum;
		$where .= " ORDER BY {$wfield} DESC";
		$vals   = IProductHeapListDao::getRows(array('distinct prod_id'), $where, 0, $num);
		if ($vals === false) {
			self::$errCode = IProductHeapListDao::$errCode;
			self::$errMsg  = IProductHeapListDao::$errMsg;
			return false;
		}
		$items = array();
		foreach ($vals as $val){
			$items[]=$val['prod_id'];
		}
		$vitems = IProduct::getProductsInfo($items, $whid);
		if ($vitems === false) {
			return false;
		}

		$v = self::setCacheData($key, serialize($vitems));
		if ($v==false) return false;
		return $vitems;

	}

	/**
	 * 获得指定类目的周销量TOP N
	 * 
	 * @param whid    仓库编号
	 * @param cate    类目编号
	 * @param level   级别1-3
	 * @param breed   品牌编号
	 * @param mnum    最近几月的销量,可选值:1-6
	 * @param num     产品数量
	 */
	static function getMonthSaleTop($whid, $cate, $level, $breed, $mnum, $num)
	{
		self::clearErr();
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$num   = (empty($num)?1:intval($num));
		$num   = (($num>0)?$num:10);
		$mnum  = intval($mnum);
		$mnum  = (($mnum>6||$mnum<1)?$mnum:1);
		
		$key = self::_getSaleTOPKey($whid, $cate, $level, $breed, 2, $mnum, $num);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}
		$where = 'ptype=0 and state=1';
		if ($whid > 0) {
			$where .= " AND wh_id={$whid}";
		}
		if ($breed > 0) {
			$where .= " AND breed={$breed}";
		}
		if ($cate > 0) {
			$paramcate = 'cate1';
			if ($level==1) {
				$paramcate = 'cate1';
			}else if($level==2){
				$paramcate = 'cate2';
			}else{
				$paramcate = 'cate3';
			}
			$where .= " AND {$paramcate}={$cate}";
		}
		
		$mfield='m'.$mnum;
		$where .= " ORDER BY {$mfield} DESC";
		$vals = IProductHeapListDao::getRows(array('distinct prod_id'), $where, 0, $num);
		if ($vals === false) {
			self::$errCode = IProductHeapListDao::$errCode;
			self::$errMsg  = IProductHeapListDao::$errMsg;
			return false;
		}
		$p_product_ids = array();
		$product_ids = array();
		foreach ($vals as $val){
			$items[]=$val['prod_id'];
		}
		$vitems = IProduct::getProductsInfo($items, $whid);
		if ($vitems === false) {
			return false;
		}
		$v = self::setCacheData($key, serialize($vitems));
		if ($v==false) return false;
		return $vitems;
	}

	/**
	 * 获得指定类目的今日上架列表
	 * 
	 * @param whid    仓库编号
	 * @param cate    类目编号
	 * @param level   级别1-3
	 * @param breed   品牌编号
	 * @param num     商品数量
	 */
	static function getTodayOnself($whid, $cate, $level, $breed, $num)
	{
		self::clearErr();
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$num   = (empty($num)?1:intval($num));
		$num   = (($num>0)?$num:10);
		
		$key   = self::_getTodayOnselfKey($whid, $cate, $level, $breed, $num);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}
		$where = 'ptype=0 and state=1';
		if ($whid > 0) {
			$where .= " AND wh_id={$whid}";
		}
		if ($breed > 0) {
			$where .= " AND breed={$breed}";
		}
		if ($cate > 0) {
			$paramcate = 'cate1';
			if ($level==1) {
				$paramcate = 'cate1';
			}else if($level==2){
				$paramcate = 'cate2';
			}else{
				$paramcate = 'cate3';
			}
			$where .= " AND {$paramcate}={$cate}";
		}
		$where .= " ORDER BY ontime DESC";
		$vals = IProductHeapListDao::getRows(array('distinct prod_id'), $where, 0, $num);
		if ($vals === false) {
			self::$errMsg = IProductHeapListDao::$errMsg;
			return false;
		}
		$items = array();
		foreach ($vals as $val){
			$items[]=$val['prod_id'];
		}
		$vitems = IProduct::getProductsInfo($items, $whid);
		if ($vitems === false) {
			return false;
		}
		$v = self::setCacheData($key, serialize($vitems));
		if ($v==false) return false;
		return $vitems;
	}

	/**
	 * 获得指定类目的二手特卖商品列表
	 * 
	 * @param whid      仓库编号
	 * @param cate      类目编号
	 * @param level     级别1-3
	 * @param breed     品牌编号
	 * @param page    	页号
	 * @param pagesize  页的大小
	 */
	static function get2ProductPage($whid, $cate, $level, $breed, $page, $pagesize)
	{
		self::clearErr();
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$page  = (empty($page)?1:intval($page));
		$page  = (($page>0)?$page:1);
		$pagesize  = (empty($pagesize)?1:intval($pagesize));
		$pagesize  = (($pagesize>0)?$pagesize:20);
		
		$key   = self::_get2ProductPageKey($whid, $cate, $level, $breed, $page, $pagesize);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}
		$where = 'ptype=1 and state=1';
		if ($whid > 0) {
			$where .= " AND wh_id={$whid}";
		}
		if ($breed > 0) {
			$where .= " AND breed={$breed}";
		}
		if ($cate > 0) {
			$paramcate = 'cate1';
			if ($level==1) {
				$paramcate = 'cate1';
			}else if($level==2){
				$paramcate = 'cate2';
			}else{
				$paramcate = 'cate3';
			}
			$where .= " AND {$paramcate}={$cate}";
		}
		//要重点考虑
		$pageData = IProductHeapListDao::getPage(array('distinct prod_id'), $where, $page, $pagesize);
		if ($pageData === false) {
			self::$errCode = IProductHeapListDao::$errCode;
			self::$errMsg  = IProductHeapListDao::$errMsg;
			return false;
		}
		$vals = $pageData['data'];
		$items = array();
		foreach ($vals as $val){
			$items[]=$val['prod_id'];
		}
		$vitems = IProduct::getProductsInfo($items, $whid);
		if ($vitems === false) {
			return false;
		}
		$pageData['data'] = $vitems;
		$v = self::setCacheData($key, serialize($pageData));
		if ($v==false) return false;
		return $pageData;
	}

	/**
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @param whid     仓库编号
	 * @param cate     类目编号
	 * @param level    级别1-3
	 * @param breed    品牌编号
	 */
	static function _getPriceCommendKey($whid, $cate, $level, $breed, $price1, $price2)
	{
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$price1 = (empty($price1)?0:intval($price1));
		$price2 = (empty($price2)?0:intval($price2));
		return "W{$whid}C{$cate}L{$level}B{$breed}PS{$price1}PE{$price2}";
	}
	
	
	/**
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @param whid     仓库编号
	 * @param cate     类目编号
	 * @param level    级别1-3
	 * @param breed    品牌编号
	 * @param page     页号
	 * @param pagesize 页的大小
	 */
	static function _get2ProductPageKey($whid, $cate, $level, $breed, $page, $pagesize)
	{
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$page  = (empty($page)?1:intval($page));
		$page  = (($page>0)?$page:1);
		$pagesize  = (empty($pagesize)?1:intval($pagesize));
		$pagesize  = (($pagesize>0)?$pagesize:20);
		return "W{$whid}C{$cate}L{$level}B{$breed}T1P{$page}S{$pagesize}";
	}

	/**
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @param whid    仓库编号
	 * @param cate    类目编号
	 * @param level   级别1-3
	 * @param breed   品牌编号
	 * @param num     商品数量
	 */
	static function _getTodayOnselfKey($whid, $cate, $level, $breed, $num)
	{
		$whid  = (empty($whid)?0:intval($whid));
		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$num   = (empty($num)?1:intval($num));
		$num   = (($num>0)?$num:10);
		return "W{$whid}C{$cate}L{$level}B{$breed}T0N{$num}";
	}

	/**
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @param whid     仓库编号
	 * @param cate     类目编号
	 * @param level    级别1-3
	 * @param breed    品牌编号
	 * @param type     类型:0:日促销 1:周销量 2:月销量
	 * @param dnum     最近几天的销量,可选值:1-7
	 */
	static function _getSaleTOPKey($whid, $cate, $level, $breed, $type, $anum, $num)
	{
		$whid  = (empty($whid)?0:intval($whid));
//		$cate  = (empty($cate)?0:intval($cate));
		$level = (empty($level)?0:intval($level));
		$breed = (empty($breed)?0:intval($breed));
		$type  = (empty($type)?1:intval($type));
		$type  = (($type>=0 && $type<=2)?$type:0);
		$num   = (empty($num)?1:intval($num));
		$num   = (($num>0)?$num:10);

		$anum=intval($anum);
		$anum=(($anum>7||$anum<1)?$anum:1);
		return "W{$whid}C{$cate}L{$level}B{$breed}T0T{$type}A{$anum}N{$num}";
	}

	/**
	 * 根据提供的KEY获得cache的数据
	 * 
	 * @param key    cache的Key
	 */
	static function getCacheData($key)
	{
		$v = IPageCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IPageCacheTTC::$errCode;
			self::$errMsg  = IPageCacheTTC::$errMsg;
			return false;
		}
		if (count($v)!=1) {
			self::$errCode = 11111;
			self::$errMsg  = "count not 1";
			return false;
		}
		$t = time();
		if ($v[0]['expiretime'] < $t) {
			IPageCacheTTC::remove($key);
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
	static function setCacheData($key, $value, $expire=10)
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
	
}


//Logger::init();
//$whid=1;
//$cate=1007;
//$level=1;
//$breed=0;
//$n=1;
//$num=10;
////
////$items = IProductCommend::getDaySaleTop($whid, $cate, $level, $breed, $n, $num);
////var_dump($items);
////
////
////$items = IProductCommend::get2ProductPage($whid, $cate, $level, $breed, 1, $num);
////var_dump($items);
//
//$items = IProductCommend::getPriceCommend($whid, $cate, $level, $breed, 100);
//var_dump($items);

//End Of Script
