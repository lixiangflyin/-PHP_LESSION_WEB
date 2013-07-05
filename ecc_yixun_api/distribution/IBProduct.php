<?php
define('PRICE_TYPE_PERCENT', 1);
define('PRICE_TYPE_VALUE', 0);
define('CATEGORY_TYPE_1', 1);
define('CATEGORY_TYPE_2', 2);
define('CATEGORY_TYPE_3', 3);
define('STOCK_EXIST', 1); 	  //�л�״̬
define('STOCK_NOT_EXIST', 0); //�޻�״̬
define('TOPSTATECOUNT', 30);
/*
	�����붨��
	401:һ������id��
	402����������id��
	403����������id��
	411:һ������id������
	412����������id������
	413����������id������

	404:��ƷID��
	414����ƷID������
	405:��ƷID����Ϊ��
	406:��Ʒ��ĿΪ��
 	407 ����Ʒδ����
 	408:��������Ϊ��
 	409:�����������鲻�Ϸ�
 	410:�Ƿ��ö�
*/

class IBProduct
{
	private static $debug = true;

    public static $errCode = 0;

    /**
     * ������Ϣ
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
	 * ��Ŀid ��ȡ����Ŀ����Ŀ
	 * @param  int $type_
	 * @param  int $categoryId_
	 */
	public static function getCategory($type_ , $categoryId_)
	{
		if (CATEGORY_TYPE_1 == $type_)
		{
			global $_CATEGORY1_CFG;
			$class =  ICategoryTTC::gets(array_unique(array_keys($_CATEGORY1_CFG)), array('status'=>0), array('id','name'));
			if (false === $class)
			{
				self::$errCode = ICategoryTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . ICategoryTTC::$errMsg;

				return false;
			}
			if (empty($class))
			{
				self::$errCode = 411;
				self::$errMsg =  'c1id is invalid';

				return false;
			}

			return $class;
		}
		else
		{
			$child_class_ids = ICategoryTTC::get($categoryId_, array('status'=>0), array('child_id'));
			if (false === $child_class_ids)
			{
				self::$errCode = ICategoryTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . ICategoryTTC::$errMsg;

				return false;
			}
			if (count($child_class_ids) <= 0)
			{
				self::$errCode = 411;
				self::$errMsg =  'parent category id is invalid';

				return false;
			}

			$child_class =  ICategoryTTC::gets(explode(',', $child_class_ids[0]['child_id']), array('status'=>0), array('id','name'));
			if (false ===$child_class)
			{
				self::$errCode = ICategoryTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . ICategoryTTC::$errMsg;

				return false;
			}
			if (empty($child_class))
			{
				self::$errCode = 412;
				self::$errMsg =  'child category id is invalid';

				return false;
			}

			return $child_class;
		}
	}

	/**
	 *  ��������Ŀid��ȡ ��Ŀ��ϸ��Ϣ
	 *
	 *  @return sring ������/����/С�ࣩ|array(array1,array2,array3)
	 */
	public static function getCategoryInfo($c3id_,$haveId_=false)
	{
		if (!isset($c3id_))
		{
			self::$errCode = 403;
			self::$errMsg = 'category3 id is null';

			return '';
		}

		$class3 =  ICategoryTTC::get($c3id_, array(), array('parent_id','name'));
		if (false === $class3)
		{
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . ICategoryTTC::$errMsg;

			return '';
		}
		if (count($class3) <= 0)
		{
			self::$errCode = 413;
			self::$errMsg =  'category3 id is invalid';

			return '';
		}

		$class2 = ICategoryTTC::get($class3[0]['parent_id'], array(), array('parent_id','name'));
		if (false === $class2)
		{
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . ICategoryTTC::$errMsg;

			return '';
		}
		if (count($class2) <= 0)
		{
			self::$errCode = 412;
			self::$errMsg =  'can not find category2';

			return '';
		}

		$class1 = ICategoryTTC::get($class2[0]['parent_id'], array(), array('parent_id','name'));
		if (false === $class2)
		{
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . ICategoryTTC::$errMsg;

			return '';
		}
		if (count($class1) <= 0)
		{
			self::$errCode = 412;
			self::$errMsg =  'can not find category1';

			return '';
		}
		if (!$haveId_)
		{
			return $class1[0]['name'] . '/' . $class2[0]['name'] . '/' . $class3[0]['name'] ;
		}

		return array_merge($class1,$class2,$class3);
	}

