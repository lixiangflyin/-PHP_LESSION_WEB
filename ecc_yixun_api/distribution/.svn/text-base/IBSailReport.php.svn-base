<?php
/**
 * 分销导购数据分析处理，从erp中获取销售数据 
 */
require_once('Config.php');
class IBSailReport
{
	public static $DBName = "retailer";
	public static $tableName = "t_retailer_download";
    public static $errCode = 0;
    
    public static $errMsg = '';
	
	public static $wholesale = array(0 => '正常订单',
									 1 => '调价订单',
									 2 => '渠道订单'
									 ); //订单状态
	
	public static $invoice = array(	1 => '增值税专用发票',
									2 => '增值税普通发票',
									3 => '商业零售发票',
									4 => '冠名发票'								
									 ); //发票类型
									 
	public static $status = array(	4 => '已出库',
									-5 => '部分退货',
									21 => '作废订单',   //员工作废、客户作废、主管作废、全部退货
									22 => '其他状态',   //包括待审核、待出库、待支付、待主管审								
									 ); //订单状态
	
    /**
     * @param $filter = array(
     *      'brandName' => '',
     *      'shopId' => '',
     *      'retailerId' =>'',
     *      'timeFrom' => ''
     *      'timeTo' => ''
     *      'brandName' =>''
     *      'productName' => ''
     *      ) 
     * @param int $page  //从第一页开始
     * @param int $pageSize
     * @return false : array(
     *      'data' => array()
     *      'total' => int
     *  )
     */
    public static function getSailReport($filter, $page, $pageSize=24)
    {
    	if (!isset($filter['retailerId']) || 0 == intval($filter['retailerId']))
    	{
    		self::$errCode = -1001;
    		self::$errMsg = "参数丢失";
    		
    	    return false;
    	}
    	
        $erpDb = Config::getMSDB('ICSON_STATISTIC_DISTRIBUTOR');
        if (false === $erpDb)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg = Config::$errMsg;
            
            return false;
        }
        $whereSql = self::_getWhereSql($filter);
        $sql = <<<SQL
SELECT * 
FROM t_raw_data_distributors_orders
WHERE {$whereSql}
SQL;
        $result = $erpDb->getRows($sql);
        if (false === $result)
        {
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;
            
            return false;
        }
        $total = count($result);
        //总数为0，直接返回
        if (0 == $total)
        {
            return array('data' => array(), 'total' => $total);
        }
        $total_quantity = 0;
        $total_fee = 0;
        $total_shopguidcost = 0;
        foreach ($result AS $key => $v)
        {
            $total_quantity += $v['Quantity'];
            $total_fee += $v['TotalFee'];
            $total_shopguidcost += $v['ShopGuideCost'];
        }
        
        
        $begin = ($page - 1) * $pageSize;
        $end = $page * $pageSize;
        $sql = <<<SQL
SELECT * FROM 
(
    SELECT 
	    CONVERT(VARCHAR(10), OrderDate, 120)  AS OrderDate,
		SOID,
		OutTime,
	    managerID,
		shop_id,
	    managerName,
	    CustomerSysNo,
	    CustomerID,
	    CustomerName,
	    ShopGuideID ,
	    ShopGuideName,
	    ReceiveName,
	    InvoiceType,
	    IsWholeSale,
	    PayTypeName,
	    ProductSysNo,
	    ProductID,
	    ProductName,
	    ManufacturerName,
	    Price,
	    Quantity,
	    TotalFee,
	    ShipFee,
	    BussinessCost,
	    cost,
	    ShopGuideCost,
	    profit,
	    ProfitRate,
	    PMName,
        row_number() over (order by OrderDate desc) rn
     FROM 
         t_raw_data_distributors_orders
     WHERE {$whereSql} 
) temp
WHERE 
    rn > {$begin} and rn <= {$end} 
SQL;
        $ret = $erpDb->getRows($sql);
        if (false === $ret)
        {
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;
            
            return false;
        }
        
        return array(   'data' => $ret,
                        'total' => $total,
                        'total_quantity'=> $total_quantity,
                        'total_fee' => $total_fee,
                        'total_shopguidcost' =>$total_shopguidcost
                );
    }
   
