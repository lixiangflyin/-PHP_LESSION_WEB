<?php

define('RT_RULE_TYPE_CATEGORY1',			'1'); //大类	
define('RT_RULE_TYPE_CATEGORY2',			'2'); //中类	
define('RT_RULE_TYPE_CATEGORY3',			'3'); //小类	
define('RT_RULE_TYPE_PRODUCT',				'4'); //商品	

define('RT_RULE_STATUS_INVALID',			'-1'); //作废	
define('RT_RULE_STATUS_INIT',				'0');  //初始化	
define('RT_RULE_STATUS_VAILD',				'1');  //可用

define('RT_RULE_BENEFIT_TYPE_DISCOUNT',		'1');  //折扣	
define('RT_RULE_BENEFIT_TYPE_PIRCE',		'2');  //现金立减	  
	
class ITraderPrice
{
	public static $DBName = "ICSON_CORE"; 
	public static $ERPName = "ERP_1";
	
	public static $ruleTableName = "t_trader_promotion_rule";
	
	public static $errCode=0;
	public static $errMsg="";
	
	function clearError()
	{
		self::$errCode = 0;
		self::$errMsg="";
	}

	/**
	 * 从数据库中查找经销商价格数据
	 * 
	 * @para array $data 要查询的价格条件 
	 * 		格式:
	 *		array(
	 *				'rule_id' 		=> XXX,
	 *				'sysNo'			=> XXX,
	 *				'rule_type'		=> XXX,
	 *				'c3id' 			=> XXX,
	 *				'wh_id'			=> XXX,
	 *				'valid_time_from'=> XXX,
	 *				'valid_time_to'	=> XXX,
	 *				'benefit_type' 	=> XXX,
	 *				'gross'			=> XXX,
	 *				'traderPrice1' 	=> XXX,
	 *				'traderPrice2' 	=> XXX,
	 *				'traderPrice3' 	=> XXX,
	 *				'traderPrice4' 	=> XXX,
	 *				'status'		=> XXX,
	 *				'create_user' 	=> XXX,
	 *				'rule_desc'		=> XXX
	 *			)
	 * 返回值：正确返回查找到的价格数据，错误返回false
	 */
	public static function searchTraderPromotionRules($data = array())
	{
		$MSDB = ToolUtil::getMSDBObj(self::$DBName); 
		 
		if ($MSDB == false) {
			self::$errCode = 2001;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "链接数据库失败";
			return false;
		} 
		$sql = "SELECT [rule_id]
					  ,[sysNo]
					  ,[rule_type]
					  ,[c3id]
					  ,[wh_id]
					  ,[valid_time_from]
					  ,[valid_time_to]
					  ,[benefit_type]
					  ,[gross]
					  ,[traderPrice1]
					  ,[traderPrice2]
					  ,[traderPrice3]
					  ,[traderPrice4]
					  ,[status]
					  ,[create_user]
					  ,[create_time]
					  ,[audit_user]
					  ,[audit_time]
					  ,[update_time]
					  ,[rule_desc]
					  FROM [t_trader_promotion_rule] where sysNo!=0";
		if (isset($data['rule_id'])) 
		{
			$sql .=  " AND rule_id=" . $data['rule_id'];
		}
		if (isset($data['sysNo'])) 
		{
			$sql .=  " AND sysNo=" . $data['sysNo'];
		}
		if (isset($data['rule_type'])) 
		{
			$sql .=  " AND rule_type=" . $data['rule_type'];
		}
		if (isset($data['c3id'])) 
		{
			$sql .=  " AND c3id=" . $data['c3id'];
		}
		if (isset($data['valid_time_from']) && isset($data['valid_time_to'])) 
		{
			$sql .= " AND create_time>=" . $data['valid_time_from'] . " AND create_time<=" . $data['valid_time_to'];		
		}
		if (isset($data['benefit_type'])) 
		{
			$sql .=  " AND benefit_type=" . $data['benefit_type'];
		}
		if (isset($data['gross'])) 
		{
			$sql .=  " AND gross=" . $data['gross'];
		}
		if (isset($data['traderPrice1'])) 
		{
			$sql .=  " AND traderPrice1=" . $data['traderPrice1'];
		}
		if (isset($data['traderPrice2'])) 
		{
			$sql .=  " AND traderPrice2=" . $data['traderPrice2'];
		}
		if (isset($data['traderPrice3'])) 
		{
			$sql .=  " AND traderPrice3=" . $data['traderPrice3'];
		}
		if (isset($data['traderPrice4'])) 
		{
			$sql .=  " AND traderPrice4=" . $data['traderPrice4'];
		}
		if (isset($data['status'])) 
		{
			$sql .=  " AND status=" . $data['status'];
		}		
		if (isset($data['create_user']))
		{
			$sql .= " AND create_user like '%" . str_replace(' ','%',$data['create_user']) . "%' ";
		}
		if (isset($data['rule_desc']))
		{
			$sql .= " AND rule_desc like '%" . str_replace(' ','%',$data['rule_desc']) . "%' ";
		}  
		$rules = $MSDB->getRows($sql); 
		if(false === $rules)
		{
			self::$errCode = -4001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "select rules failed" . $MSDB->errMsg; 
			return  false;			
		}  
		return $rules;		
	}
}