	/**
	 * ������ȡ��Ʒ�����Ϣ
	 * @param array $pids_
	 *    array(pid1,pid2)
	 * @return array('pid1'=>'',pid2=>'') | false
	 */
	public static function getStockInfo($pids_)
	{
		if (!is_array($pids_))
		{
			self::$errCode = 404;
			self::$errMsg = 'product_id is null';

			return false;
		}

		$stock_infos = IProductInventory::getProductsInventeory($pids_, 1); //�Ϻ��ֲ�
		if (false === $stock_infos)
		{
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = 'IBProduct getStockInfo wrong';

			return false;
		}

		global $_StockTips;
		$ret_arr = array();
		foreach($stock_infos AS $stock_info)
		{
			if ($stock_info['virtual_num'] + $stock_info['num_available'] <= 0)
			{
				$ret_arr[$stock_info['product_id']] = $_StockTips['not_available'];
			}
			else
			{
				$ret_arr[$stock_info['product_id']] = $_StockTips['available'];
			}

		}

		return $ret_arr;
	}

	/**
	 * ������ȡ��Ʒ�������
	 * @param array $pids_
	 * @return array('pid1'=>'',pid2=>'') | false
	 */
	public static function getStockNum($pids_)
	{
		if (!is_array($pids_))
		{
			self::$errCode = 404;
			self::$errMsg = 'product_id is null';

			return false;
		}

		$stock_infos = IProductInventory::getProductsInventeory($pids_, 1); //�Ϻ��ֲ�
		if (false === $stock_infos)
		{
			self::$errCode = IProductCommonInfoTTC::$errCode;
			self::$errMsg = 'IBProduct getStockInfo wrong';

			return false;
		}

		$ret_arr = array();
		foreach($stock_infos AS $stock_info) {
		    $ret_arr[$stock_info['product_id']] = array('num_available' => $stock_info['num_available'], 'virtual_num' => $stock_info['virtual_num']);
		}
		return $ret_arr;
	}

	public static function insertProduct($records)
	{
		if (!is_array($records))
		{
			self::$errCode = 408;
			self::$errMsg = 'records is null';

			return false;
		}
		$res = IRetailerProductDao::batchInsert($records);

		if (false === $res)
		{
			self::$errCode = IRetailerProductDao::$errCode;
			self::$errMsg =  IRetailerProductDao::$errMsg;

			return  false;
		}

		return true;
	}

