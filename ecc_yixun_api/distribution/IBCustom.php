<?php

//分销商客户类
class IBCustom
{
	public static $DBName = "retailer";
	public static $tableName = "t_customer_order_relation";
	public static $errCode=0;
	public static $errMsg="";
	
		
	//按条件搜索该分销商所拥有的客户总数
	public static function getTotal($retailer_id)
	{
		if (!isset($retailer_id) || $retailer_id <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "retailer_id[$retailer_id] is empty";
			return false;
		}
		
		$db_tab_index = ToolUtil::getUserDBTableIndex($retailer_id,'retailer_customer');
		$orderDb = ToolUtil::getDBObj('retailer_customer', $db_tab_index['db']);
	
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		$where="retailerId={$retailer_id}";
		$total=$orderDb->getRowsCount("t_retailer_customer_{$db_tab_index['table']}",$where);
		return $total;
		
	}
	
	//得到特定页面的数据
	public static function getCustomPage($retailer_id,$conditions,$pageNo,$pageSize=5)
	{
		$Total=0;
		$returnData = false;
		$startIndex = $pageSize * ($pageNo - 1);
		if (!isset($retailer_id) || $retailer_id <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "retailer_id[$retailer_id] is empty";
			return false;
		}
		
		//where条件
		$where="";
		$ID="";
		//如果条件查询中有输入订单编号
		if(!empty($conditions['orderCharId']))
		{
			$MSDB = ToolUtil::getDBObj(self::$DBName); 
			if ($MSDB == false) 
			{
				self::$errCode = -4001;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "链接数据库失败";
				return false;
			}
			$sql="select * from t_customer_order_relation where orderCharId='{$conditions['orderCharId']}'";
			$ret=$MSDB->getRows($sql);
			if($ret)
			{
				$ID=$ret[0]['retailerId'];
				//$QQ=$ret[0]['qq'];
				$Mobile=$ret[0]['mobile'];
				
			
				
				//判断用户名、手机号、QQ号是否为空
				if(!empty($conditions['name']))
				{
					$where="name='{$conditions['name']}'";
				}
				if(!empty($conditions['qq']))
				{
					if($where)
					{
						$where=$where." and qq={$conditions['qq']}";
					}
					else
					{
						$where="qq={$conditions['qq']}";
					}
					
				}
				if(!empty($conditions['mobile']))
				{
					if($where)
					{
						$where=$where." and mobile={$conditions['mobile']}";
					}
					else
					{
						$where="mobile={$conditions['mobile']}";
					}
					
				}
				if($where)
				{
					$where=$where." and retailerId={$ID} and mobile='{$Mobile}'";
				} 
				else
				{
					$where="retailerId={$ID} and mobile='{$Mobile}'";
				}
				

				$db_tab_index = ToolUtil::getUserDBTableIndex($retailer_id);
				$orderDb = ToolUtil::getDBObj('retailer_customer', $db_tab_index['db']);
				if (empty($orderDb))
				{
					self::$errCode = $orderDb->errCode;
					self::$errMsg = $orderDb->errMsg;
					return false;
				}
				$sql="select * from t_retailer_customer_{$db_tab_index['table']} where ".$where;
				$ret=$orderDb->getRows($sql);
				
				if($ret)
				{
					$returnData['data'] = $ret;
					$Total=1;
					$returnData['count'] = $Total;
				}
				
			}	
		}
		else
		{
			//默认输入的订单号为空，判断用户名、手机号、QQ号是否为空
			if(!empty($conditions['name']))
			{
				$where="name='{$conditions['name']}'";
			}
			if(!empty($conditions['qq']))
			{
				if($where)
				{
					$where=$where." and qq={$conditions['qq']}";
				}
				else
				{
					$where="qq={$conditions['qq']}";
				}
				
			}
			if(!empty($conditions['mobile']))
			{
				if($where)
				{
					$where=$where." and mobile={$conditions['mobile']}";
				}
				else
				{
					$where="mobile={$conditions['mobile']}";
				}
				
			}
			if($where)
			{
				$where=$where." and retailerId={$retailer_id} LIMIT {$startIndex},{$pageSize}";
			}
			else
			{
				$where="retailerId={$retailer_id} LIMIT {$startIndex},{$pageSize}";
			}
			
			
			$db_tab_index = ToolUtil::getUserDBTableIndex($retailer_id);
			$orderDb = ToolUtil::getDBObj('retailer_customer', $db_tab_index['db']);
			if (empty($orderDb))
			{
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				return false;
			}
			$sql="select * from t_retailer_customer_{$db_tab_index['table']} where ".$where;
			$ret=$orderDb->getRows($sql);
			$Total=$orderDb->getRowsCount("t_retailer_customer_{$db_tab_index['table']}",$where);
			if($ret)
			{
				$returnData['data'] = $ret;
				$Total=$orderDb->getRowsCount("t_retailer_customer_{$db_tab_index['table']}",$where);
				$returnData['count'] = $Total;
			}
		}
		return $returnData;
		
	}
	
