<?php
require_once(PHPLIB_ROOT . 'inc/DIYConfig.inc.php');
/**
 * 前台用户获取天黑黑，周末清仓，抢购相关信息类
 * @author oscarzhu
 * @version 1.0
 * @created 03-五月-2011 15:26:06
 */
class IActCountDown
{
	public static $THH_BID = 0;
	public static $WEEKEND_BID = 1;
	public static $QIANGGUO_BID = 2;
	public static $THH_Start_Time = '18:00:00';
	public static $THH_End_Time = '23:59:59';
	//todo test
//	public static $THH_Start_Time = '18:00:00';
//	public static $THH_End_Time = '23:59:59';	
	
	public static $WeekEnd_Start_Time = '18:00:00';
	public static $WeekEnd_End_Time = '23:59:59';
	
	public static $weekTime = array('0','5','6');
	public static $table = 't_act_countdown';
	public static $debug = false;
	public static $saveTime = 1800;
	public static $saveMenuTime = 28800;
	
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
	 * 获取错误信息
	 */
	public static function getErrMsg()
	{
		return self::$errMsg;
	}
	
	//debug
	public static function log($str)
	{
		if(self::$debug)
			logger::info($str);
	}
	/*
	 * 获取天黑黑商品信息
	 * 
	 * @author oscarzhu
	 * @param $time 日期 年-月-日
	 * @return $products 商品信息
	 * 
	 */
	public static function getTHHProducts($pstart,$pageNum,$time='')
	{
		if(empty($time))
		{
			//获取当天 天黑黑开始时间
			$start = date('Y-m-d',time()).' '.self::$THH_Start_Time; 
			$end = date('Y-m-d',time()).' '.self::$THH_End_Time;
		} else {
			//获取当天 天黑黑开始时间
			$start = $time.' '.self::$THH_Start_Time;
			$end = $time.' '.self::$THH_End_Time;
		}
		
		//sql 
		$wid = IUser::getSiteId();
		$where = ' ( Status=0 or Status=1) and bid='.self::$THH_BID.' and wh_id='.$wid;
		$where .= ' and StartTime<\''.$end.'\' and EndTime>\''.$start.'\'';
		$limit = (empty($pstart) && empty($pageNum))?'':' limit '.$pstart.','.$pageNum;
		
		//读取数据
		$result = self::getCountDownInfo($where,$limit);
		$total = self::getCount($where);

		$products = array();
		if(empty($result)) return $products;
		$products =  self::_getResultProducts($result);

		return array('total'=>$total,'list'=>$products);
	}
	
	/*
	 * 根据商品聚类目录导航
	 */
	public static function getCategory()
	{
		$obj = new IActCountDown();
		$wid = IUser::getSiteId();
		$okey = 'page_IActCountDown__getCategory_'.$wid;
		return IDIYInfo::cached($obj,'_getCategory',array(),self::$saveMenuTime,'',false, array('key'=>$okey));
	}	
		
	/*
	 * 获取周末清仓商品信息
	 * 
	 * @author oscarzhu
	 * @return $products 商品信息
	 * 
	 */
	public static function getWeekendProducts($c3Id,$pstart,$pageNum,$flag=0)
	{
		$products = array();
		$wid = IUser::getSiteId();

		//sql 
		$weekend = self::getWeekendTime();
		$wid = IUser::getSiteId();
		$where = ' ( Status=0 or Status=1) and bid='.self::$WEEKEND_BID.' and wh_id='.$wid;
		$where .= empty($c3Id)?'':' and c2_id='.$c3Id;
		$where .= ' and StartTime<\''.$weekend['end'].'\' and EndTime>\''.$weekend['start'].'\' and is_online = 1';
		$limit = (empty($pstart) && empty($pageNum))?' limit 0,2000':' limit '.$pstart.','.$pageNum;
		
		//读取数据
		$result = self::getCountDownInfo($where,$limit);
		if($flag==1)
			return $result;
		$total = self::getCount($where);
		
		$products = array();
		if(empty($result)) return $products;
		$products =  self::_getResultProducts($result);

		return array('total'=>$total,'list'=>$products);	
	}
	