//admin下分销细明数据
    public static function getSellReport($filter, $page, $pageSize=24)
    { 	
        $erpDb = Config::getMSDB('ICSON_STATISTIC_DISTRIBUTOR');
        if (false === $erpDb)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg = Config::$errMsg;
            
            return false;
        }
        $whereSql = self::_getWhereSql($filter);
        $sql = <<<SQL
SELECT COUNT(*) AS total
FROM t_raw_data_distributors_orders
WHERE {$whereSql}
SQL;
		
        $result = $erpDb->getRows($sql);
        if (false === $result)
        {
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;
            
            return false;
        }
        $total = intval($result[0]['total']);
        //总数为0，直接返回
        if (0 == $total)
        {
            return array('data' => array(), 'total' => $total);
        }
        
        $begin = ($page - 1) * $pageSize;
        $end = $page * $pageSize;
        $sql = <<<SQL
SELECT * FROM 
(
    SELECT 
	    CONVERT(VARCHAR(10), OrderDate, 120)  AS OrderDate,
		SOID,
		OutTime,
	    managerID,
		shop_id,
	    managerName,
	    CustomerSysNo,
	    CustomerID,
	    CustomerName,
	    ShopGuideID ,
	    ShopGuideName,
	    ReceiveName,
	    InvoiceType,
	    IsWholeSale,
	    PayTypeName,
	    ProductSysNo,
	    ProductID,
	    ProductName,
	    ManufacturerName,
	    Price,
	    Quantity,
	    TotalFee,
	    ShipFee,
	    BussinessCost,
	    cost,
	    ShopGuideCost,
	    profit,
	    ProfitRate,
	    PMName,
        row_number() over (order by OrderDate desc) rn
     FROM 
         t_raw_data_distributors_orders
     WHERE {$whereSql} 
) temp
WHERE 
    rn > {$begin} and rn <= {$end} 
SQL;

        $ret = $erpDb->getRows($sql);
        if (false === $ret)
        {
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;
            
            return false;
        }
		
		foreach($ret as &$item)
		{
			if(empty($item['OutTime']))
			{
				$item['OutTime']="---";
			}
			else
			{
				$item['OutTime'] = date('Y-m-d H:i:s',strtotime($item['OutTime']));
			}
		}
      
        return array('data' => $ret, 'total' => $total);
    }
	
	
	//获取要导入Excel分销细明数据
    public static function getExcel($filter)
    { 	
        $erpDb = Config::getMSDB('ICSON_STATISTIC_DISTRIBUTOR');
        if (false === $erpDb)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg = Config::$errMsg;
            
            return false;
        }
        $whereSql = self::_getWhereSql($filter);

   $sql = <<<SQL
    SELECT 
	    *,
        row_number() over (order by OrderDate desc) rn
     FROM 
         t_raw_data_distributors_orders
     WHERE {$whereSql} 

SQL;
        $ret = $erpDb->getRows($sql);
        if (false === $ret)
        {
            self::$errCode = $erpDb->errCode;
            self::$errMsg = $erpDb->errMsg;
            
            return false;
        }
        
        return $ret;
    }
	
	
	//根据门店名称获取门店ID
	public static function getshopid($storename)
	{
		$MSDB = ToolUtil::getDBObj("retailer");	
		$sql="SELECT shopId from t_retailer_shop where shopName ='{$storename}'";
		$ret=$MSDB->getRows($sql);
		return $ret;
	}
	//获取全部发票类型
	public static function getmanagerName()
	{
		$erpDb = Config::getMSDB('ICSON_STATISTIC_DISTRIBUTOR');
        if (false === $erpDb)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg = Config::$errMsg;
            
            return false;
        }
		
		$sql ="select distinct managerName from t_raw_data_distributors_orders";
		$ret = $erpDb->getRows($sql);
		
		$name = array();
		if (count($ret)) {
			foreach ($ret as $v) {
				$name[$v['managerName']] = $v;
			}
		}
		return $name;
		
	
	}
	
	//异步下载EXCEL文件
	public static function asyndownload($filter)
	{
		$start=1;
		$end=1000;
		  $erpDb = Config::getMSDB('ICSON_STATISTIC_DISTRIBUTOR');
        if (false === $erpDb)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg = Config::$errMsg;
            
            return false;
        }
        $whereSql = self::_getWhereSql($filter);

   $sql = <<<SQL
    SELECT 
	    *,
        row_number() over (order by OrderDate desc) rn
     FROM 
         t_raw_data_distributors_orders
     WHERE {$whereSql} 

