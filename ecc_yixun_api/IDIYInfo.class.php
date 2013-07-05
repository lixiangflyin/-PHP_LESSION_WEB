<?php
require_once(PHPLIB_ROOT . 'inc/DIYConfig.inc.php');
/**
 * ǰ̨�û���ȡ<font color="#010101">DIY</font>�����Ϣ��
 * @author oscarzhu
 * @version 1.0
 * @created 03-����-2011 15:26:06
 */
class IDIYInfo
{
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ���û����б���ʱ��
	 */
	private static $saveTime = 600;//15����
	
	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * ��վ��Ӧ������
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
	 * ͨ��װ���ر���𣨼���֧�ֿ�֣�
	 */
	public static $mainCategories = array(
		'148'		=> 'CPU',
		'152'		=> '����',
		'146'		=> '�ڴ�',
		'138'		=> 'Ӳ��',
		'166'		=> '�Կ�',
		'111'		=> '��ʾ��',
		'100'		=> '����',
		'149'		=> '����',
		'132'		=> '��Դ',
		'159'		=> 'ɢ����',
		'325'		=> '��̬Ӳ��',
		'92'		=> '����',
		'212'		=> '����',
		'297'		=> 'ϵͳ���',
	);
	
	/**
	 * �����ֵ�����
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
		
		// ���˵�û������Ĭ�ϵ��������˱�ѡ��
		foreach ($datas as $data)
		{
			if (array_key_exists($data['item_id'], $defaults) && $data['enable'])
				$return[$data['item_id']] = $defaults[$data['item_id']];
		}
	
		return $return;
	}

	/*
	 * �ж���Ʒ���Ƿ�ƥ��
	 * 
	 * @param array $pids	��Ʒids
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
					//��ƥ����Ϣ���뵽�����
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
	 * �ж�������Ʒ�Ƿ�ƥ��
	 * 
	 * @param $pid	��Ʒid
	 * @param $pid2	��Ʒid
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
	 * ���ݵ�Դ����ֵ
	 * 
	 * @param $tid	���id
	 * @param $pid	��Ʒid
	 * @return array
	 * 
	 */
	static public function getPowerPower($pid)
	{
		$info = self::getProductAttrValueFromType($pid,9,520);//9�ǵ�Դ�����520��Դ�������id
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
	 * �������Ի�ȡ����ֵ
	 * 
	 * @param $tid	���id
	 * @param $pid	��Ʒid
	 * @return array
	 * 
	 */
	static public function getPower($tid,$pid)
	{
		$power = 0;
		
		//ƥ�������
		$info = IDiyPowerTTC::get($tid,array('attr_type_id'=>0,'attr_id'=>0,'status'=>0));
		if( $info === false )
		{
			self::$errCode = IDiyPowerTTC::$errCode;
			self::$errMsg  = IDiyPowerTTC::$errMsg;
			return false;
		}	
	
		if(!empty($info))
			return $info[0]['power'];
		
		//ƥ������ֵ��
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
				
		//ƥ�������༶
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
	 * ��ȡ����Ŀ���ѡ��
	 * 
	 * @param item_id    ������
	 * @return array(
	 * 			'brand'=>array(), //Ʒ���б�
	 * 			'attrType'=>array(),//����ѡ���������
	 * 			'attr'=>array(
	 * 					'�������id'=>����ֵ,...
	 * 			),//����ѡ������ֵ
	 * )
	 * 
	 */
	public static function getItemAttr($item_id)
	{
		//���ҹ��������ش������������ֵ���������
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
			//�����Ʒ�������ȡ���������¿�ʼ
			if(!strcmp($val['attr_type_name'],'Ʒ��'))
			{
				$tmp['name'] = $val['attr_name'];
				$tmp['id'] = $val['attr_id'];	
				$brandArr[]=$tmp;
				continue;
			}
			//ȡ���������
			if(!in_array(array('name'=>$val['attr_type_name'],'id'=>$val['attr_type_id']),$attrType))
			{
				$tmp['name'] = $val['attr_type_name'];
				$tmp['id'] = $val['attr_type_id'];
				$attrType[] = $tmp;
			}
			//ĳ��������µ�����ֵ
			$tmp = array('name'=>$val['attr_name'],'id'=>$val['attr_id']);
			$attrArr[$val['attr_type_id']][] = $tmp;
		}
		return array('brand'=>$brandArr,"attrType"=>$attrType,'attr'=>$attrArr);
	}

	/**
	 * ��ȡĳһ�����Ϣ
	 * 
	 * @param item_id    ���id
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
	 * ��ȡ����б��Լ�����Ϣ
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
		//����
		$tmpArr = array();
		foreach ($info as $t){
			$tmpArr[] = $t['sort'];
		}
		array_multisort($tmpArr, SORT_ASC ,SORT_NUMERIC,$info);		
		return	$info;
	}

	/**
	 * ��ȡĳ����²�Ʒ�б�
	 * 
	 * @param array $attrFilter ����    ��������
	 * @param array $matchFilter ƥ������    ��������	
	 * @param string $titleFilter �����ֶ�    ��������
	 * @param sort    ���򷽷�
	 * @param preNum    ÿҳ����
	 * @param page    ĳҳ
	 * @param item_id    ���id
	 * @return array ��Ʒ��Ϣ�б�
	 * 
	 */
	public static function getItemProduct($attrFilter=array(), $matchFilter=array(), $titleFilter='', $sort = 1, $preNum = 6, $page = 1, $id, $wid)
	{
		$sort = empty($sort)?1:intval($sort);
		$preNum = empty($preNum)?6:intval($preNum);
		$page = empty($page)?1:intval($page);
		$id = empty($id)?1:intval($id);
		$wid = empty($wid)?IUser::getSiteId():intval($wid);
		
		//����Ƿ��ڻ��д�������
		$key = self::_getItemProductKey($attrFilter, $matchFilter, $titleFilter, $sort, $preNum, $page, $id, $wid);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//�����ݶ�ȡ���ݣ��������ڻ������
		$result = self::_getItemProduct($attrFilter, $matchFilter, $titleFilter, $sort, $preNum, $page, $id, $wid);
		if($result===false) return false;
		if(empty($result['list'])) return array();
		$pinfo = self::_getProductsInfo($result['list'],$wid);
		if($pinfo===false) return false;
		if(empty($pinfo)) return array();
		 
		//�趨����
		$data = array('total'=>$result['total'],'list'=>$pinfo);
		self::setCacheData($key, serialize($data),self::$saveTime);
		return $data;
	}

	/**
	 * ������ѡ��Ʒ�����ش�ѡ�����ƥ�����
	 * 
	 * @param array $tIds  ��ѡ����Լ������Ʒid array('���id'=>��Ʒid)
	 * @param int   $tid ��ѡ���id
	 * @param array   $productInfo ����и�Ϊ��ѡ��ĳһ��Ʒ��������Ʒ��Ϣ�������ٴ����ݿ��ȡ����
	 * @return array('relation'=>array('�������id=>����ֵ'))
	 * relation ��5�������=,<,>,in(������),ined(������)
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
				//ȡ��ĳ�����ĳ��Ʒĳ����������������ֵ
				if(empty($productInfo))
					$productAttrs = IDIYInfo::getProductAttrValueFromType($tIds[$matchItemKey],$matchItemKey,$matchAttr);
				else
					$productAttrs = self::_getAttrValueFromAttrType($productInfo['attrType_value'], $matchAttr);	
				if($productAttrs) {
					$matchFilter[$i]['relation'] = $relation;//��ϵ
					$matchFilter[$i]['match'] = $productAttrs;//��ƥ����ֵ
					$matchFilter[$i]['target'] = $targetAttr;//Ŀ���������id
					$i++;
				}
			}
		}
		
		return $matchFilter;
	}
	
	/*
	 * ��ȡ����ƥ�䷽���б�
	 * 
	 * @return array
	 * 
	 */
	public static function getMatch()
	{
		//����Ƿ��ڻ��д�������
		$key = self::_getMatchKey();
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//�����ݶ�ȡ���ݣ��������ڻ������
		$result = self::_getMatch();
		if($result===false) return false;
		 
		//�趨����
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}
	
	/*
	 * ��ȡȡ��ĳ�����ĳ��Ʒ��������id
	 * 
	 * @param int $pid ��Ʒid
	 * @param int $tid ���id
	 * @return array 
	 * 			 
	 */
	public static function getProductAttrIds($tid,$pid)
	{
		//����Ƿ��ڻ��д�������
		$key = self::_getProductAttrIdsKey($tid,$pid);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//�����ݶ�ȡ���ݣ��������ڻ������
		$result = self::_getProductAttrIds($tid,$pid);
		if($result===false) return false;
		 
		//�趨����
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}
	
	/*
	 * ��ȡȡ��ĳ�����ĳ��Ʒĳ����������������ֵ
	 * 
	 * @param int $pid ��Ʒid
	 * @param int $tid ���id
	 * @return array ('�������id=����ֵ',..)
	 * 			 
	 */
	public static function getProductAttrValueFromType($pid,$tid,$attrType)
	{
		//����Ƿ��ڻ��д�������
		$key = self::_getProductAttrTypeKey($pid, $tid, $attrType);
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//�����ݶ�ȡ���ݣ��������ڻ������
		$result = self::_getProductAttrValueFromType($pid,$tid,$attrType);
		if($result===false) return false;
		 
		//�趨����
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}

	/*
	 * ��ȡȡ��ĳ�����ĳ��Ʒĳ�������ids
	 * 
	 * @param int $pid ��Ʒid
	 * @param int $tid ���id
	 * @return array ('�������id=����ֵ',..)
	 * 			 
	 */
	public static function getProductAttrTypeIds($pid,$tid)
	{
		//����Ƿ��ڻ��д�������
		$key = "DIY_PRODUCT_ATTR_TYPE_ID_".$tid."_".$pid;
		$value = self::getCacheData($key);
		if ($value!=false) {
			return unserialize($value);
		}

		//�����ݶ�ȡ���ݣ��������ڻ������
		$result = self::_getProductAttrTypeIds($pid,$tid);
		if($result===false) return false;
		 
		//�趨����
		self::setCacheData($key, serialize($result), self::$saveTime);
		return $result;
	}
	
	/*
	 * ����������ȡ��Ʒ��Ϣ
	 * 
	 * @param array $attrFilter ����    ��������
	 * @param array $matchFilter ƥ������    ��������	
	 * @param string $titleFilter �����ֶ�    ��������
	 * @param sort    ���򷽷�
	 * @param preNum    ÿҳ����
	 * @param page    ĳҳ
	 * @param item_id    ���id
	 * @return array ��Ʒ��Ϣ�б�
	 * 
	 */	
	private static function _getItemProduct($attrFilter, $matchFilter, $titleFilter, $sort, $preNum, $page, $tid, $wid)
	{
		$start = ($page-1)*$preNum; 
		
		//��������
		$filterStr = self::_getProcudtSearchFilter($attrFilter, $matchFilter, $titleFilter);

		//��װ sql
		//��������ʽ
		$orderStr = self::_getOrderStr($sort);		
		$where = " num_available=1 and status=1 and status2=1 and item_id=".$tid." and wh_id=".$wid." ".$filterStr;
		$limit = " limit ".intval($start).",".$preNum;
		$table  = SORT_IN_MEM_TABLE_IPX;
		
		//��ȡ����
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
			//���Դ�ʵ����ȡ
			$result = self::_getDataFromProductSortTab($db, $sql);
			if( $result === false )
				return false;
		}
		if(empty($result)) return array();

		//����ƥ�� ���˵�����ƥ�������
		if(!empty($matchFilter))
		{
			//��ƥ��ȡ�����м�¼��
			$ret = self::_getMatchProductFormResult($result, $matchFilter);
			//ȡ��ǰ̨�����¼����
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
	 * �������ݼ���ƥ�䷽ʽ�����ط�������������
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
					
				//relation  ����<,>,in(������),ined(����)�� =							
				switch($op)
				{
					//���Ե�
					case '<':
						if ( !($tAttrs[0] < $match[0]) )
						{
							$right = 0;
							break 2;
						}
						break;
					//���Ե�
					case ">":
						if ( !($tAttrs[0] > $match[0]) )
						{
							$right = 0;
							break 2;
						}
						break;
					//���һ	��������Ʒ����ֵΪһ����
					case "in":
						$tmp = implode('|||',$match);
						if(!strstr($tmp, $tAttrs[0]))
						{
							$right = 0;
							break 2;
						}					
						break;
					//һ�Զ�	
					case "ined":
						$tmp = implode('|||',$tAttrs);
						if(!strstr($tmp, $match[0]))
						{
							$right = 0;
							break 2;
						}
						break;
					//���Ե�
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
	 * �õ����������ַ���
	 * 
	 * @param array $attrFilter ����    ��������
	 * @param array $matchFilter ƥ������    ��������	
	 * @param string $titleFilter �����ֶ�    ��������
	 * @param int  &$flag
	 * @return string 
	 * 
	 */
	private static function _getProcudtSearchFilter($attrFilter=array(), $matchFilter=array(), $titleFilter)
	{
		//�����������
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
	 * ��ʵ����ȡ����
	 * 
	 * @author oscarzhu
	 * @param obj $db
	 * @param string $sql
	 * @return array
	 * 
	 */
	private static function _getDataFromProductSortTab($db, $sql)
	{
		//���Դ�ʵ����ȡ����
		$sql = str_replace(SORT_IN_MEM_TABLE_IPX,SORT_IN_TABLE_IPX,$sql);
		$result =  $db->getRows($sql);
		if( $result === false )
			return false;
		return 	$result;
	}
	
	/*
	 * ����id������ȡ��Ʒ��Ϣ
	 * 
	 * @param array $products ��Ʒid����
	 * @param int $wid �ֲֺ�
	 * @return array ��Ʒ��Ϣ
	 * 
	 */
	private static function _getProductsInfo($products, $wid)
	{
		foreach( $products as $value )
		{
			$keys[] = $value['product_id'];
		}
		//��ȡ��Ϣ
		$productsInfo = IProduct::getProductsInfo($keys, $wid);
		if( $productsInfo===false )
		{
			self::$errCode = IProduct::$errCode;
			self::$errMsg  = IProduct::$errMsg;
			return false;
		}
		//������Ϣ����
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
	 * ����ָ���Ĳ�����ô洢��cache�е�Key
	 * 
	 * @param $attrFilter ����    ��������
	 * @param $matchFilter ƥ������    ��������	
	 * @param $titleFilter �����ֶ�    ��������
	 * @param int $sort   ����ʽ
	 * @param int $preNum	ÿҳ��¼��
	 * @param int $page	  ҳ��
	 * @param int $item_id	���id
	 * @param int $wh_id	�ֲ�id
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
	 * ����ָ���Ĳ�����ô洢��cache�е�Key
	 * 
	 * @return string	
	 * 	
	 */
	private static function _getMatchKey()
	{
		return "DIY_MATCH_TABLE";
	}

	/*
	 * ����ָ���Ĳ�����ô洢��cache�е�Key
	 * 
	 * @return string	
	 * 	
	 */
	private static function _getProductAttrTypeKey($pid,$tid,$attrType)
	{
		return "DIY_PRODUCT_ATTR_".$tid."_".$pid."_".$attrType;
	}
	
	/*
	 * ����ָ���Ĳ�����ô洢��cache�е�Key
	 * 
	 * @return string	
	 * 	
	 */
	private static function _getProductAttrIdsKey($pid,$tid)
	{
		return "DIY_PRODUCT_ATTR_ID_".$tid."_".$pid;
	}
		
	/*
	 * ��ȡ����ʽ
	 * 
	 * @param int $num ���
	 * @return string 
	 * 
	 */
	private static function _getOrderStr($num)
	{
		switch($num)
		{
			case 1://Ĭ�Ϻ�̨����
				return " order by sort";
			case 2://��-�ͼ۸�����
				return " order by price desc";
			case 3://��-�߼۸�����
				return " order by price";
			case 4://��������
				return " order by sale desc";
			case 5://���ۺ�̨����
				return " order by comment desc";
			default:
			return;
		}
	}
	
	/*
	 * ��ȡ����ƥ�䷽���б�
	 * 
	 * @return array
	 * 
	 */	
	private static function _getMatch()
	{
		//��װ sql
		$sql = "select * from t_diy_match where status=0";
		//��ȡ����
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
	 * ��ȡ��Ʒ�������id�µ�����ֵ�б�
	 * 
	 * @param $pid ��Ʒid
	 * @param $tid ���id
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
	 * ��ȡ��Ʒ�������ids�б�
	 * 
	 * @param $pid ��Ʒid
	 * @param $tid ���id
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
	 * ��ȡ��Ʒid ��ȡ��ƷDIY�����Ϣ attrType_value,attr_id
	 * 
	 * @param $pid ��Ʒid
	 * @param $tid ���id
	 * @return array
	 * 
	 */		
	private static function _getProductDIYInfo($pid,$tid='')
	{
		//��װ sql
		$where = '';
		$wid = IUser::getSiteId();
		if($tid)
			$where = " and item_id=".$tid;
		$sql = "select * from ".SORT_IN_MEM_TABLE_IPX." where wh_id = $wid and product_id=".$pid.$where;
		//��ȡ����
		$db = Config::getDB(NEW_DIY_DB);
		$result =  $db->getRows($sql);
		if( $result === false )
		{
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			//���Դ�ʵ����ȡ
			$result = self::_getDataFromProductSortTab($db, $sql);
			if( $result === false )
				return false;
		}
		if(empty($result)) return array();
		return $result[0];
	}	
	
	/*
	 * ��ȡ��Ʒids��ȡ��ƷDIY�����Ϣ 
	 * 
	 * @param $pids ��Ʒids
	 * @param $tid ���id
	 * @return array
	 * 
	 */		
	private static function _getProductsDIYInfo($pids)
	{
		//��װ sql
		$wid = IUser::getSiteId();
		$pidStr = implode(',',$pids);
		$sql = "select * from ".SORT_IN_MEM_TABLE_IPX." where wh_id = $wid and product_id in(".$pidStr.")";
		//��ȡ����
		$db = Config::getDB(NEW_DIY_DB);
		$result =  $db->getRows($sql);
		if( $result === false )
		{
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			//���Դ�ʵ����ȡ
			$result = self::_getDataFromProductSortTab($db, $sql);
			if( $result === false )
				return false;
		}
		if(empty($result)) return array();
		return $result;
	}
		
	/*
	 * ������Ʒid��ȡ��Ʒ����id�б�
	 * 
	 * @param $pid ��Ʒid
	 * @param $tid ���id
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
	 * ����������𷵻������ʽ��������Ӧ������ֵ
	 * 
	 * @param $attrStr ��������������ֵ
	 * @param $attrType �������
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
	 * �����ṩ��KEY���cache������
	 * 
	 * @param key    cache��Key
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
	 * �����ṩ��KEY�洢cache������
	 * ��������Ѿ����ڣ���ֱ�Ӹ��ǣ����ڵĻ�����һ����¼
	 * 
	 * @param key    cache��Key
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
	 * �����ṩ��KEY���cache������
	 * 
	 * @param key    cache��Key
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
		
	//���溯��
    public static function cached(&$obj, $function, array $param, $cacheTimeout=30, $namespace='', $reset=false, $options=array())
    {
        //���ɹؼ���
        if (!empty($options['key']))
        {
            $key = $options['key'];
        }
        else
        {
            $key = $namespace . "_" . get_class($obj) . "_{$function}_" . md5(serialize($param));
        }

        //���û��ָ�����»�ȡ���ݣ����жϻ����Ƿ����
        if (!$reset)
        {
             $result = self::getCacheData($key);
        }

        //�����������Ϊ���ã������Ѿ����ڣ���������������
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

        //����Ѿ�ִ��ȡ�ý��
        if ($result)
        {
        	//Logger::info('cache hit: ' . $key);
            return unserialize($result);
        }

        return '';
    }  

	/*
	 * ������Ʒ���鷵����Ʒ֮����������ϵ��ȡ�۸����ŷ���
	 * 
	 * @author oscarzhu
	 * @param array $products ��Ʒ����
	 * @return array $result array('��Ʒid'=>'��Ʒid'); 
	 * 
	 */	
    public static function getProductRelativity($products)
    {
    	
    	$whId = IUser::getSiteId(); 
        // ������ȡ��Ʒ������
        
        //ixiuzeng��ӣ��㶫վ��������ӹ㶫վ��ȡ���Ϻ��ͱ�������������Ȼ���Ϻ���ȡ
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
    
        //�����������Ʒ֮�����������
        //���ض�ά���� ����ƷIDΪ�±꣬���ش���Ʒ��Ӧ����Ʒ�ɣĺ��Żݼ۸�����
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

        //����ƷIDΪ�±꣬���ش���Ʒ��Ӧ����Ʒ�����Żݵ�����ƷID
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
        
        //����������
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