	/**
	 * ������Ʒ�����������������������Ƶ�����
	 * �� t_retailer_product �л�ȡ��Ʒ
	 * adminҵ�� ֱ��db
	 * @param array $filter   t_retailer_product������
	 * @param string $icsonid
	 */
	public static function getProductsByAdmin( $filter=array(), $icsonid=null, $page=1, $pageSize=24)
	{
		if (!is_array($filter))
		{
			self::$errCode = 408;
			self::$errMsg = 'filter condition is null';

			return false;
		}
		// search t_retailer to get uids
		$sql = '';
		$countSql = '';
		$retailer_ids = array();
		if (isset($icsonid))
		{
			$retailers = IRetailer::getRetailers(array('icsonid' => $icsonid));
			if (false === $retailers)
			{
				self::$errCode = IRetailer::$errCode;
				self::$errMsg = IRetailer::$errMsg;

				return false;
			}
			if (count($retailers) <= 0)
			{
				self::$errCode = -1001;
                self::$errMsg = "�����ڴ˷����û�";

				return false;
			}
			foreach($retailers AS $retailer)
			{
				array_push($retailer_ids,$retailer['uid']);
			}

$sql = "SELECT * FROM t_retailer_product WHERE retailerId in (". implode(",",$retailer_ids).") AND ";
$countSql = "SELECT count(*) AS total FROM t_retailer_product WHERE retailerId in (". implode(",",$retailer_ids).") AND ";
		}
		else
		{
$sql = "SELECT * FROM t_retailer_product WHERE 1=1 AND ";
$countSql = "SELECT COUNT(*) AS total FROM t_retailer_product WHERE 1=1 AND ";
		}

	    $mysql = Config::getDB("retailer");
        if (!$mysql)
        {
            self::$errCode =  Config::$errCode;
            self::$errMsg =  Config::$errMsg;
            return false;
        }
        $whereSql = IRetailerProductDao::getFilterString($filter,$mysql);

        $countSql .= $whereSql;
        $totals = $mysql->getRows($countSql);
        if (false === $totals)
        {
            self::$errCode = $mysql->errCode;
            self::$errMsg =  $mysql->errMsg;

            return  false;
        }
        $total = $totals[0]['total'];

        $begin = ($page-1) * $pageSize;
 $sql .= $whereSql;
 $sql .= " LIMIT " . $begin . "," . $pageSize;
		$products = $mysql->getRows($sql);
		if (false === $products)
		{
			self::$errCode = $mysql->errCode;
			self::$errMsg =  $mysql->errMsg;

			return  false;
		}

		return array('total'=>$total,'data'=>$products);
	}

	/**
	 * ������Ʒ������������
	 * �� ttc�л�ȡ��Ʒ
	 * @param array $data
	 *    array(
	 *    	'retailerId' => int
	 *    	'pids' => array(1,1,3,..)
	 *    	'stock' => int
	 *    )
	 * @param array $filter ��������
	 * @return array('list'=>array(),'totalNum'=>int)
	 */
	public static function getProductsByRetailer($data, $filter=array(), $pageno=1, $pagesize=0 )
	{
		if (!is_array($filter) || (!isset($data['retailerId'])))
		{
			self::$errCode = 408;
			self::$errMsg = 'filter condition is null';

			return false;
		}
		if (!isset($filter['isDelete']))
		{
            $filter['isDelete'] = 0;
		}
		$retData = array();
		$retData['list'] = array();
		$start = ($pageno -1) * $pagesize;
		if ($pagesize > 0) //��ҳҪ��ȡ��Ʒ����     $pagesize=0 ��ʾ����ҳ
		{
			$products = IRetailerProductDao::getRows(array('retailerId'=>$data['retailerId']),$filter);
			if (false === $products)
			{
				self::$errCode = IRetailerProductDao::$errCode;
				self::$errMsg =  IRetailerProductDao::$errMsg;

				return  false;
			}
//		    $products =	self::filterDistributionPrice($data['retailerId'], $products);
			$retData['totalNum'] = count($products);

			if (isset($data['stock']) && ($data['stock'] <= STOCK_EXIST))//��̬���˿�沢��ҳ
			{
			    $products = self::filterStock($products,$data['stock']);
				if (($start+1) > count($products))
				{
					$start =  (intval(count($products)/$pagesize)-1) * $pagesize;
				}
				if ($start < 0)
				{
					$start = 0;
				}

				$retData['list'] = array_slice($products,$start,$pagesize);
				$retData['totalNum'] = count($products);  //
			}
			else   //����Ҫ����
			{
				if (($start+1) > count($products))
				{
					$start =  (intval(count($products)/$pagesize)-1) * $pagesize;
				}
				if ($start < 0)
				{
					$start = 0;
				}
        		$retData['list'] = array_slice($products,$start,$pagesize);
			}
		}
		else   //����ҳ
		{
			$products = IRetailerProductDao::getRows($data,$filter);
			if (false === $products)
			{
				self::$errCode = IRetailerProductDao::$errCode;
				self::$errMsg =  IRetailerProductDao::$errMsg;

				return  false;
			}
		$products =	self::filterDistributionPrice($data['retailerId'], $products);
			if (isset($data['stock']) && ($data['stock'] <= STOCK_EXIST))
			{
			   $products = self::filterStock($products,$data['stock']);
			}
			$retData['list'] = $products;
		}
		return $retData;
	}