SQL;
	$condition=$whereSql;
	$count=0;
	$count=$erpDb->getRowsCount("t_raw_data_distributors_orders",$whereSql);
	$sheettime = date('YmdHis');
	$outputFileName =  'retialerDetail-'.$sheettime.'.csv';
	$down_data=array(
						'where_download' => $whereSql,
						'statue_download' => 0,
						'count_download' => $count,
						'name_download' => $outputFileName ,
						'time_download' => time(),
						'time_finish' =>0
						);
	$MSDB = ToolUtil::getDBObj(self::$DBName); 
	if ($MSDB == false) 
	{
		self::$errCode = -4001;
		self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "链接数据库失败";
		Logger::err(self::$errMsg); 
		return false;
	}
	$ret =  $MSDB->insert(self::$tableName,$down_data);
	if(false === $ret)
	{
		self::$errCode = -4002;
		self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "insert BannerDB failed". $MSDB->errMsg;
		Logger::err(self::$errMsg); 
		return  false;
	}
	
	return $outputFileName;	
	}
	
	//异步下载EXCEL小文件
	public static function _getasynchild($whereSql,$start,$end)
	{
		  $erpDb = Config::getMSDB('ICSON_STATISTIC_DISTRIBUTOR');
        if (false === $erpDb)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg = Config::$errMsg;
            
            return false;
        }
		
		  $sql = <<<SQL
		  select * from (
SELECT 
	    *,
        row_number() over (order by OrderDate desc) rn
     FROM 
         t_raw_data_distributors_orders
     WHERE {$whereSql}
) tmpres 
where rn >= {$start} and rn <= {$end}