	//得到特定订单列表页面的数据
	public static function getorderlistPage($retailer_id,$conditions,$pageNo,$pageSize=5)
	{
		$Total=0;
		$startIndex = $pageSize * ($pageNo - 1);
		$newitem=array();
		$MSDB = ToolUtil::getDBObj(self::$DBName); 
			if ($MSDB == false) 
			{
				self::$errCode = -4001;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "链接数据库失败";
				return false;
			}
			$condtion="mobile='{$conditions['mobile']}'";
			$Total=$MSDB->getRowsCount(self::$tableName,$condtion);
			
		$ret=IRetailerCustomerMapTTC::get($retailer_id,array('mobile' =>$conditions['mobile']),"",$pageSize,$startIndex);
		foreach ($ret as $item)
		{
			$items=IOrder::getOneOrderDetail($item['retailerId'],$item['orderCharId']);
			if($items)
			{
				$statue="-";
				switch ($items['status'])
					{
					case -5:
					  $statue="部分退货";
					  break;  
					case -4:
					  $statue="全部退货";
					  break; 
					case -3:
					  $statue="系统作废";
					  break; 
					case -2:
					  $statue="客户作废";
					  break; 
					case -1:
					  $statue="员工作废";
					  break; 
					case 0:
					  $statue="待审核";
					  break; 
					case 1:
					  $statue="待出库";
					  break; 
					case 2:
					  $statue="待支付";
					  break; 
					case 3:
					  $statue="待主管审";
					  break; 
					case 1:
					  $statue="已出库";
					  break; 
					default:
					  $statue="-";
					}
				$cost=sprintf("%.2f", $items['order_cost']/100);
				$_order_date=date("Y-m-d H:i:s",$items['order_date']);
				$_items=array(
				'order_char_id' =>	$items['order_char_id'],
				'order_date'  =>	$_order_date,
				'order_cost'   =>	$cost,
				'status'       =>	 $statue,
				);
				$newitem[]=$_items;
			}
		
		}
	$ret=$newitem;
	$returnData['data'] = $ret;
	$returnData['count'] = $Total;	
	return $returnData;
				
	}
	
	public static function addAll($customer_order,$customer)
	{
		$retailer_customer_order=$customer_order;
		
		$retailer_customer=$customer;
		$retailerId=$retailer_customer_order['retailerId'];
		$orderCharId=$retailer_customer_order['orderCharId'];
		$_retailerId=$retailer_customer['retailerId'];
		$mobile=$retailer_customer['mobile'];
		$ret=IRetailerCustomerMapTTC::get($retailerId,array('orderCharId' => $orderCharId));
		if($ret)
		{
			return array('error'=> 1,'data' => '订单号已经存在，请重新输入！');
		}
		else
		{
			$ret=IRetailerCustomerTTC::get($_retailerId,array('mobile' => $mobile));
			if($ret)
			{
				return array('error'=> 2,'data' => '该客户已经存在，请重新输入！');
			}
			else
			{
				$ret_1=IRetailerCustomerMapTTC::insert($retailer_customer_order);
				$ret_2=IRetailerCustomerTTC::insert($retailer_customer);
				if($ret_1&&$ret_2)
				{
					return array('error'=> 0,'data' => '');
				}
				else
				{
					return array('error'=> 3,'data' => '添加失败，请重新添加');
				}
				
			}
		}
	}