	/**
	 * ����ʵʱ������
	 * @param array $products
	 *    array(
	 *    	array('productId'=>'','productNo'=>'',..)
	 *    )
	 * @param int $stock
	 * @return array product
	 */
	private static function filterStock($products, $stock)
	{
		$pids = array();
		foreach ($products AS $product)
		{
			array_push($pids, $product['productId']);
		}
		$stock_info = self::getStockInfo($pids);

		global $_StockTips;
		foreach ($products AS $index => $prod)
		{
			if (!isset($stock_info[$prod['productId']]))
			{
				unset($products[$index]);
			}
			if ((STOCK_EXIST == $stock) &&
				($stock_info[$prod['productId']] == $_StockTips['not_available'] ))
			{
				unset($products[$index]);
			}
			if ((STOCK_NOT_EXIST == $stock) &&
				($stock_info[$prod['productId']] != $_StockTips['not_available'] ))
			{
				unset($products[$index]);
			}
		}

		return $products;
	}

   /**
     * ����ʵʱ�����۹���
     * @param array $products
     *    array(
     *      array('productId'=>'','productNo'=>'',..)
     *    )
     * @param int $stock
     * @return array product
     */
    private static function filterDistributionPrice($parent_id_, $products)
    {
        $pids = array();
        foreach ($products AS $product)
        {
            array_push($pids, $product['productId']);
        }
      //  $price_info = self::getProductDistributionPrice($parent_id_, $pids);
        global $_StockTips;
        foreach ($products AS $index => $prod)
        {
        	$price_info = self::getProductDistributionPrice($parent_id_, array($prod['productId']));
            if (!isset($price_info[$prod['productId']]))
            {
                unset($products[$index]);
            }
        }

        return $products;
    }

	/**ɾ����������Ʒ*/
	public static function removeProducts($uid,&$pids)
	{
		if (!is_array($pids))
		{
			self::$errCode = 404;
			self::$errMsg = 'product IDs is null';

			return false;
		}
		$ret = IRetailerProductDao::getRows(array('retailerId'=>$uid,'pids'=>$pids),array('isDelete' => 0));
		if (false === $ret)
		{
			self::$errCode = IRetailerProductDao::$errCode;
			self::$errMsg = IRetailerProductDao::$errMsg;

			return false;
		}
		if (count($ret) <= 0)
		{
			self::$errCode = 414;
			self::$errMsg = 'product IDs is not exist';

			return false;
		}
		/** �����Ʒ�Ƿ��ɾ��*/
		$array_is_shelve = array();  //��¼����ɾ������Ʒ
		foreach ($ret as $product)
		{
			if (intval($product['shelveState']))
			{
				array_push($array_is_shelve,$product['productNo']);
				$key = array_search($product['productId'],$pids);
				unset($pids[$key]); 	//ɾ����pid
			}
		}

		if (count($pids) > 0)
		{
			$data = array(
	              'retailerId'=> $uid,
				  'productIds' => $pids,
	              'isDelete' => 1,
	              'updateTime' => time()
             );
            $result = self::updateProduct($data,array());
			if (false === $result)
	        {
	            self::$errCode = IRetailerProductDao::$errCode;
	            self::$errMsg = IRetailerProductDao::$errMsg;

	            return false;
	        }
		}

		if (count($array_is_shelve) > 0)
		{
			return $array_is_shelve;
		}

		return true;
	}