	//获取总数
	private static function getCount($where)
	{
		$db = Config::getDB(NEW_DIY_DB);
		$wid = IUser::getSiteId();
		$okey = 'page_IActCountDown_getRowsCount_'.md5(serialize($where)).'_'.$wid;
		$count = IDIYInfo::cached($db,'getRowsCount',array(self::$table,$where),self::$saveTime,'',false, array('key'=>$okey));
		self::log("get products count:".$count);
		return ($count>3000)?3000:$count;
	}
	
	//获取详细信息
	private static function getCountDownInfo($where,$limit)
	{
		$db = Config::getDB(NEW_DIY_DB);
		$sql = "select product_id,CountDownCurrentPrice,CountDownCashRebate,CountDownCashPoint,CountDownQty,
				SnapShotCurrentPrice,SnapShotCashRebate,SnapShotCashPoint
				 ,c3_id,c3_name,c1_id,c1_name,c2_id,c2_name,EndTime,Status,StartTime
				 from ".self::$table." where".$where." order by is_end desc,SortNum asc";
		if(!empty($limit))
			$sql .=	$limit;
		self::log("get products id:".$sql);
		$wid = IUser::getSiteId();
		$okey = 'page_IActCountDown_getRows_'.md5(serialize($where)).'_'.md5(serialize($limit)).'_'.$wid;
//		$now = strtotime(date('H:i:s',time()));
//		$start = strtotime(self::$THH_Start_Time);
//		if( ($start<$now) && ( $now<  ($start+600)) )
//			return IDIYInfo::cached($db,'getRows',array($sql),self::$saveTime,'',true, array('key'=>$okey));
//		else
			return IDIYInfo::cached($db,'getRows',array($sql),self::$saveTime,'',false, array('key'=>$okey));
	}

	/*
	 * 获取周末清仓时间点
	 * 
	 * @author oscarzhu
	 * @return array 开始结束时间
	 * 
	 */
	public static function getWeekendTime()
	{
		$wk = date('w');
		$now = strtotime(date('H:i:s',time()));
		$swk = 5;
		$ewk = 8;
		$tmp = date('Y-m-d',time());
		//不在活动时间内直接返回
		if( ($wk == 2) || ($wk == 3) || ($wk == 4) || ($wk == 1) || (($wk == 5)&&($now<strtotime(self::$WeekEnd_Start_Time))) )
		{
			$start = strtotime($tmp.self::$WeekEnd_Start_Time) + (3600*24)*($swk-$wk); 
			$end = strtotime($tmp.self::$WeekEnd_End_Time) + (3600*24)*($ewk-$wk); 
		} else if($wk == 0){ //周日
			$start = strtotime($tmp.self::$WeekEnd_Start_Time) - (3600*24)*2;
			$end = strtotime($tmp.self::$WeekEnd_End_Time); 	
		} else { //周6
			$start = strtotime($tmp.self::$WeekEnd_Start_Time) - (3600*24);
			$end = strtotime($tmp.self::$WeekEnd_End_Time) + (3600*24);	
		}
	
		return array('start'=>date('Y-m-d H:i:s',$start),'end'=>date('Y-m-d H:i:s',$end));
		//return array('start'=>strtotime('2011-07-20 18:00:00'),'end'=>strtotime('2011-07-23 00:00:00'));
	}
	
	/*
	 * 判断当天是否在天黑黑时间内
	 * 
	 * @author oscarzhu
	 * @return array 开始结束时间
	 * 
	 */
	public static function checkWeekEndTime()
	{
		$wk = date('w');
		if(!in_array($wk,self::$weekTime))
			return false;
		if( $wk==6 || $wk ==0 )
			return true;
		$now = strtotime(date('H:i:s',time()));
		$start = strtotime(self::$WeekEnd_Start_Time);
		$end = strtotime(self::$WeekEnd_End_Time);
		if( ($now < $start) || ($now > $end) )
			return false;
		return true;
	}	
		