SQL;

	$rs = $erpDb->getRows($sql);
	$tmp = time();
	$sheettime = date('YmdHis',$tmp);
	$outputFileName =  'retialerDetail-'.$sheettime.'.csv';
	
	$fp=fopen("/data/release/webapp/admin_icson_com/biz/retailer/web/download/a.csv","a+");//fopen()的其它开关请参看相关函数
	 if (!flock($fp, LOCK_EX|LOCK_NB)) 
	 {
            echo "This program is running\n";
            return;
     }
	foreach($rs as $k => $v)
	{
		
		if($v['warehouse_id'] == 1){$fenzhan="上海";}
		else if($v['warehouse_id'] == 1001){$fenzhan="深圳";}
		else if($v['warehouse_id'] == 2001){$fenzhan="北京";}
		else if($v['warehouse_id'] == 3001){$fenzhan="武汉";}
		else if($v['warehouse_id'] == 4001){$fenzhan="重庆";}
				
				
		if($v['InvoiceType'] == 1){$fapiaotype="增值税专用发票";}
		else if($v['InvoiceType'] == 2){$fapiaotype="增值税普通发票";}
		else if($v['InvoiceType'] == 3){$fapiaotype="商业零售发票";}
		else if($v['InvoiceType'] == 4){$fapiaotype="冠名发票";}
		else{$fapiaotype="";}
			
		if($v['IsWholeSale'] == 1){$dingdantype="调价订单";}
		else if($v['IsWholeSale'] == 2){$dingdantype="渠道订单";}
		else if($v['IsWholeSale'] == 0){$dingdantype="正常订单";}
				
		$str=$v['SOID'].",".$v['OutTime'].",".$v['OrderDate'].",".$fenzhan.",".$v['managerName'].",".$v['CustomerID'].",".$v['CustomerName'].",".$v['ReceiveContact'].
		",".$v['ReceiveAddress'].",".$v['ReceiveName'].",".$dingdantype.",".$fapiaotype.",".$v['ProductID'].",".$v['ProductName'].",".$v['C1Name'].",".$v['C2Name'].
		",".$v['C3Name'].",".$v['ManufacturerName'].",".$v['PMName'].",".$v['Price'].",".$v['Quantity'].",".$v['TotalFee'].",".$v['BussinessCost'].
		",".$v['cost'].",".$v['profit'].",".$v['ProfitRate']."\n";							  							  
		fputs($fp,$str);
		
	}
	flock($fp, LOCK_UN); // 释放锁定
	fclose($fp);
	 return true;
	//return $ret;
	}
	
    /**
     * 组装查询条件 
     *      
     *      
     *  
     *      'timeFrom' => ''
     *      'timeTo' => ''
     *     
     */
    private function _getWhereSql($filter)
    {
    	$whereSql = ' CustomerSysNo >0  ';
        if (isset($filter['productName']) && '' != $filter['productName'])
        {
            $whereSql .= " and ProductName LIKE '%" . ToolUtil::filterInput($filter['productName']) . "%'";
        }
        if (isset($filter['shopId']) && 0 != $filter['shopId'])
        {
            $whereSql .= " and Shop_id =" . intval($filter['shopId']);
        }
        if (isset($filter['brandName']) && '' != $filter['brandName'])
        {
            $whereSql .= " and ManufacturerName LIKE '%" . ToolUtil::filterInput($filter['brandName']) . "%'";
        }
        if (isset($filter['retailerId']) && '' != $filter['retailerId'])
        {
            $whereSql .= " and CustomerSysNo =" . intval($filter['retailerId']) ;
        }
        if (isset($filter['account']) && '' != $filter['account'])
        {
            $whereSql .= " and ShopGuideName LIKE '%" . ToolUtil::filterInput($filter['account']) . "%'";
        }
        if (isset($filter['timeFrom']) && '' != $filter['timeFrom'])
        {
            $whereSql .= " and OrderDate >='" . ToolUtil::filterInput($filter['timeFrom']) . "'";
        }
        if (isset($filter['timeTo']) && '' != $filter['timeTo'])
        {
            $whereSql .= " and OrderDate <='" . ToolUtil::filterInput($filter['timeTo']) . "'";
        }
        if (isset($filter['customerid']) && '' != $filter['customerid'])
        {
            $whereSql .= " and CustomerID =" . "'{$filter['customerid']}'";
        }
		if (isset($filter['companyname']) && '' != $filter['companyname'])
        {
            $whereSql .= " and ReceiveName =" . "'{$filter['companyname']}'";
        }
		 if (isset($filter['startouttime']) && '' != $filter['startouttime'])
        {
            $whereSql .= " and OutTime >='" . ToolUtil::filterInput($filter['startouttime']) . "'";
        }
        if (isset($filter['endouttime']) && '' != $filter['endouttime'])
        {
            $whereSql .= " and OutTime <='" . ToolUtil::filterInput($filter['endouttime']) . "'";
        }
		if (isset($filter['status']) && 20 != $filter['status'])
        {
			if(intval($filter['status'])==21)
			{
				$whereSql .= " and (status =-4 or status =-3 or status =-2 or status =-1 )";
			}
			else if(intval($filter['status'])==22)
			{
				$whereSql .= " and (status =1 or status =2 or status =3)";
			}
			else
			{
				$whereSql .= " and status =" . intval($filter['status']);
			}
									
        }
		if (isset($filter['invoice']) && 0 != $filter['invoice'])
        {
            $whereSql .= " and InvoiceType =" . intval($filter['invoice']);
        }
		if (isset($filter['wholesale']) && -1 != $filter['wholesale'])
        {
            $whereSql .= " and IsWholeSale =" . intval($filter['wholesale']);
        }
		if (isset($filter['managerName']) && ('' != $filter['managerName']))
        {
            $whereSql .= " and managerName ='" . "{$filter['managerName']}"."'";
        }
		if (isset($filter['shop_id']) && 0 != $filter['shop_id'])
        {
            $whereSql .= " and shop_id =" . intval($filter['shop_id']);
        }
        return $whereSql;
    }
}