	public static function addAllNotOrder($customer)
	{
		$retailer_customer=$customer;
		$_retailerId=$retailer_customer['retailerId'];
		$mobile=$retailer_customer['mobile'];
		$ret=IRetailerCustomerTTC::get($_retailerId,array('mobile' => $mobile));
		if($ret)
		{
			return array('error'=> 2,'data' => '该客户已经存在，请重新输入！');
		}
		else
		{
			$ret=IRetailerCustomerTTC::insert($retailer_customer);
			if($ret)
			{
				return array('error'=> 0,'data' => '');
			}
			else
			{
				return array('error'=> 3,'data' => '添加失败，请重新添加');
			}
		}
	}
	
	
	public static function addreation($uid,$orderID,$mobile,$shopId=0)
	{
		$ret=IRetailerCustomerMapTTC::get($uid,array('orderCharId' => $orderID));
		if($ret)
		{
			EL_Flow::getInstance("ipad_customer")->append('订单号已经存在，请重新输入');
			return array('error'=> 1,'data' => '订单号已经存在，请重新输入！');
		}
		else
		{
			//存储关系表
			$retailer_customer_order=array(
								'retailerId' =>  $uid,
								'mobile' =>  $mobile,
								'phone' =>  '0',
								'orderCharId' => $orderID,
								);						
			$ret_1=IRetailerCustomerMapTTC::insert($retailer_customer_order);
			
			$ret_customer=IRetailerCustomerTTC::get($uid,array('mobile' => $mobile));	
			$orders=$ret_customer[0]['orders'];
			if(empty($orders))
			{
				$orders=$orderID;
			}
			else
			{
				$orders=$orders.":".$orderID;
			}
			EL_Flow::getInstance("ipad_customer")->append(var_export($ret_customer[0],true));
				//存储客户信息表
			$retailer_customer=	array(
									'retailerId' =>  $ret_customer[0]['retailerId'],
									'name' => isset($retailer_customer['name'])?$retailer_customer['name']:$ret_customer[0]['name'],
									'qq' =>  isset($retailer_customer['qq'])?$retailer_customer['qq']:$ret_customer[0]['qq'],
									'phone' =>isset($retailer_customer['phone'])?$retailer_customer['phone']:$ret_customer[0]['phone'],
									'district' => isset($retailer_customer['district'])?$retailer_customer['district']:$ret_customer[0]['district'],
									'address' => isset($retailer_customer['address'])?$retailer_customer['address']:$ret_customer[0]['address'],
									'zipcode' => isset($retailer_customer['zipcode'])?$retailer_customer['zipcode']:$ret_customer[0]['zipcode'],
									'updateTime' =>  time(),
									'orders' => $orders,
									);
			$ret_2=IRetailerCustomerTTC::update($retailer_customer,array('mobile' => $mobile));
			EL_Flow::getInstance("ipad_customer")->append('updage IRetailerCustomerTTC');
			EL_Flow::getInstance("ipad_customer")->append(var_export($ret_2,true));
			/**
			 * 插入c客户登陆表
			 */
			$account = IRetailerAccountTTC::get($uid,array('account'=>$mobile));
			EL_Flow::getInstance("ipad_customer")->append(var_export($account,true). 'get c 客户');
			if (!empty($account)){
				$retAcc = IRetailerAccountTTC::update(array('retailerId'=>$uid,
										'name'=>$retailer_customer['name'],
										'shopId' => $shopId,
										'updatetime'=>time()),
						array('account'=>$mobile));
				EL_Flow::getInstance("ipad_customer")->append('update account');
			}
			else {
				$acc = array(
						'retailerId' =>  $uid,
						'name' => $retailer_customer['name'],
						'account' => $mobile,
						'password' => 'ejs',
						'status' =>  1,
						'createtime' =>  time(),
						'updatetime' =>  time(),
						'shopId'  => $shopId
				);
				$retAcc = IRetailerAccountTTC::insert($acc);	 //插入登录记录信息\
				
				EL_Flow::getInstance("ipad_customer")->append(IRetailerAccountTTC::$errMsg . var_export($acc,true));
			}
			
			EL_Flow::getInstance("ipad_customer")->append(var_export($retAcc,true));
			
			if($ret_1&&$ret_2 && $retAcc)
			{
				//将客户信息绑定到预订单中
				$coupon_code = array(
				        'uid' => $uid,
				        'coupon_code' => $mobile);
				$filter = array('real_order_id' => $orderID);
				IBOrdersTTC::update($coupon_code,$filter);
				
				return array('error'=> 0,'data' => '');
			}
			else
			{
				return array('error'=> 3,'data' => '添加失败，请重新添加');
			}
		}
	}
	
	
	public static function delreation($uid,$orderID,$mobile)
	{
		$ret=IRetailerCustomerMapTTC::get($uid,array('orderCharId' => $orderID));
		if($ret)
		{
			$ret_1=IRetailerCustomerMapTTC::remove($uid,array('orderCharId' => $orderID));
			$ret_customer=IRetailerCustomerTTC::get($uid,array('mobile' => $mobile));
			$orders=$ret_customer[0]['orders'];
			$sub_str_1=":".$orderID.":";
			$sub_str_2=":".$orderID;
			$sub_str_3=$orderID.":";
			$sub=strpos($orders,":");
			if($sub == false)
			{
				$orders="";
			}
			else
			{
				$sub_1=strpos($orders,$sub_str_1);
				$sub_2=strpos($orders,$sub_str_2);
				$sub_3=strpos($orders,$sub_str_3);
				
				if($sub_1 != false)
				{
					$orders=str_replace($sub_str_3,"",$orders);
				}
				else if($sub_2 != false)
				{

					$orders=str_replace($sub_str_2,"",$orders);
				}
				else if(($sub_3 != false)||($sub_3 == 0))
				{
					$orders=str_replace($sub_str_3,"",$orders);
				}
				
			}
			
				//存储客户信息表
			$retailer_customer=	array(
									'retailerId' =>  $ret_customer[0]['retailerId'],
									'name' => $ret_customer[0]['name'],
									'qq' =>  $ret_customer[0]['qq'],
									'mobile' => $ret_customer[0]['mobile'],
									'phone' => '',
									'district' =>  0,
									'address' => $ret_customer[0]['address'],
									'zipcode' => '1234',
									'status' =>  1,
									'isDelete' =>  0,
									'createTime' =>  $ret_customer[0]['createTime'],
									'updateTime' =>  time(),
									'orders' => $orders,
									);
									
			$ret_2=IRetailerCustomerTTC::update($retailer_customer,array('mobile' => $mobile));
			if($ret_1&&$ret_2)
			{
				return array('error'=> 0,'data' => '');
			}
			else
			{
				return array('error'=> 3,'data' => '取消关联失败，请稍后再试');
			}
			
		}
		else
		{
			return array('error'=> 7,'data' => '表中不存在该订单号，不需要取消，请重新输入！');
		}
	}
	
