<?php
require_once(PHPLIB_ROOT . 'inc/DIYConfig.inc.php');
/**
 * 前台用户获取<font color="#010101">DIY</font>相关信息类
 * @author oscarzhu
 * @version 1.0
 * @created 03-五月-2011 15:26:06
 */
class IDIYInfo
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
	 * 设置缓存中保存时间
	 */
	private static $saveTime = 600;//15分钟
	
	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * 分站对应的主仓
	 */
	public static $mainStocks = array(
		SITE_SH => STOCK_SH_1,
		SITE_SZ => STOCK_SZ_1001,
		SITE_BJ => STOCK_BJ_2001,
		SITE_WH => STOCK_WH_3001,
		SITE_CQ => STOCK_CQ_4001,
		SITE_XA => STOCK_XA_5001
	);
	
	/**
	 * 通常装机必备类别（即不支持跨仓）
	 */
	public static $mainCategories = array(
		'148'		=> 'CPU',
		'152'		=> '主板',
		'146'		=> '内存',
		'138'		=> '硬盘',
		'166'		=> '显卡',
		'111'		=> '显示器',
		'100'		=> '光驱',
		'149'		=> '机箱',
		'132'		=> '电源',
		'159'		=> '散热器',
		'325'		=> '固态硬盘',
		'92'		=> '网卡',
		'212'		=> '声卡',
		'297'		=> '系统软件',
	);
	
	/**
	 * 处理跨仓的问题
	 * 
	 * @author yakehuang
	 */
	static public function handleStrideStock(&$datas, $wid)
	{
		$return = $defaults = array();
	
		global $_StockTips;
	
		if ($wid == SITE_SH || $wid == SITE_BJ || $wid == SITE_SZ)
		{
			foreach ($datas as $key => $data)
			{
				if ($data['stock'] !== $_StockTips['not_available'] && $data['status'] == 1)
				{
					if (array_key_exists($data['c3_ids'], IDIYInfo::$mainCategories))
					{
						$stockId = IDIYInfo::$mainStocks[$wid];
						$productInventoryInfo = IProductInventory::getProductStockInventeory($data['product_id'], $stockId);
						if (($productInventoryInfo['num_available'] + $productInventoryInfo['virtual_num']) > 0)
						{
							if ($data['enable'])
							{
								$defaults[$data['item_id']] = $data['product_char_id'];
							} else {
								if (!isset($defaults[$data['item_id']]))
									$defaults[$data['item_id']] = $data['product_char_id'];
							}
						} else {
							unset($datas[$key]);
						}
					} else {
						if ($data['enable'])
						{
							$defaults[$data['item_id']] = $data['product_char_id'];
						} else {
							if (!isset($defaults[$data['item_id']]))
								$defaults[$data['item_id']] = $data['product_char_id'];
						}
					}
				}
			}
		} else {
			foreach ($datas as $key => $data)
			{
				if ($data['stock'] !== $_StockTips['not_available'] && $data['status'] == 1)
				{
					if ($data['enable'])
					{
						$defaults[$data['item_id']] = $data['product_char_id'];
					} else {
						if (!isset($defaults[$data['item_id']]))
							$defaults[$data['item_id']] = $data['product_char_id'];
					}
				}
			}
		}
		
		// 过滤掉没有设置默认但是设置了备选的
		foreach ($datas as $data)
		{
			if (array_key_exists($data['item_id'], $defaults) && $data['enable'])
				$return[$data['item_id']] = $defaults[$data['item_id']];
		}
	
		return $return;
	}

	/*
	 * 判断商品组是否匹配
	 * 
	 * @param array $pids	商品ids
	 * @return array $result
	 * 
	 */
	static public function checkProductsMatch($pids)
	{
		$info = self::_getProductsDIYInfo($pids);
		$result = array();
		if(empty($info)) return $result;
		foreach($info as $val)
		{
			foreach ($info as $val2)
			{
				if($val2['product_id']==$val['product_id'])
					continue;
				$matchFilter = self::getProductMatchFilter(array($val['item_id']=>$val['product_id']),$val2['item_id'],$val);
				$ret = self::_getMatchProductFormResult($info=array($val2),$matchFilter);
				if( empty($ret) )
				{
					//不匹配信息存入到结果集
					$result[]  = array(
								'pid1'	=>	$val['product_id'],
								'pName1'	=>	$val['product_name'],
								'pid2'	=>	$val2['product_id'],
								'pName2'	=>	$val2['product_name'],					
								); 
				}
			}
		}
		return	$result;
	}
	
	/*
	 * 判断两个商品是否匹配
	 * 
	 * @param $pid	商品id
	 * @param $pid2	商品id
	 * @return bool
	 * 
	 */
	static public function checkProductMatch($pid, $pid2)
	{
		$info = self::_getProductDIYInfo($pid);
		$result[0] = self::_getProductDIYInfo($pid2);
		$matchFilter = self::getProductMatchFilter(array($info['item_id']=>$pid),$result[0]['item_id']);
		$result = self::_getMatchProductFormResult($result,$matchFilter);
		if( empty($result) )
		{
			return false;
		}
		return	true;
	}
		
	/*
	 * 根据电源功率值
	 * 
	 * @param $tid	配件id
	 * @param $pid	商品id
	 * @return array
	 * 
	 */
	static public function getPowerPower($pid)
	{
		$info = self::getProductAttrValueFromType($pid,9,520);//9是电源配件。520电源属性类别id
		if( $info === false )
		{
			self::$errCode = IDiyPowerTTC::$errCode;
			self::$errMsg  = IDiyPowerTTC::$errMsg;
			return false;
		}
	
		if(!empty($info))
			return $info[0];
		
		return	0;
	}
		
	/*
	 * 根据属性获取功率值
	 * 
	 * @param $tid	配件id
	 * @param $pid	商品id
	 * @return array
	 * 
	 */
	static public function getPower($tid,$pid)
	{
		$power = 0;
		
		//匹配配件级
		$info = IDiyPowerTTC::get($tid,array('attr_type_id'=>0,'attr_id'=>0,'status'=>0));
		if( $info === false )
		{
			self::$errCode = IDiyPowerTTC::$errCode;
			self::$errMsg  = IDiyPowerTTC::$errMsg;
			return false;
		}	
	
		if(!empty($info))
			return $info[0]['power'];
		
		//匹配属性值级
		$attrs = self::getProductAttrIds($tid,$pid);
		$info = IDiyPowerTTC::get($tid,array('status'=>0));
		if( $info === false )
		{
			self::$errCode = IDiyPowerTTC::$errCode;
			self::$errMsg  = IDiyPowerTTC::$errMsg;
			return false;
		}
		if( empty($info) || empty($attrs) ) return 0;
		foreach ( $info as $val )
		{
			if(in_array($val['attr_id'], $attrs))
				$power += $val['power'];
		}
		if( $power > 0 )
			return $power;
				
		//匹配属性类级
		$info = IDiyPowerTTC::get($tid,array('attr_type_id'=>0,'status'=>0));
		if( $info === false )
		{
			self::$errCode = IDiyPowerTTC::$errCode;
			self::$errMsg  = IDiyPowerTTC::$errMsg;
			return false;
		}		
		if (empty($info))  return $power;
		$attrTypeIds = self::getProductAttrTypeIds($tid,$pid);
		foreach ( $info as $val )
		{
			if(in_array($val['attr_type_id'], $attrs))
				$power += $val['power'];
		}
		
		return	$power;
	}
	
	/**
	 * 获取配件的快速选择
	 * 
	 * @param item_id    配件编号
	 * @return array(
	 * 			'brand'=>array(), //品牌列表
	 * 			'attrType'=>array(),//快速选择属性类别
	 * 			'attr'=>array(
	 * 					'属性类别id'=>属性值,...
	 * 			),//快速选择属性值
	 * )
	 * 
	 */
	public static function getItemAttr($item_id)
	{
		//查找关联表，返回此配件所有属性值，属性类别
		$info =  IDiyFilterTTC::get($item_id,array('status'=>0));
		if( $info === false )
		{
			self::$errCode = IDiyFilterTTC::$errCode;
			self::$errMsg  = IDiyFilterTTC::$errMsg;
			return false;
		}
		$brandArr = array();
		$attrType = array();
		$attrArr = array();

		foreach($info as $val)
		{
			$tmp = array();
			//如果是品牌类别，则取出，并重新开始
			if(!strcmp($val['attr_type_name'],'品牌'))
			{
				$tmp['name'] = $val['attr_name'];
				$tmp['id'] = $val['attr_id'];	
				$brandArr[]=$tmp;
				continue;
			}
			//取出属性类别
			if(!in_array(array('name'=>$val['attr_type_name'],'id'=>$val['attr_type_id']),$attrType))
			{
				$tmp['name'] = $val['attr_type_name'];
				$tmp['id'] = $val['attr_type_id'];
				$attrType[] = $tmp;
			}
			//某属性类别下的属性值
			$tmp = array('name'=>$val['attr_name'],'id'=>$val['attr_id']);
			$attrArr[$val['attr_type_id']][] = $tmp;
		}
		return array('brand'=>$brandArr,"attrType"=>$attrType,'attr'=>$attrArr);
	}

	/**
	 * 获取某一配件信息
	 * 
	 * @param item_id    配件id
	 * @return array
	 * 
	 */
	public static function getItemInfo($item_id)
	{
		$info = IDiyInfoTTC::get(DIY_ITEM,array('oid'=>$item_id));
		if( $info === false )
		{
			self::$errCode = IDiyInfoTTC::$errCode;
			self::$errMsg  = IDiyInfoTTC::$errMsg;
			return false;
		}
		if(empty($info))
			return array();
		return	$info[0];
	}

	/**
	 * 获取配件列表以及其信息
	 * 
	 */
	public static function getItemList()
	{
		$info = IDiyInfoTTC::get(DIY_ITEM,array('pid'=>1,'status'=>0));
		if( $info === false )
		{
			self::$errCode = IDiyInfoTTC::$errCode;
			self::$errMsg  = IDiyInfoTTC::$errMsg;
			return false;
		}
		//排序
		$tmpArr = array();
		foreach ($info as $t){
			$tmpArr[] = $t['sort'];
		}
		array_multisort($tmpArr, SORT_ASC ,SORT_NUMERIC,$info);		
		return	$info;
	}

	/**
	 * 获取某配件下产品列表
	 * 
	 * @param array $attrFilter 属性    过滤条件
	 * @param array $matchFilter 匹配属性    过滤条件	
	 * @param string $titleFilter 标题字段    过滤条件
	 * @param sort    排序方法
	 * @param preNum    每页数量
	 * @param page    某页
	 * @param item_id    配件id
	 * @return array 产品信息列表
	 * 
	 */
	public static function getItemProduct($attrFilter=array(), $matchFilter=array(), $titleFilter='', $sort = 1, $preNum = 6, $page = 1, $id, $wid)
	{
		$sort = empty($sort)?1:intval($sort);
		$preNum = empty($preNum)?6:intval($preNum);
		$page = empty($page)?1:intval($page);
		$id = empty($id)?1:intval($id);
		$wid = empty($wid)?IUser::getSiteId():intval($wid);
		
		//检查是否在缓中存在数据
		$key = self::_getItemProductKey($attrFilter, $matchFilter, $titleFilter, $sort, $preNum, $page, $id, $wid);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//从数据读取数据，并保存在缓存表中
		$result = self::_getItemProduct($attrFilter, $matchFilter, $titleFilter, $sort, $preNum, $page, $id, $wid);
		if($result===false) return false;
		if(empty($result['list'])) return array();
		$pinfo = self::_getProductsInfo($result['list'],$wid);
		if($pinfo===false) return false;
		if(empty($pinfo)) return array();
		 
		//设定缓存
		$data = array('total'=>$result['total'],'list'=>$pinfo);
		self::setCacheData($key, serialize($data),self::$saveTime);
		return $data;
	}

	/**
	 * 根据以选商品，返回待选配件的匹配规则
	 * 
	 * @param array $tIds  已选配件以及配件商品id array('配件id'=>商品id)
	 * @param int   $tid 待选配件id
	 * @param array   $productInfo 如果有刚为已选定某一商品，包括商品信息，无需再从数据库读取内容
	 * @return array('relation'=>array('属性类别id=>属性值'))
	 * relation 有5种情况：=,<,>,in(包含于),ined(被包含)
	 * 
	 */	
	public static function getProductMatchFilter($tIds,$tid,$productInfo=array())
	{
		$matchStr = self::getMatch();

		$matchFilter = array();
		$i=0;
		foreach ( $matchStr as $val )
		{
			if( $val['l_item_id']==$tid )
			{
				$matchItemKey = $val['r_item_id'];
				$matchAttr = $val['r_attr_id'];
				$targetAttr = $val['l_attr_id'];
				if( $val['relation'] == 1 )
				{
					$relation = '<' ;
				} else 	if ( $val['relation'] == 2 )
				{
					$relation = 'in' ;
				} else {
					$relation = '=' ;
				}
				
			} else if( $val['r_item_id']==$tid ){
				$matchItemKey = $val['l_item_id'];
				$matchAttr = $val['l_attr_id'];
				$targetAttr = $val['r_attr_id'];
				if( $val['relation'] == 1 )
				{
					$relation = '>' ;
				} else 	if ( $val['relation'] == 2 )
				{
					$relation = 'ined' ;
				} else {
					$relation = '=' ;
				}
			} else {
				continue;
			}
			
			if(array_key_exists($matchItemKey,$tIds))
			{
				//取出某配件下某商品某属性类别的所有属性值
				if(empty($productInfo))
					$productAttrs = IDIYInfo::getProductAttrValueFromType($tIds[$matchItemKey],$matchItemKey,$matchAttr);
				else
					$productAttrs = self::_getAttrValueFromAttrType($productInfo['attrType_value'], $matchAttr);	
				if($productAttrs) {
					$matchFilter[$i]['relation'] = $relation;//关系
					$matchFilter[$i]['match'] = $productAttrs;//配匹属性值
					$matchFilter[$i]['target'] = $targetAttr;//目标属性类别id
					$i++;
				}
			}
		}
		
		return $matchFilter;
	}
	
	/*
	 * 获取特殊匹配方案列表
	 * 
	 * @return array
	 * 
	 */
	public static function getMatch()
	{
		//检查是否在缓中存在数据
		$key = self::_getMatchKey();
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//从数据读取数据，并保存在缓存表中
		$result = self::_getMatch();
		if($result===false) return false;
		 
		//设定缓存
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}
	
	/*
	 * 获取取出某配件下某商品所有属性id
	 * 
	 * @param int $pid 商品id
	 * @param int $tid 配件id
	 * @return array 
	 * 			 
	 */
	public static function getProductAttrIds($tid,$pid)
	{
		//检查是否在缓中存在数据
		$key = self::_getProductAttrIdsKey($tid,$pid);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//从数据读取数据，并保存在缓存表中
		$result = self::_getProductAttrIds($tid,$pid);
		if($result===false) return false;
		 
		//设定缓存
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}
	
	/*
	 * 获取取出某配件下某商品某属性类别的所有属性值
	 * 
	 * @param int $pid 商品id
	 * @param int $tid 配件id
	 * @return array ('属性类别id=属性值',..)
	 * 			 
	 */
	public static function getProductAttrValueFromType($pid,$tid,$attrType)
	{
		//检查是否在缓中存在数据
		$key = self::_getProductAttrTypeKey($pid, $tid, $attrType);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//从数据读取数据，并保存在缓存表中
		$result = self::_getProductAttrValueFromType($pid,$tid,$attrType);
		if($result===false) return false;
		 
		//设定缓存
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}

	/*
	 * 获取取出某配件下某商品某属性类别ids
	 * 
	 * @param int $pid 商品id
	 * @param int $tid 配件id
	 * @return array ('属性类别id=属性值',..)
	 * 			 
	 */
	public static function getProductAttrTypeIds($pid,$tid)
	{
		//检查是否在缓中存在数据
		$key = "DIY_PRODUCT_ATTR_TYPE_ID_".$tid."_".$pid;
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//从数据读取数据，并保存在缓存表中
		$result = self::_getProductAttrTypeIds($pid,$tid);
		if($result===false) return false;
		 
		//设定缓存
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}
	
	/*
	 * 根据条件读取产品信息
	 * 
	 * @param array $attrFilter 属性    过滤条件
	 * @param array $matchFilter 匹配属性    过滤条件	
	 * @param string $titleFilter 标题字段    过滤条件
	 * @param sort    排序方法
	 * @param preNum    每页数量
	 * @param page    某页
	 * @param item_id    配件id
	 * @return array 产品信息列表
	 * 
	 */	
	private static function _getItemProduct($attrFilter, $matchFilter, $titleFilter, $sort, $preNum, $page, $tid, $wid)
	{
		$start = ($page-1)*$preNum; 
		
		//过滤条件
		$filterStr = self::_getProcudtSearchFilter($attrFilter, $matchFilter, $titleFilter);

		//组装 sql
		//处理排序方式
		$orderStr = self::_getOrderStr($sort);		
		$where = " num_available=1 and status=1 and status2=1 and item_id=".$tid." and wh_id=".$wid." ".$filterStr;
		$limit = " limit ".intval($start).",".$preNum;
		$table  = SORT_IN_MEM_TABLE_IPX;
		
		//读取数据
		$db = Config::getDB(NEW_DIY_DB);
		$sql = "select product_id,comment,satisfaction,attrType_value from ".$table." where".$where.$orderStr;
		if(empty($matchFilter))
		{
			$sql .=$limit;
			$tCount = $db->getRowsCount($table, $where);
		}
		$result =  $db->getRows($sql);
		//Logger::info("get diy products :".$sql);
		if( $result === false )
		{
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			//尝试从实体表读取
			$result = self::_getDataFromProductSortTab($db, $sql);
			if( $result === false )
				return false;
		}
		if(empty($result)) return array();

		//处理匹配 过滤掉不合匹配的数据
		if(!empty($matchFilter))
		{
			//配匹，取出所有记录数
			$ret = self::_getMatchProductFormResult($result, $matchFilter);
			//取出前台所需记录条数
			$result = array();
			for($i=intval($start);$i<(intval($start)+$preNum);$i++)
			{
				if(empty($ret[$i])) break;
				$result[] = $ret[$i];
			}
			$tCount = count($ret);
		}
		
		return array('total'=>$tCount,'list'=>$result);
	}
	
	/**
	 * 根据数据集和匹配方式，返回符合条件的数组
	 * @param $result
	 * @param $matchFilter
	 * 
	 * @return $array
	 * 
	 */
	
	private static function _getMatchProductFormResult($result, $matchFilter)
	{
		//Logger::info("get diy products totle count:".count($result)); 
		$ret = array();

		foreach ($result as $info) {
			$right = 1;
			foreach ($matchFilter as $val)
			{
				$op = $val['relation'];
				$match = $val['match'];
				$target = $val['target'];	

				$tAttrs = self::_getAttrValueFromAttrType($info['attrType_value'], $target);
				if(empty($tAttrs)) 
				{
					$right = 0;
					break;		
				}
					
				//relation  处理：<,>,in(包含于),ined(包含)， =							
				switch($op)
				{
					//单对单
					case '<':
						if ( !($tAttrs[0] < $match[0]) )
						{
							$right = 0;
							break 2;
						}
						break;
					//单对单
					case ">":
						if ( !($tAttrs[0] > $match[0]) )
						{
							$right = 0;
							break 2;
						}
						break;
					//多对一	（所需商品属性值为一个）
					case "in":
						$tmp = implode('|||',$match);
						if(!strstr($tmp, $tAttrs[0]))
						{
							$right = 0;
							break 2;
						}					
						break;
					//一对多	
					case "ined":
						$tmp = implode('|||',$tAttrs);
						if(!strstr($tmp, $match[0]))
						{
							$right = 0;
							break 2;
						}
						break;
					//单对单
					case "=":
						if ( !($tAttrs[0] == $match[0]) )
						{
							$right = 0;
							break 2;
						}
						break;						
					default: break;							
				}
			}
			if($right)
				$ret[]=$info;
		}
		//Logger::info("get diy products match count:".count($ret)); 
		return 	$ret;
	}
	
	/**
	 * 得到条件过滤字符串
	 * 
	 * @param array $attrFilter 属性    过滤条件
	 * @param array $matchFilter 匹配属性    过滤条件	
	 * @param string $titleFilter 标题字段    过滤条件
	 * @param int  &$flag
	 * @return string 
	 * 
	 */
	private static function _getProcudtSearchFilter($attrFilter=array(), $matchFilter=array(), $titleFilter)
	{
		//处理过滤条件
		$filterStr ='';
		if(!empty($attrFilter))
		{
			foreach ($attrFilter as $val)
			{
				$val = intval($val);
				$filterStr .= " and attr_id like '%=".$val."=%'";
			}
		}

		if(!empty($titleFilter))
			$filterStr .=" and product_name like '%".$titleFilter."%'";
		return $filterStr;
	}
	
	/**
	 * 从实体表读取数据
	 * 
	 * @author oscarzhu
	 * @param obj $db
	 * @param string $sql
	 * @return array
	 * 
	 */
	private static function _getDataFromProductSortTab($db, $sql)
	{
		//尝试从实体表读取数据
		$sql = str_replace(SORT_IN_MEM_TABLE_IPX,SORT_IN_TABLE_IPX,$sql);
		$result =  $db->getRows($sql);
		if( $result === false )
			return false;
		return 	$result;
	}
	
	/*
	 * 根据id批量获取商品信息
	 * 
	 * @param array $products 商品id数组
	 * @param int $wid 分仓号
	 * @return array 商品信息
	 * 
	 */
	private static function _getProductsInfo($products, $wid)
	{
		foreach( $products as $value )
		{
			$keys[] = $value['product_id'];
		}
		//拉取信息
		$productsInfo = IProduct::getProductsInfo($keys, $wid);
		if( $productsInfo===false )
		{
			self::$errCode = IProduct::$errCode;
			self::$errMsg  = IProduct::$errMsg;
			return false;
		}
		//处理信息数据
		$productsArray = array();
		foreach( $products as $value )
		{
			if(!empty($productsInfo[$value['product_id']]))
			{
			$productsInfo[$value['product_id']]['web_price'] = sprintf("%0.2f",$productsInfo[$value['product_id']]['show_price']/100);;
			$productsInfo[$value['product_id']]['comment'] = $value['comment'];
			$productsInfo[$value['product_id']]['satisfaction'] = $value['satisfaction'];
			$productsArray[] = $productsInfo[$value['product_id']];
			}
		}
		
		return $productsArray;
	}
	
	/*
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @param $attrFilter 属性    过滤条件
	 * @param $matchFilter 匹配属性    过滤条件	
	 * @param $titleFilter 标题字段    过滤条件
	 * @param int $sort   排序方式
	 * @param int $preNum	每页记录数
	 * @param int $page	  页码
	 * @param int $item_id	配件id
	 * @param int $wh_id	分仓id
	 * @return string	
	 * 
	 */
	private static function _getItemProductKey($attrFilter, $matchFilter, $titleFilter, $sort, $preNum, $page, $item_id, $wh_id)
	{
		$filterStr = '';
		if(!empty($attrFilter))
		{
			$filterStr = implode(':',$attrFilter);
		}
		if(!empty($matchFilter))
		{
			foreach ( $matchFilter as $val )
			{ 
				$filterStr .=$val['relation'];
				foreach ( $val['match'] as $key=>$val2 )
				{ 
					$filterStr .=$key;
					$filterStr .=$val2;
				}
				$filterStr .=$val['target'];
			}
		}
		$filterStr .=$titleFilter;		
		return "F{$filterStr}S{$sort}P{$preNum}P{$page}I{$item_id}W{$wh_id}";
	}
	
	/*
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @return string	
	 * 	
	 */
	private static function _getMatchKey()
	{
		return "DIY_MATCH_TABLE";
	}

	/*
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @return string	
	 * 	
	 */
	private static function _getProductAttrTypeKey($pid,$tid,$attrType)
	{
		return "DIY_PRODUCT_ATTR_".$tid."_".$pid."_".$attrType;
	}
	
	/*
	 * 根据指定的参数获得存储在cache中的Key
	 * 
	 * @return string	
	 * 	
	 */
	private static function _getProductAttrIdsKey($pid,$tid)
	{
		return "DIY_PRODUCT_ATTR_ID_".$tid."_".$pid;
	}
		
	/*
	 * 获取排序方式
	 * 
	 * @param int $num 序号
	 * @return string 
	 * 
	 */
	private static function _getOrderStr($num)
	{
		switch($num)
		{
			case 1://默认后台排序
				return " order by sort";
			case 2://高-低价格排序
				return " order by price desc";
			case 3://低-高价格排序
				return " order by price";
			case 4://销量排序
				return " order by sale desc";
			case 5://评论后台排序
				return " order by comment desc";
			default:
			return;
		}
	}
	
	/*
	 * 获取特殊匹配方案列表
	 * 
	 * @return array
	 * 
	 */	
	private static function _getMatch()
	{
		//组装 sql
		$sql = "select * from t_diy_match where status=0";
		//读取数据
		$db = Config::getDB(NEW_DIY_DB);
		$result =  $db->getRows($sql);
		if( $result === false )
		{
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		if(empty($result)) return array();
		return $result;
	}

	/*
	 * 获取商品属性类别id下的属性值列表
	 * 
	 * @param $pid 商品id
	 * @param $tid 配件id
	 * @return array
	 * 
	 */		
	private static function _getProductAttrValueFromType($pid,$tid,$attrType)
	{
		$result = self::_getProductDIYInfo($pid,$tid);
		if(empty($result)) return array();
		return self::_getAttrValueFromAttrType($result['attrType_value'], $attrType);
	}
	
	/*
	 * 获取商品属性类别ids列表
	 * 
	 * @param $pid 商品id
	 * @param $tid 配件id
	 * @return array
	 * 
	 */		
	private static function _getProductAttrTypeIds($pid,$tid)
	{
		$result = self::_getProductDIYInfo($pid,$tid);
		if(empty($result)) return array();
		$tmp = explode(DIY_PRODUCT_ATTR_TYPE_SEP,$result['attrType_value']);
		$result = array();
		foreach($tmp as $val)
		{
			if( $val )
			{
				$tmp2  = explode(DIY_PRODUCT_ATTR_SEP,$val,2);
				$result[]=$tmp2[0];
			}
		}
		return $result;
	}
	
	/*
	 * 获取商品id 获取商品DIY相关信息 attrType_value,attr_id
	 * 
	 * @param $pid 商品id
	 * @param $tid 配件id
	 * @return array
	 * 
	 */		
	private static function _getProductDIYInfo($pid,$tid='')
	{
		//组装 sql
		$where = '';
		$wid = IUser::getSiteId();
		if($tid)
			$where = " and item_id=".$tid;
		$sql = "select * from ".SORT_IN_MEM_TABLE_IPX." where wh_id = $wid and product_id=".$pid.$where;
		//读取数据
		$db = Config::getDB(NEW_DIY_DB);
		$result =  $db->getRows($sql);
		if( $result === false )
		{
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			//尝试从实体表读取
			$result = self::_getDataFromProductSortTab($db, $sql);
			if( $result === false )
				return false;
		}
		if(empty($result)) return array();
		return $result[0];
	}	
	
	/*
	 * 获取商品ids获取商品DIY相关信息 
	 * 
	 * @param $pids 商品ids
	 * @param $tid 配件id
	 * @return array
	 * 
	 */		
	private static function _getProductsDIYInfo($pids)
	{
		//组装 sql
		$wid = IUser::getSiteId();
		$pidStr = implode(',',$pids);
		$sql = "select * from ".SORT_IN_MEM_TABLE_IPX." where wh_id = $wid and product_id in(".$pidStr.")";
		//读取数据
		$db = Config::getDB(NEW_DIY_DB);
		$result =  $db->getRows($sql);
		if( $result === false )
		{
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			//尝试从实体表读取
			$result = self::_getDataFromProductSortTab($db, $sql);
			if( $result === false )
				return false;
		}
		if(empty($result)) return array();
		return $result;
	}
		
	/*
	 * 根据商品id获取商品属性id列表
	 * 
	 * @param $pid 商品id
	 * @param $tid 配件id
	 * @return array
	 * 
	 */	
	private static function _getProductAttrIds($tid,$pid)
	{
		$result = self::_getProductDIYInfo($pid,$tid);
		if(empty($result)) return array();
		$tmp = explode(DIY_PRODUCT_ATTR_SEP,$result['attr_id']);
		$attrIds = array();
		foreach( $tmp as $val )
		{
			if(!empty($val))
				$attrIds[] = $val;
		}
		return $attrIds;
	}
		
	/*
	 * 根据属性类别返回数组格式属性类别对应该属性值
	 * 
	 * @param $attrStr 属性类别和其属性值
	 * @param $attrType 属性类别
	 * @return array
	 * 
	 */		
	public static function _getAttrValueFromAttrType($attrStr,$attrType)
	{
		$tmp = explode(DIY_PRODUCT_ATTR_TYPE_SEP,$attrStr);
		$result = array();
		foreach($tmp as $val)
		{
			if( $val && !strncmp($val,$attrType.DIY_PRODUCT_ATTR_SEP,strlen($attrType+1)) )
			{
				$tmp2  = explode(DIY_PRODUCT_ATTR_SEP,$val,2);
				$result[]=$tmp2[1];
			}
		}
		return $result;
	}
	
	/**
	 * 根据提供的KEY获得cache的数据
	 * 
	 * @param key    cache的Key
	 */
	static function getCacheData($key)
	{
		$v = IDiyCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IDiyCacheTTC::$errCode;
			self::$errMsg  = IDiyCacheTTC::$errMsg;
			return false;
		}
		if (count($v)!=1) {
			self::$errCode = 11111;
			self::$errMsg  = "count not 1";
			return false;
		}
		$t = time();
		if ($v[0]['expiretime'] < $t) {
			IDiyCacheTTC::remove($key);
			return false;
		}
		return $v[0]['value'];
	}
	
	/**
	 * 根据提供的KEY存储cache的数据
	 * 如果数据已经存在，这直接覆盖，存在的话新增一条记录
	 * 
	 * @param key    cache的Key
	 */
	static function setCacheData($key, $value, $expire=300)
	{
		$v = IDiyCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IDiyCacheTTC::$errCode;
			self::$errMsg  = IDiyCacheTTC::$errMsg;
			return false;
		}
		$expire = intval($expire);
		$item = array();
		$item['key'] = $key;
		$item['value'] = $value;
		$item['expiretime'] = time()+$expire;
		$item['updatetime'] = time();
		if ($v!=false) {
			IDiyCacheTTC::remove($key);
		}
		$v = IDiyCacheTTC::insert($item);
		if ($v === false) {
			self::$errCode = IDiyCacheTTC::$errCode;
			self::$errMsg  = IDiyCacheTTC::$errMsg;
			return false;
		}
		return true;
	}

	/**
	 * 根据提供的KEY获得cache的数据
	 * 
	 * @param key    cache的Key
	 */
	static function getCacheDataNoTime($key)
	{
		$v = IDiyCacheTTC::get($key);
		if ($v === false) {
			self::$errCode = IDiyCacheTTC::$errCode;
			self::$errMsg  = IDiyCacheTTC::$errMsg;
			return false;
		}
		if (count($v)!=1) {
			self::$errCode = 11111;
			self::$errMsg  = "count not 1";
			return false;
		}
		return unserialize($v[0]['value']);
	}
		
	//缓存函数
    public static function cached(&$obj, $function, array $param, $cacheTimeout=30, $namespace='', $reset=false, $options=array())
    {
        //生成关键字
        if (!empty($options['key']))
        {
            $key = $options['key'];
        }
        else
        {
            $key = $namespace . "_" . get_class($obj) . "_{$function}_" . md5(serialize($param));
        }

        //如果没有指定重新获取数据，则判断缓存是否过期
        if (!$reset)
        {
             $result = self::getCacheData($key);
        }

        //如果参数设置为重置，或者已经过期，则重新设置数据
        if ($reset || $result===false)
        {
            //Logger::info('cache miss: ' . $key);
            $resultNew = call_user_func_array(array(&$obj, $function), $param);
            if($resultNew)
            	self::setCacheData($key, serialize($resultNew), $cacheTimeout);
            else
            	return false;
            return $resultNew;	
        }

        //如果已经执行取得结果
        if ($result)
        {
        	//Logger::info('cache hit: ' . $key);
            return unserialize($result);
        }

        return '';
    }  

	/*
	 * 根据商品数组返回商品之间的随心配关系，取价格最优方法
	 * 
	 * @author oscarzhu
	 * @param array $products 商品数组
	 * @return array $result array('商品id'=>'商品id'); 
	 * 
	 */	
    public static function getProductRelativity($products)
    {
    	
    	$whId = IUser::getSiteId(); 
        // 批量拉取商品随心配
        
        //ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
        $whId_temp = null;
        if (1001 == $whId){
        	$whId_temp = 1001;
        }
        else {
        	$whId_temp = 1;
        }
    	
        $results = IProductRelativityTTC::gets($products, array('type' => PRODUCT_BY_MIND, 'wh_id' => $whId_temp, 'status' => 1), 
        									array('relative_id', 'property','product_id'));
        if (false === $results)
        {
            self::$errCode = IProductRelativityTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
            return false;
        }
    
        //处理输入的商品之间如何随心配
        //返回二维数组 以商品ID为下标，返回此商品对应主商品ＩＤ和优惠价格数组
        $tmp = array();
     	$tmp_ = array();
        foreach($results as $val)
        {
        	$pid = $val['relative_id'];
        	if(in_array($pid,$products))
        	{
        		$tmp_['pid'] = $val['product_id'];
        		$tmp_['dprice'] = $val['property'];
        		$tmp[$pid][] = $tmp_;
        	}
        }

        //以商品ID为下标，返回此商品对应主商品里最优惠的主商品ID
        $result = array();
        $tmp_ = array();
        foreach ($tmp as $key=>$val)
        {
        	$price = 0;
        	foreach( $val as $val2)
        	{
        		if( $val2['dprice'] > $price )
        		{
        			$price = $val2['dprice'];
        			$result[$key] = intval($val2['pid']);
        		}
        	}
        			
        }
        
        //处理返回数组
        foreach( $products as $product) 
        {
            if(!key_exists($product,$result))
        	{
        		$product = intval($product);
        		$result[$product] = 0;
        	}
        }
        return $result;
    }
}
?>