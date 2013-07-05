<?php
class LIB_DataMaintain {
    public static $errCode = 0;
    public static $errMsg = '';
    public static $timebetween = array(1 => '三个月内', 2 => '三个月之前'); //时间状态
    public static $Customer_Type = array(22 => '分销批发商', 23 => '分销零售商', 24 => '分销连锁商', 25 => '分销平台商'); //启用状态
    public static function getList($filter=array(),$currentPage=1,$pageSize=24)
    {
       $data= self::_getWhereSQL($filter);
      
       if(!empty($data['whereSql']))
       {
           $condition = $data['whereSql'];
           $begin = ($currentPage - 1) * $pageSize;
           $end = $currentPage * $pageSize;
           if(($data['customtable'])||($data['so_master']))
           {
               $erpDb = Config::getMSDB('Customer');
               if (false === $erpDb)
               {
                   Logger::err("getList_Customer_error");
                   Logger::err(Config::$errCode);
                   Logger::err(Config::$errMsg);
                   self::$errCode = Config::$errCode;
                   self::$errMsg = Config::$errMsg; 
                   return false;
               }
                   $sql = <<<SQL
SELECT COUNT(*) AS total
FROM Customer left join CustomerMangeMapInfo on Customer.CustomerID=CustomerMangeMapInfo.CustomerID
WHERE {$condition} 
SQL;

        $result = $erpDb->getRows($sql);
        if (false === $result)
        {
            Logger::err("getList_1_result_1");
            Logger::err(Config::$errCode);
            Logger::err(Config::$errMsg);
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;
            
            return false;
        }
        $total = intval($result[0]['total']);

                   
                   $sql = <<<SQL
SELECT * FROM 
(
    SELECT 
	    Customer.RegisterTime,
	    Customer.CustomerID,
	    Customer.CustomerName,
	    Customer.Status,
	    CustomerMangeMapInfo.ManagerID,
	    CustomerMangeMapInfo.ManagerName,
	    CustomerMangeMapInfo.SysNo,
	    CustomerMangeMapInfo.CustomerType,
	    Customer.SysNo as CustomerSyNo,
	    row_number() over (order by Customer.RegisterTime desc) rn
     FROM 
         Customer left join CustomerMangeMapInfo on Customer.CustomerID=CustomerMangeMapInfo.CustomerID
     WHERE {$condition} 
) temp
WHERE 
    rn > {$begin} and rn <= {$end}    
SQL;

       $ret = $erpDb->getRows($sql);
       if (false === $ret)
       {
           Logger::err("getList_1_result_2");
           Logger::err(var_export($sql,true));
           Logger::err($erpDb->errMsg);
           self::$errCode = $erpDb->errCode;
           self::$errMsg = $erpDb->errMsg;
            
           return false;
       }
       
       foreach($ret as &$item)
	   {
	       if(empty($item['RegisterTime']))
		   {
		       $item['RegisterTime']="---";
		   }
		   else
		   {
		       $item['RegisterTime'] = date('Y-m-d H:i:s',strtotime($item['RegisterTime']));
		   }
	   }
        return array('data' => $ret, 'total' => $total);         
       }
       else if($data['custommanmap'])
       {
           $erpDb = Config::getMSDB('Customer');
           if (false === $erpDb)
           {
              Logger::err("custommanmap_error1");
              Logger::err(Config::$errCode);
              Logger::err(Config::$errMsg);
               self::$errCode = Config::$errCode;
               self::$errMsg = Config::$errMsg; 
               return false;
           }
           
           $sql = <<<SQL
SELECT COUNT(*) AS total
FROM Customer , CustomerMangeMapInfo
WHERE Customer.CustomerID=CustomerMangeMapInfo.CustomerID and {$condition} 
SQL;

       $result = $erpDb->getRows($sql);
           if (false === $result)
           {
               Logger::err("getList_1_result_3");
               Logger::err(Config::$errCode);
               Logger::err(Config::$errMsg);
               self::$errCode = $erpDb->errCode;
               self::$errMsg = $erpDb->errMsg;
                
               return false;
            }
            $total = intval($result[0]['total']);
            
           $sql = <<<SQL
SELECT * FROM 
(
    SELECT 
	    Customer.RegisterTime,
	    Customer.CustomerID,
	    Customer.CustomerName,
	    Customer.Status,
	    CustomerMangeMapInfo.ManagerID,
	    CustomerMangeMapInfo.ManagerName,
	    CustomerMangeMapInfo.SysNo,
	    CustomerMangeMapInfo.CustomerType,
	    Customer.SysNo as CustomerSyNo,
	    row_number() over (order by Customer.RegisterTime desc) rn
     FROM 
         Customer,CustomerMangeMapInfo
     WHERE Customer.CustomerID=CustomerMangeMapInfo.CustomerID and {$condition} 
) temp
WHERE 
    rn > {$begin} and rn <= {$end}    
SQL;

       $ret = $erpDb->getRows($sql);
       if (false === $ret)
       {
           Logger::err("getList_1_result_4");
           Logger::err(Config::$errCode);
           Logger::err(Config::$errMsg);
           self::$errCode = $erpDb->errCode;
           self::$errMsg = $erpDb->errMsg;
            
           return false;
       }
       
       foreach($ret as &$item)
	   {
	       if(empty($item['RegisterTime']))
		   {
		       $item['RegisterTime']="---";
		   }
		   else
		   {
		       $item['RegisterTime'] = date('Y-m-d H:i:s',strtotime($item['RegisterTime']));
		   }
	   }
        return array('data' => $ret, 'total' => $total);
       }
     //  else if($data['so_master'])
    //   {
    //   }
       }
       else 
       {
           return array('data' => '', 'total' => 0);
       }

        
    }
    
    
     /**
	 * 
	 * 返回某客户的所有历史订单
	 * @author kevinhong
	 * @param $pid CustomerSyNo
	 * @return 所有历史订单
	 */
     public static function order_showOrder($CustomerSyNo, $timebetween,$ManagerName) {
        global $_PAY_MODE;
        $ManagerName=iconv('utf-8','gb2312',$ManagerName);
        if($CustomerSyNo <= 0)
		{
			self::$errCode = 61;
			self::$errMsg  = '指定客户系统编号不符合要求';
			return '';
		}
		$starttime = '';
		$endtime = '';
		$filter_info = array();
     	if($timebetween == 1)
     	{
     	    $starttime = date('Y-m-d', strtotime("-3 month"));
		    $endtime = date("Y-m-d").' 23:59:59';;
     	}
     	else 
     	{
     	   // $starttime = date('Y-m-d', strtotime("-3 month"));
		    $endtime = date('Y-m-d', strtotime("-3 month"));
     	}
     	
       $erpDb = Config::getMSDB('ERP_1');
       if (false === $erpDb)
       {
            Logger::err("ERP_1_error1");
            Logger::err(Config::$errCode);
           Logger::err(Config::$errMsg);
           self::$errCode = Config::$errCode;
           self::$errMsg = Config::$errMsg; 
           return false;
       }
		
       $sql = <<<SQL
SELECT SOID,ReceiveName,ReceiveCellPhone,PayPrice,OrderDate,Status,PayTypeSysNo
FROM SO_Master
WHERE CustomerSysNo={$CustomerSyNo} and OrderDate >= "{$starttime}" and OrderDate <= "{$endtime}"
SQL;



     $ret = $erpDb->getRows($sql);
       if (false === $ret)
       {
           Logger::err("getList_1_result_5");
           Logger::err(Config::$errCode);
           Logger::err(Config::$errMsg);
           self::$errCode = $erpDb->errCode;
           self::$errMsg = $erpDb->errMsg;
            
           return false;
       }
       if(empty($ret))
       {
           return '';
       }
       else 
       {
           $order_list = array();
		   $order_info = array();
     
			$k = 0;
			$outStatus = array(-8 => "待商家审核", -7 => "待经理审核", -6 => "待总监审核", -5 => "部分退货",
			                   -4 => "全部退货", -3 => "系统作废",-2 => "客户作废",-1 => "员工作废",
			                    0 => "待审核",1 => "待出库", 2 => "待支付",3 => "待主管审",4 => "已出库");
			                    
           $_payMode = '';
	    
			foreach ($ret as $r) {
		        foreach($_PAY_MODE[1] AS $key => $arr)
				{
					if ($r['PayTypeSysNo'] == $key)
					{
					   $_payMode = $arr['PayTypeName'];
					}
				}
			    
			    $order_info[$k]['SOID'] = $r['SOID'];
			    $order_info[$k]['ReceiveName'] = $r['ReceiveName'];
			    $order_info[$k]['ReceiveCellPhone'] = $r['ReceiveCellPhone'];
			    $order_info[$k]['PayPrice'] = $r['PayPrice'];
			    $order_info[$k]['ManagerName'] = $ManagerName;//iconv('utf-8','gb2312',$ManagerName);
			    $order_info[$k]['OrderDate'] = date('Y-m-d H:i:s',strtotime($r['OrderDate']));//date("Y-m-d H:i:s",$r['OrderDate']);
			    $order_info[$k]['Status'] = $outStatus[$r['Status']]; //$r['Status'];
			    $order_info[$k]['PayTypeSysNo'] = $_payMode;// $r['PayTypeSysNo'];
			    $k++;    
			}
          
       }
       $order_infos['Rows'] = $order_info;
       return $order_infos;


     	
     	
		$filter = array('pid' => $pid, 'status' => 1);
		$rs = IAdMapTTC::get(IAdMap::$key, $filter);
		if($rs === false) {
		    Logger::err("getList_1_result_6");
			self::$errCode = 62;
			self::$errMsg  = '从Map表中提取投放信息失败';
			return '';
		}			
		$ad_list = array();
		$ad_info = array();
		if(count($rs)) {
			global $_Wh_id;
			foreach($rs as $k => $v) {
				$ad_list[] = $v['aid'];
			}
			rsort($ad_list);
			$k = 0;
			foreach ($rs as $r) {
				$filter_info['aid'] = $r['aid'];
				$rs_info = IAdInfoTTC::get(IAdInfo::$key, $filter_info);
				if($rs_info === false) {
					self::$errCode = 63;
					self::$errMsg  = '从info表中提取广告信息失败';
					return '';
				}
				if(count($rs_info)) {
					$v = $rs_info[0];
				} else {
					continue;
				}
				//筛选时间
				if($starttime) {
					if(date("Y-m-d H:i:s",strtotime($v['starttime'])) > $starttime) {
						continue;
					} 					
				}
				if($endtime) {
					if(date("Y-m-d H:i:s",strtotime($v['endtime'])) < $endtime) {
						continue;
					} else if(!$starttime) {
						if(date("Y-m-d H:i:s",strtotime($v['starttime'])) > $endtime) {
							continue;
						}
					}					
				}
				//$ad_info[$k] = $v;
				$ad_info[$k]['aid'] = $v['aid'];
				$ad_info[$k]['name'] =   empty($v['name']) ? '-' : '<a title="'.$v['name'].'">'.$v['name'].'</a>';
				$ad_info[$k]['status'] = Tools::get_select($v['aid'], self::$status, '', $v['status'], false, 'onChange="updateStatus('.$v['aid'].')"');
				$ad_info[$k]['date'] = date("Y-m-d H:i",strtotime($v['starttime'])).' - '.date("Y-m-d H:i",strtotime($v['endtime']));
				$ad_info[$k]['content'] =  empty($v['content']) ? '-' : '<p title="'.$v['content'].'">'.$v['content'].'</p>';
				if(empty($v['content'])) { //获得图片广告宽度和高度
					if(!empty($v['adurl'])) {
						//取出宽屏图片大小
						$img_info =  explode('/',$v['adurl']);
						$img_name = end($img_info);
						$date = array_slice($img_info,-2,1);
						$time = $date[0];
						$str=getimagesize(PUBLISH_IMAGE_ROOT . 'ad/adinfo/'.$time.'/'.$img_name);
						$mode="/width=\"(.*)\" height=\"(.*)\"/";
						preg_match($mode,$str[3],$arr);
						$width   = $arr[1]; //宽屏宽度
						$height  = $arr[2]; //宽屏高度
					}
					//若已上传窄屏图片，取出窄屏图片大小
					if(!empty($v['adurl2'])) {
						$img_info2 =  explode('/',$v['adurl2']);
						$img_name2 = end($img_info2);
						$date2 = array_slice($img_info2,-2,1);
						$time2 = $date2[0];
						$str2=getimagesize(PUBLISH_IMAGE_ROOT . 'ad/adinfo/'.$time2.'/'.$img_name2);						
						preg_match($mode,$str2[3],$brr);				
						$width2  = $brr[1]; //窄屏宽度
						$height2 = $brr[2]; //窄屏高度
					}
				}
				$ad_id =  'k'.$v['aid'];
				$ad_id2 = 'z'.$v['aid'];
				$ad_info[$k]['adurl'] = empty($v['adurl']) ? '-' : '<a id="'.$ad_id.'" target="_blank" href="' . $v['adurl'] . '" onmouseover="showImg(\''.$ad_id.'\','.$width.','.$height.')" onmouseout="hideImg()">' . $v['adurl'] . '</a>';
				$ad_info[$k]['adurl2'] = empty($v['adurl2']) ? '-' : '<a id="'.$ad_id2.'" target="_blank" href="' . $v['adurl2'] . '" onmouseover="showImg(\''.$ad_id2.'\','.$width2.','.$height2.')" onmouseout="hideImg()">' . $v['adurl2'] . '</a>';
				$ad_info[$k]['adurl_'] = $v['adurl'];
				$ad_info[$k]['adurl2_'] = $v['adurl2'];
				$ad_info[$k]['url'] = empty($v['url']) ? '-' : '<a title="' . $v['url'] . '" target="_blank" href="' . $v['url'] . '">' . $v['url'] . '</a>';
				$ad_info[$k]['user_name'] = Tools::get_user_name($v['user_id']);
				$ad_info[$k]['site_id'] = $r['site_id'];
				$ad_info[$k]['site'] = $_Wh_id[$r['site_id']];
				$k++;
			}				
		}
		$ad_infos['Rows'] = $ad_info;
		echo self::$errMsg;
		return $ad_infos;
     }
     
     
	/**
	 * 解除客户经理绑定
	 * @author kevinhong
	 * @param $SysNo 分销经理ID
	 * @return 解除结果信息
	 */
	public static function remove_item($SysNo) {
		if (!$SysNo) {
			self::$errCode = 31;
			self::$errMsg = "获取绑定客户经理ID失败";
			return array('result' => false, 'errMsg' => '获取绑定客户经理ID失败');
		}
	    $erpDb = Config::getMSDB('Customer');

        if (false === $erpDb){
            Logger::err("remove_item_error1");
            Logger::err(Config::$errCode);
            Logger::err(Config::$errMsg);
           self::$errCode = 32;
           self::$errMsg = "网络繁忙，请稍后再试";
           return array('result' => false, 'errMsg' => '获取绑定客户经理ID失败');
        }

        $ret = $erpDb->getRows("select * from CustomerMangeMapInfo where SysNo=" . $SysNo) ;
        if (false === $ret){
        	self::$errCode = $erpDb->errCode;
        	self::$errMsg = basename(__FILE__, '.php') . " | Line: \n_update (" . $data['icsonid'] . ") info to userMysql faild:". $erpDb->errMsg;
        	Logger::err(self::$errMsg);
        	return false;
        }
        if (!is_array($ret)){
        	return array('result' => false, 'errMsg' => '获取绑定记录失败');
        }
        $retailers = IRetailer::getRetailers(array('icsonid'=>$ret[0]['CustomerID']));
        if (empty($retailers)){
        	return array('result' => false, 'errMsg' => '获取分销商记录失败');
        }
        $retailers = current($retailers);
        $condtion = "SysNo = {$SysNo}";
        $result = $erpDb->remove("CustomerMangeMapInfo", $condtion);
        if (false === $result){
            Logger::err("getList_1_result_7");
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;   
            return array('result' => false, 'errMsg' => '解除绑定失败');
        }
        
        $updateData = array(
        			'uid' => $retailers['uid'],
        			'bindManager' => '',
        			'editTime' => time()
        		);
        IRetailerTTC::update($updateData,array('icsonid'=>$ret[0]['CustomerID']));
           
		return array('result' => true);
	}
	
/**
	 * 客户经理绑定
	 * @author kevinhong
	 * @param $CustomerID 客户ID
	 * @param $managerId 客户经理ID
	 * @param $mname 客户经理Name
	 * @return 解除结果信息
	 */
	public static function add_item($CustomerID,$managerId,$mname,$Customer_Type) {
	    /*
		if (!$CustomerID) 
		{
			self::$errCode = 31;
			self::$errMsg = "获取绑定客户ID失败";
			return array('result' => false, 'errMsg' => '获取绑定客户ID失败');
		}
		*/
	    if (!$managerId) {
			self::$errCode = 33;
			self::$errMsg = "获取绑定客户经理ID失败";
			return array('result' => false, 'errMsg' => '获取绑定客户经理ID失败');
		}
	    if (!$Customer_Type) {
			self::$errCode = 34;
			self::$errMsg = "获取绑定分销商类型失败";
			return array('result' => false, 'errMsg' => '获取绑定分销商类型失败');
		}
	    $erpDb = Config::getMSDB('Customer');
        if (false === $erpDb){         
            Logger::err("add_item_error1");
            Logger::err(Config::$errCode);
            Logger::err(Config::$errMsg);
           self::$errCode = 32;
           self::$errMsg = "网络繁忙，请稍后再试";
           return array('result' => false, 'errMsg' => '获取绑定客户经理ID失败');
        } 
        
        $retailers = IRetailer::getRetailers(array('icsonid'=>$CustomerID));
        if (empty($retailers)){
        	return array('result' => false, 'errMsg' => '获取分销商记录失败');
        }
        $retailers = current($retailers);
        
        $data = array(
                    'CustomerID' => $CustomerID,
                    'ManagerID' => $managerId,
                    'ManagerName' => $mname,
                    'CustomerType' => $Customer_Type,
                    'rowCreateDate' =>date("Y-m-d H:i:s",time()),
                    'rowModifyDate' =>date("Y-m-d H:i:s",time())
        );
        $result =$erpDb->insert("CustomerMangeMapInfo", $data);

        if (false === $result){
            Logger::err("getList_1_result_8");
            Logger::err(Config::$errCode);
            Logger::err(Config::$errMsg);
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;
                
            return array('result' => false, 'errMsg' => '绑定失败');
        }
        $updateData = array(
        		'uid' => $retailers['uid'],
        		'bindManager' => $mname,
        		'editTime' => time()
        );
        
        IRetailerTTC::update($updateData,array('icsonid'=>$CustomerID));
        
		return array('result' => true,'errMsg' => '绑定成功');
	}
    