	/**
	 * ��ȡ�����̵��ö�����µ�ǰ$num����Ʒ
	 * @param int $parentId ������id
	 * @param int $begin ��ʼ�±�  ��0��ʼ
	 * @param int $num ����
	 * @return ��ȷarray('list' =>array())
	 *�������� ���󷵻�false
	 */
	public static function getTopItems($parentId, $begin, $num)
	{
		$begin = intval($begin);
        $num = intval($num);

        $ret_arr = array();
        $pid_arr = array();
        $pid_arr = IRetailerProductDao::getRows(
                             array('retailerId' => intval($parentId)),
                             array(
                             'isDelete' => 0,
                                'topState' => 1 ) );
        if (false === $pid_arr)
        {
            self::$errCode = IRetailerProductDao::$errCode;
            self::$errMsg = IRetailerProductDao::$errMsg;
            self::logger('db error: ' . basename(__FILE__, '.php') . " |" . __LINE__);

            return array('list' => array());
        }

//         $other_pids = IRetailerProductDao::getRows(
//                              array('retailerId' => intval($parentId)),
//                              array(
//                              'isDelete' => 0,
//                                 'shelveState' => 1,
//                                 'topState' => 0));
//         if (false === $other_pids)
//         {
//             self::$errCode = IRetailerProductDao::$errCode;
//             self::$errMsg = IRetailerProductDao::$errMsg;

//             return array('list' => array());
//         }
//         $all_arr = array_merge($pid_arr,$other_pids);
         $ret_arr = self::filterDistributionPrice($parentId, array_slice($pid_arr,$begin,$num));
//         $i = 1;
//         while ((count($ret_arr) < $num ) && (($begin + $i * $num) <= count($all_arr))){
//             $temp = self::filterDistributionPrice($parentId, array_slice($all_arr,$begin + $i * $num,$num));
//             if (count($temp) > $num-count($ret_arr))
//             {
//                 $temp = array_slice($temp,0, $num-count($ret_arr));
//             }
//             $ret_arr = array_merge($ret_arr,$temp);
//             $i ++;
//         }

        //��С���ȡ�Ƽ���Ʒ
        if (count($ret_arr) === 0){
        		
        	$url = "http://" . '10.191.7.215' . "/huangpu/getCategory?parentId=" . $parent_id;
        	$retA = NetUtil::cURLHTTPGet($url, 2, "searchex.paipai.com");
        	if (false === $retA){
        		self::$errCode = NetUtil::$errCode;
        		self::$errMsg = NetUtil::$errMsg;
        	}
        	$cataegroys = ToolUtil::gbJsonDecode($retA);
        	Logger::$info(var_export($cataegroys, true));
        	if (isset($cataegroys['L1Categories'])){
        
        		if (isset($cataegroys['L1Categories'][0]['L2Categories'][0]['L3Categories'][0]['L3CatId'])){
        			$c3id = $cataegroys['L1Categories'][0]['L2Categories'][0]['L3Categories'][0]['L3CatId'];
        			Logger::$info('��ѡ��Ŀc3id = ' . $c3id);
					//ƴװ�����ؼ���
        			$url = "http://" . '10.191.7.215' . "/huangpu/json?parentId=" . $parent_id;
        			$url .= '&classid=' . $c3id;
        			$url .= '&areacode=' . (1000000 + SITE_SH);//�ֿ�Ĭ��Ϊվ��ID�ӹ̶�ֵ
        			$url .= '&sort=6';
        			$url .= '&page=1';
        			$url .= '&pagecount=8';
        			$retSearch = NetUtil::cURLHTTPGet($url, 2, "searchex.paipai.com");
        			if (false === $retSearch)
        			{
        				self::$errCode = NetUtil::$errCode;
        				self::$errMsg = NetUtil::$errMsg;
        			}
        			else 
        			{
	        			$retSearch = ToolUtil::gbJsonDecode($retSearch);
	        			Logger::$info(var_export($retSearch, true));
	        	
	        			if (0 !== count($retSearch['list']))
	        			{
	        				//�������ڣ��������ص���Ʒ��Ҫ����60�ڣ���������Ҫ��ȥ
	        				foreach ($retSearch['list'] AS &$product)
	        				{
	        					$pro['productId'] = $product['sysNo'] - 6000000000;
	        					$ret_arr[] = $pro;
	        				}
	        			}	
        			}
        		}
        	}
        }
        
		//ƴװ����
		$data = array();
		$index = 0;
		global $_StockTips;
		$pids = array();
        foreach ($ret_arr AS $prod)
        {
            array_push($pids, $prod['productId']);
        }
        $price_arr = self::getMarketPrice($parentId,$pids);
	    $products = IProductCommonInfoTTC::gets($pids);
        if (false === $products)
        {
            self::$errCode = IProductCommonInfoTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductCommonInfoTTC failed]' . IProductCommonInfoTTC::$errMsg;
            return false;
        }
        $productInfos = IProductInfoTTC::gets($pids);
	    if (false === $productInfos)
        {
            self::$errCode = IProductInfoTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductInfoTTC failed]' . IProductInfoTTC::$errMsg;
            return false;
        }
        $stock_info = IBProduct::getStockInfo($pids);
        if (false === $stock_info)
        {
            return false;
        }
		foreach ($ret_arr AS $i => $product_id)
		{
			if ($index >= $num)
			{
				break;
			}
			if (!isset($price_arr[$product_id['productId']]))
			{
				self::$errCode =  407;
				self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " no shelveup product  exist " . IProduct::$errMsg;
			    continue;
			}
			$pinfo = false;
            foreach($products AS $p_info)
            {
                if ($p_info['product_id'] == $product_id['productId'])
                {
                    $pinfo = $p_info;
                    break;
                }
            }
            if (false === $pinfo)
            {
            	 continue;
            }
            $productinfo = false;
		    foreach($productInfos AS $pInfo)
            {
                if ($pInfo['product_id'] == $product_id['productId'])
                {
                    $productinfo = $pInfo;
                    break;
                }
            }
            if (false === $productinfo)
            {
                 continue;
            }
			$data[$index]['sysNo'] = $product_id['productId'];
			$data[$index]['productID'] = $product_id['productNo'];
			$data[$index]['productTitle'] = $pinfo['name'];
			//������
			$data[$index]['sailprice'] = (isset($price_arr[$product_id['productId']])) ? $price_arr[$product_id['productId']]:'';
			//�г���
			$data[$index]['marketprice'] = (intval($productinfo['market_price']) < intval($data[$index]['sailprice'])) ? $data[$index]['sailprice'] : $productinfo['market_price'];
			$data[$index]['pic'] = IProduct::getPic($product_id['productNo'], 'pic200');
			$data[$index]['hasStock'] = ($stock_info[$product_id['productId']] == $_StockTips['not_available'] ) ? 0 : 1;
			
			$productBaseInfo = IProductInfoTTC::get($product_id['productId']);
			$num_limit = 999;
			$data[$index]['status'] = 1;
			if (false === $productBaseInfo || count($productBaseInfo) == 0)
			{
				Logger::err('product_id:' . $product_id['productId'] . ' no base info ' . IProductInfoTTC::$errMsg);
			}
			else {
				$num_limit = $productBaseInfo[0]['num_limit'];
				$data[$index]['status'] = $productBaseInfo[0]['status'];
			}
			$data[$index]['buyinglimt'] = $num_limit;
			
			$index ++;
		}

		$ret['list'] = $data;
		
		return $ret;
	}

	/**
	 * ��ȡ������
	 * @param puid
	 * @param array(productids)
	 *
	 * @return array('productid'=>33.33)
	 */
	public static function getMarketPrice($puid,$productIdArr)
	{
		if (count($productIdArr) <= 0)
		{
			self::$errCode =  405;
			self::$errMsg = basename ( __FILE__, '.php' ) . " |" . __LINE__ . " product ids is null " ;
			return array();
		}
		$ret_arr = array();

		$retailer = IRetailer::getRetailers(array('uid' => $puid));
		if (false === $retailer)
		{
			Logger::err(IRetailer::$errMsg);
			return false;
		}
		else if (0 === count($retailer))
		{
			Logger::err("δ�ҵ���������Ϣ");
			return false;
		}
		$retailer = current($retailer);
		
		$userData = array(
				'uid' => $puid,
				'utype'=> $retailer['retailerType'],
				'pids' => $productIdArr
		);
		
		$sPrice = IDistributionPrice::getSailPriceForProducts($userData);
		if (false === $sPrice){
			
			Logger::err(IDistributionPrice::$errMsg);
			return array();
		}

		return $sPrice;
	}

	/**
	 * ��ȡ��Ʒ�ķ�����
	 */
	public static function getProductDistributionPrice($parent_id_, $product_ids_, $wh_ = 1)
	{
	    // get the retailer's level according to uid
	    $ret = IRetailer::getRetailers(array('uid' => $parent_id_));
	    if (FALSE === $ret) {
	    	self::$errCode = IRetailer::$errCode;
	    	self::$errMsg = IRetailer::$errMsg;

	    	return false;
	    }
	    if (!$ret) {
	    	self::$errCode = 10001;
	    	self::$errMsg = "Can not find account info";

	    	return false;
	    }
	    $retailer = current($ret);
        $uData = array(
			        'uid'   => $parent_id_,
			        'utype' => $retailer['retailerType'],
			        'pids'  => $product_ids_
                );

		$ret = IDistributionPrice::getPriceForProducts($uData, $wh_);
	    if (false === $ret)
	    {
	          self::$errCode = IDistributionPrice::$errCode;
	          self::$errMsg = IDistributionPrice::$errMsg;

	          return false;
	    }
        foreach ($ret AS $key => $value)
        {
            $price[$key] = self::trimStandardPrice($value);
        }

        return $price;
	}

	// ��ҵ��ɱ��۲�׼ȷʱ���۸����ʧЧ������Ѹ�۴���
	public static function protectForInaccurateCostPrice(&$price, $wh_ = 1)
	{
		// ������һ���޸ı�����ֵ�ĺ��ţ�1.3��Ĭ��ֵӦ��������Ҫ��
		$paraFile = '/tmp/retailer_price_protect_para';
		$protectPara = 1.3; // Ĭ�ϱ�����ֵ�� 1.3
		if (file_exists($paraFile)) {
			$protectPara = floatval(file_get_contents($paraFile));
		}

		$product_ids_ = array_keys($price);
		$ret = IProductInfoTTC::gets($product_ids_, array('wh_id'=>$wh_), array('product_id', 'business_unit_cost_price', 'price'));

		if (is_array($ret) && !empty($ret)) {
			foreach ($ret as $value) {
				if ($value['business_unit_cost_price'] <= 0) {
					$price[$value['product_id']] = $value['price']; // ҵ��ɱ���С�ڵ���0��������Ѹ��
					self::logger('[business_unit_cost_price is zero, product id:' . $value['product_id'] . ']' . basename(__FILE__, '.php') . " |" . __LINE__);
				}else{
					$ratio = $value['price'] / $value['business_unit_cost_price'];
					if ($ratio > $protectPara) { // ��Ѹ����ҵ��ɱ��۱���������������Ѹ��
						$price[$value['product_id']] = $value['price'];
						self::logger('[business_unit_cost_price is inaccurate, product id:' . $value['product_id'] . ', business_unit_cost_price:' . $value['business_unit_cost_price'] . ', icson price:' . $value['price'] . ']' . basename(__FILE__, '.php') . " |" . __LINE__);
					}
				}
			}
		}
		return $price;
	}

	/**
	 * ��������
	 * @param array $data		��������
	 * $data
	 * 	array(key=>value,'productIds'=>array, ...)
	 * )
	 * @param array $filter		��������
	 * @param array $productIds  ��Ҫ���µ�pid����
	 */
	public static function updateProduct($data, $filter )
	{
		if (!is_array($data))
		{
			self::$errCode = 409;
			self::$errMsg = 'update data is null';

			return false;
		}

		$result = IRetailerProductDao::update($data,$filter);

		if (false === $result)
		{
			self::$errCode = IRetailerProductDao::$errCode;
			self::$errMsg = IRetailerProductDao::$errMsg;

			return false;
		}

		return true;
	}

	/**
	 * �ö�ѡƷ
	 * @param array $data ����  key => value
	 * @param int  $retailerId key
	 * @param int  $productId
	 * @param $count �ö��������� Ĭ��Ϊ30��
	 * @return����ȷ����true�����󷵻�false
	 */
	public static function setTopProduct($data, $retailerId, $productId,$count=TOPSTATECOUNT)
	{
		if (!is_array($data))
		{
			self::$errCode = 409;
			self::$errMsg = 't data is null';

			return false;
		}

		$retailerId = intval($retailerId);
		$productId = intval($productId);
		$check = IRetailerProductDao::getRows(array('retailerId'=>$retailerId),array('productId' => $productId,'topState' => 0,'isDelete' => 0));
		if (false === $check)
		{
			self::$errCode = IRetailerProductDao::$errCode;
			self::$errMsg = IRetailerProductDao::$errMsg;

			return false;
		}
		if (count($check) <= 0)
		{
			self::$errCode = 414;
			self::$errMsg = 'product is not exist or have been toped';

			return false;
		}
		if ($check[0]['shelveState'] != 1)
		{
			self::$errCode = 410;
			self::$errMsg = 'can not top, need to shelve the product';

			return false;
		}

        /**
         * ��ѯ�ö�����
         */
		$total_count = IRetailerProductDao::getRows(
								 	 array('retailerId' => $retailerId),
									 array('shelveState' => 1,'topState' => 1,'isDelete' => 0));
		if (false === $total_count)
		{
			self::$errCode = IRetailerProductDao::$errCode;
			self::$errMsg = IRetailerProductDao::$errMsg;

			return false;
		}
		/**
		 * �������ö�������ȡ�� �����ö�����Ʒ
		 */
		if (count($total_count) >= $count)
		{
			$pids = array();
			$index = 0;
			$iter = count($total_count) - 1;
			while ($iter >= 0)
			{

				if ($index > count($total_count)-$count)
				{
					break;
				}
				$pids[$index] = $total_count[$iter]['productId'];
				$index ++;
				$iter --;
			}
			$update_data = array(
				'topState' => '0',
				'retailerId' => $retailerId,
				'productIds' => $pids
			);
			$result = self::updateProduct($update_data,array());
			if (false === $result)
			{
				self::$errCode = IRetailerProductDao::$errCode;
				self::$errMsg = IRetailerProductDao::$errMsg;

				return false;
			}

		}
		$data['retailerId'] = $retailerId;
		$result = self::updateProduct($data,array('productId' => $productId));
		if (false === $result)
		{
			self::$errCode = IRetailerProductDao::$errCode;
			self::$errMsg = IRetailerProductDao::$errMsg;

			return false;
		}

		return true;
	}


	/**
	 * �۸��ʽת��
	 */
	public static function convertToString($price)
	{
		return sprintf("%.2f",intval($price)/100.00);
	}

	/**
	 * �������ۼ�
	 */
	public static function calculateSailPrice($price,$type,$value)
	{
		$sail_price = intval($price);
		if (PRICE_TYPE_VALUE == $type) //ֵ��
		{
			$sail_price = intval($price) + intval($value);
		}
		if (PRICE_TYPE_PERCENT == $type) //�ٷֱ�
		{
			$sail_price = intval(intval($price) * ((100 + $value)/100));
		}
		return self::trimStandardPrice($sail_price);
	}

	/**
	 * �۸�Ĩ�����
     *  1��С�ڵ���30Ԫ��Ʒ���Էֽ����������룻 2902=>2900,2905=>2910
     *  2������30ԪС��100Ԫ��Ʒ����ȥ���֣� 4998=>4990
     *  3������100Ԫ��Ʒ��ȥ���ǣ�     20330=>20300
	 */
	public static function trimStandardPrice($oldprice_)
	{
// 	   $_oldprice = intval($oldprice_);
// 	   $_newprice = 0;
// 	   if ($_oldprice <= 3000)
// 	   {
// 	   	   $_newprice = intval(round($_oldprice, -1));
// 	   }
// 	   else if($_oldprice < 10000)
// 	   {
// 	       $_newprice = intval($_oldprice / 10) * 10;
// 	   }
// 	   else
// 	   {
// 	       $_newprice = intval($_oldprice / 100) * 100;
// 	   }

	   return $oldprice_;
	}

}