	/**
	 * 分销商添加新c客户
	 * key mobile 存在则更新，不存在则插入 
	 * 
	 * @param  $customer=array()  
	 * @return true : false
	 */
    public static function add($customer,$shopId=0)
    {
        $retailer_customer = $customer;
        $_retailerId = $retailer_customer['retailerId'];
        $mobile = $retailer_customer['mobile'];
        $ret = IRetailerCustomerTTC::get($_retailerId,array('mobile' => $mobile));
        if($ret)
        {
        	$updateData = array(
        	   'retailerId'=> $_retailerId,
        	   'name' => isset($customer['name'])?$customer['name']:'',
        	   'address' => isset($customer['address'])?$customer['address']:'',
        	   'mobile' => isset($customer['mobile'])?$customer['mobile']:'',
        	   'phone' => isset($customer['phone'])?$customer['phone']:'',
        	   'qq' => isset($customer['qq'])?$customer['qq']:'',
        	);

            $update = IRetailerCustomerTTC::update($updateData,array('mobile' => $updateData['mobile']));
            if (false === $update)
            {
            	self::$errCode = IRetailerCustomerTTC::$errCode;
            	self::$errMsg = IRetailerCustomerTTC::$errMsg;
            	EL_Flow::getInstance("ipad_customer")->append( IRetailerCustomerTTC::$errMsg);
            	return false;
            }
        }
        else
        {
            $insert = IRetailerCustomerTTC::insert($customer);
            if (false === $insert)
            {
                self::$errCode = IRetailerCustomerTTC::$errCode;
                self::$errMsg = IRetailerCustomerTTC::$errMsg;
                EL_Flow::getInstance("ipad_customer")->append( IRetailerCustomerTTC::$errMsg);
                return false;	
            }
        }
        
        /**
         * 插入c客户登陆表
         */
        EL_Flow::getInstance("ipad_customer")->append('begin insert account');
        $account = IRetailerAccountTTC::get($_retailerId,array('account'=>$mobile));
        if (!empty($account) && isset($customer['name'])){
        	$retAcc = IRetailerAccountTTC::update(array('retailerId'=>$_retailerId,'name'=>$customer['name']),
        			array('account'=>$mobile));
        	EL_Flow::getInstance("ipad_customer")->append('IRetailerAccountTTC::update');
        }
        else {
        	$acc = array(
        			'retailerId' =>  $_retailerId,
        			//'uid' =>  XXX,
        			'name' =>  isset($customer['name'])?$customer['name']:'',
        			'account' => $mobile,
        			'password' => 'ejs',
        			'status' =>  1,
        			'createtime' =>  time(),
        			'updatetime' =>  time(),
        			'shopId'  => $shopId
        	);
        	$retAcc = IRetailerAccountTTC::insert($acc);	 //插入登录记录信息
        	EL_Flow::getInstance("ipad_customer")->append(IRetailerAccountTTC::$errMsg . var_export($acc,true));
        }
        
        return true;
    }
    