    /**
     * 
     * 构造SQL语句中的where条件
     * @param unknown_type $conditions
     */
    public static function _getWhereSQL($conditions = array())
    {
       $whereSql = "";
       $customtable = 0;
       $custommanmap = 0;
       $so_master =0;
       
       if (isset ( $conditions ['username'] ) && '' != $conditions ['username']) 
       {
           $whereSql ="Customer.CustomerID = "."'".ToolUtil::filterInput($conditions ['username'])."'";  
           $customtable = 1; 
       }
       else if (isset ( $conditions ['clientsysnum'] ) && 0 != $conditions ['clientsysnum']) 
       {
           $whereSql ="Customer.SysNo = ".intval($conditions ['clientsysnum']);  
           $customtable = 1;  
       }
       else if (isset ( $conditions ['clientname'] ) && '' != $conditions ['clientname']) 
       {
           $whereSql ="Customer.CustomerName = "."'".ToolUtil::filterInput($conditions ['clientname'])."'";  
           $customtable = 1;  
       }
       else if (isset ( $conditions ['clienttel'] ) && '' != $conditions ['clienttel']) 
       {
           $whereSql ="Customer.CellPhone = "."'".ToolUtil::filterInput($conditions ['clienttel'])."'";
           $customtable = 1;    
       }
       else if (isset ( $conditions ['clientemail'] ) && '' != $conditions ['clientemail']) 
       {
           $whereSql ="Customer.Email = "."'".ToolUtil::filterInput($conditions ['clientemail'])."'"; 
           $customtable = 1;   
       }
       else if (isset ( $conditions ['clientmaname'] ) && '' != $conditions ['clientmaname']) 
       {
           $whereSql ="CustomerMangeMapInfo.ManagerName = "."'".ToolUtil::filterInput($conditions ['clientmaname'])."'";
           $custommanmap = 1;  
       }
       else if (isset ( $conditions ['clientmausername'] ) && '' != $conditions ['clientmausername']) 
       {
           $whereSql ="CustomerMangeMapInfo.ManagerID = "."'".ToolUtil::filterInput($conditions ['clientmausername'])."'";  
           $custommanmap = 1;
       }
       else if (isset ( $conditions ['orderid'] ) && '' != $conditions ['orderid']) 
       {
           $orderid = $conditions ['orderid'];
           $erpDb = Config::getMSDB('ERP_1');
           if (false === $erpDb)
           {
               Logger::err(Config::$errCode);
               Logger::err(Config::$errMsg);
               self::$errCode = Config::$errCode;
               self::$errMsg = Config::$errMsg; 
               return false;
           }
           
                      $sql = <<<SQL
SELECT CustomerSysNo
FROM SO_Master
WHERE SOID = '{$orderid}'
SQL;

        $ret = $erpDb->getRows($sql);
        if (false === $ret)
        {
            Logger::err(Config::$errCode);
             Logger::err(Config::$errMsg);
             self::$errCode = $erpDb->errCode;
             self::$errMsg = $erpDb->errMsg;
                
             return false;
        }
        if($ret)
        {
            $whereSql ="Customer.SysNo = ".intval($ret[0]['CustomerSysNo']); 
        }
        else 
        {
            $whereSql = ''; 
        }
           $so_master =1;  
       }	
       
       $data = array(
               'whereSql' => $whereSql,
               'customtable' => $customtable,
               'custommanmap' => $custommanmap,
               'so_master' => $so_master     
       );

       return $data;
    }
}