	/*
	 * 判断当天是否在天黑黑时间内
	 * 
	 * @author oscarzhu
	 * @return array 开始结束时间
	 * 
	 */
	public static function checkTHHTime()
	{
		$now = strtotime(date('H:i:s',time()));
		$start = strtotime(self::$THH_Start_Time);
		$end = strtotime(self::$THH_End_Time);
		if( ($now < $start) || ($now > $end) )
			return false;
		return true;
	}	
	
	
	//获取商品信息
	private static function _getResultProducts($products)
	{
		$pIds = array();
		$lists = array();
		foreach( $products as $val )
		{
			$pIds[] = $val['product_id'];
			$lists[$val['product_id']] = $val;
		}

		$wid = IUser::getSiteId();

		//产品信息
		$products = IProduct::getProductsInfo($pIds,$wid);
		$giftInfos = IProduct::getProductsGift($pIds,$wid);
		$reviews = IReviews::getProductsReviewCount($pIds);
		$reviews = ToolUtil::gbJsonDecode($reviews);
		
		if(empty($products))
			return array();
		$result = array();
		
		foreach( $products as $key=>$product )
		{
			$pid = $product['product_id'];
			$product['CountDownCurrentPrice'] = $lists[$pid]['CountDownCurrentPrice'];
			$product['CountDownCashRebate'] = $lists[$pid]['CountDownCashRebate'];
			$product['CountDownCashPoint'] = $lists[$pid]['CountDownCashPoint'];
			$product['SnapShotCurrentPrice'] = $lists[$pid]['SnapShotCurrentPrice'];
			$product['SnapShotCashRebate'] = $lists[$pid]['SnapShotCashRebate'];
			$product['SnapShotCashPoint'] = $lists[$pid]['SnapShotCashPoint'];			
			$product['CountDownQty'] = $lists[$pid]['CountDownQty'];
			$product['EndTime'] = strtotime($lists[$pid]['EndTime']);
			$product['StartTime'] = strtotime($lists[$pid]['StartTime']);
			$product['countdown'] = $lists[$pid]['Status'];
			$product['gift_count'] = isset($giftInfos[$pid])?count($giftInfos[$pid]):0;
			if (isset($reviews[$pid])) {
				if(!empty($reviews[$pid]['experience_number']) && $reviews[$pid]['experience_number']!=0)
					$product['score'] = $reviews[$pid]['satisfaction']/$reviews[$pid]['experience_number'];
				else
					$product['score'] = 0;
				$product['review_count'] = $reviews[$pid]['total']?$reviews[$pid]['total']:0;
			} else {
				$product['score'] = 0;
				$product['review_count'] = 0;
			}
			$result[] = $product;
		}
		
		return $result;
	}
	
	

	/*
	 * 根据商品聚类目录导航
	 */
	public static function _getCategory()
	{
		$products = self::getWeekendProducts(0,0,0,1);//取出本周所有商品进行聚类
		if(empty($products))
			return array();
		//$category3 = self::_getCategory3Name($products);
		$category2 = self::_getCategory2Name($products);
		$category1 = self::_getCategory1Name($products);
		return array('c2'=>$category1,'c3'=>$category2);
	}	
	
	//三级小类名
	private static function _getCategory3Name($products)
	{
		//去除相同的3级小类名
		$result = array();
		foreach( $products as $val )
		{
			$tmp['id'] = $val['c3_id'];
			$tmp['name'] = $val['c3_name'];
			$flag = 0;
			if(!empty($result[$val['c2_id']]))
			{
				foreach( $result[$val['c2_id']] as $val2 )
				{
					if($val2['id']==$val['c3_id'])
					{
						$flag = 1;
						break;
					}
				}
			}
			if(!$flag)
				$result[$val['c2_id']][] = $tmp;	
		}
		return $result;
	}
	
	//二级小类名
	private static function _getCategory2Name($products)
	{
		//去除相同的3级小类名
		$result = array();
		foreach( $products as $val )
		{
			$tmp['id'] = $val['c2_id'];
			$tmp['name'] = $val['c2_name'];
			$flag = 0;
			if(!empty($result[$val['c1_id']]))
			{
				foreach( $result[$val['c1_id']] as $val2 )
				{
					if($val2['id']==$val['c2_id'])
					{
						$flag = 1;
						break;
					}
				}
			}
			if(!$flag)
				$result[$val['c1_id']][] = $tmp;
		}
		return $result;
	}

	//一级小类名
	private static function _getCategory1Name($products)
	{
		//去除相同的3级小类名
		$result = array();
		foreach( $products as $val )
		{
			$tmp['id'] = $val['c1_id'];
			$tmp['name'] = $val['c1_name'];
			if(in_array($tmp,$result))
				continue;
			$result[] = $tmp;	
		}
		return $result;
	}

}