    /**
     * 分销商查询c客户
     * key mobile 存在则更新，不存在则插入 
     * 
     * @param  int $retailerId
     * @param  string $mobile
     * @return true : false
     */
    public static function get($retailerId, $mobile)
    {
        $ret = IRetailerCustomerTTC::get($retailerId,array('mobile' => $mobile),array('name','qq','mobile','phone','address'));
        if (false === $ret)
        {
        	self::$errCode = IRetailerCustomerTTC::$errCode;
            self::$errMsg = IRetailerCustomerTTC::$errMsg;
                
            return false;   
        }

        return $ret;
    }
    
    /**
     * 由c客户手机查询绑定的订单号
     */
    public static function getOrderIdByMobile($mobile,$page=1,$pageSize=24)
    {
    	$filterMobile = ToolUtil::filterInput($mobile);
$sql = <<< SQL
   SELECT count(*) AS total
   FROM  t_customer_order_relation
   WHERE mobile = {$filterMobile}    
SQL;
        $db = ToolUtil::getDBObj(self::$DBName); 
        if (false == $db)
        {
            self::$errCode = ToolUtil::$errCode;
            self::$errMsg = ToolUtil::$errMsg;
            
            return false;
        }
        $ret = $db->getRows($sql);
        if (false == $ret)
        {
            self::$errCode = $db->errCode;
            self::$errMsg = $db->errMsg;
            
            return false;
        }
        $total = $ret[0]['total'];
        if (0 == $total)
        {
            return array('total'=>0, 'list' => array());
        }
        $begin = ($page-1) * $pageSize;
$sql = <<< SQL
   SELECT orderCharId ,mobile,retailerId
   FROM  t_customer_order_relation
   WHERE mobile = {$filterMobile}   
   LIMIT {$begin} , {$pageSize}
SQL;

        $ret = $db->getRows($sql);
        if (false == $ret)
        {
            self::$errCode = $db->errCode;
            self::$errMsg = $db->errMsg;
            
            return false;
        }
        
        return array('total' => $total,'list' => $ret);
    }
}
