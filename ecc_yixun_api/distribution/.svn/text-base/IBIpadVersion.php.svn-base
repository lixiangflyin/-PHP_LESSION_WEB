<?php
/**
 * 分销系统的ipad当前安装版本统计
 *   分销商的ipad使用情况统计
 * 
 * @author tellenji
 */
//错误码
//1001  参数丢失
//1002  分销商不存在
class IBIpadVersion{
	public static $DBName= "retailer";
	public static $tableName = "t_retailer_ipadversion";
	public static $errCode = 0;
	public static $errMsg="";
	
	/**
	 * @brief 查询ipad版本
	 */
	public static function getVersion($condition,$page=1, $pageSize=24){
		$mysql = ToolUtil::getDBObj(self::$DBName);
		if (!$mysql){
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		$filter = self::_getWhereSQL($condition);
		if (false === $filter){
			return false;
		}
		
$sql = <<<SQL
   SELECT count(*) AS total
   FROM  t_retailer_ipadversion
   WHERE {$filter}
SQL;
   		$ret = $mysql->getRows($sql);
		if (false === $ret || 0 == count($ret)){
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".$mysql->errMsg;
			Logger::err(self::$errMsg . $sql);
			return false;
		}
		$count = $ret[0]['total'];
		if (0 === $count){
			return array('errNo'=>0, 'total'=>$count,'list'=>array());
		}
		
		//分页查询
		$start = ($page-1) * $pageSize;
$sql = <<<SQL
   SELECT *
   FROM  t_retailer_ipadversion
   WHERE {$filter}
   Order by last_logintime desc
   limit {$start} , {$pageSize}
SQL;
		$ret = $mysql->getRows($sql);
		if (false === $ret || 0 == count($ret)){
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".$mysql->errMsg;
			Logger::err(self::$errMsg . $sql);
			return false;
		}
		
		return array('errNo'=>0, 'total'=>$count,'data'=>$ret,'page'=> $page,'pageSize'=>$pageSize);
	}
	
	/**
	 * @brief distinct出所有记录的版本号 
	 */
	public static function getDeviceVersions(){
		$mysql = ToolUtil::getDBObj(self::$DBName);
		if (!$mysql){
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
$sql = <<<SQL
   SELECT distinct version
   FROM  t_retailer_ipadversion
SQL;
		$ret = $mysql->getRows($sql);
		if (false === $ret){
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".$mysql->errMsg;
			Logger::err(self::$errMsg . $sql);
			return false;
		}
		$retarr = array();
		foreach ($ret AS $rows){
			$retarr[] = $rows['version'];
		}
		
		return $retarr;
	}
	
	/**
	 * @brief 插入ipad版本号，有则更新，无则插入
	 * TODO:: 可以与登录流水一起记录
	 * @param  $version = array(
	 * 		 'device_no'=>xx
	 * 		 'pid' => xx
	 * 		 'sub_id' => xx
	 * 		 'version' => xx) 
	 */
	public static function addVersion($version){
		$params = array('device_no','pid','sub_id','version');
		$newVersion = array();
		foreach ($params AS $param){
			if(!empty($version[$param])){
				$newVersion[$param] = ToolUtil::filterInput($version[$param]);
			}
			else {
				self::$errCode = 1001;
				self::$errMsg = "参数丢失或为空！";
				Logger::err(basename(__FILE__,'php') . " | Line: " . __LINE__  ." missing ". $param .self::$errMsg);
				return false;
			}
		}
		//获取shop_id,icsonid
		$saleman = IBUser::getSalesmanInfo($version['pid'],$version['sub_id']);
		if (false === $saleman){
			self::$errCode = IBUser::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " getSalesmanInfo Error".IBUser::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		$newVersion['shop_id'] = $saleman['shopId'];
		
		$retailer = IRetailerTTC::get($version['pid']);
		if (false === $retailer){
			self::$errCode = IRetailerTTC::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " getRetaielr TTC Error".IRetailerTTC::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		if (0 == count($retailer)){
			self::$errCode = 1002;
			self::$errMsg = '分销商不存在';
			Logger::err(self::$errMsg);
			return false;
		}
	 	$retailer = current($retailer);
	 	$newVersion['icsonid'] = $retailer['icsonid'];
	 	$newVersion['last_logintime'] = time();
		$mysql = ToolUtil::getDBObj(self::$DBName);
		if (!$mysql){
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		//查找是否该device_no设备是否有记录
		$sql = "SELECT sysno from t_retailer_ipadversion WHERE device_no ='" . ToolUtil::filterInput($newVersion['device_no']) . "'";
		$ret = $mysql->getRows($sql);
		if (false === $ret){
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".$mysql->errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
		if (0 === count($ret)){
			$ret = $mysql->insert(self::$tableName, $newVersion);
		}
		else {
			$ret = $mysql->update(self::$tableName, $newVersion, " device_no = '" . ToolUtil::filterInput($newVersion['device_no']) . "'");	
		}
		
		if (false == $ret){
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: " . __LINE__ . " _getDB Error".ToolUtil::$errMsg;
			Logger::err(self::$errMsg);
			return false;
		}
			
	
		return true;
	}
	
	public static function _getWhereSQL($condition){
		$sql = " pid !=0 ";
		if(isset($condition['icsonid']) && $condition['icsonid'] != ''){
			$sql .= " AND icsonid = '" . ToolUtil::filterInput($condition['icsonid']) . "'";
		}
	
		if(isset($condition['pid']) && $condition['pid'] != ''){
			$sql .= " AND pid = " . ToolUtil::filterInput($condition['pid']);
		}
	
		if(isset($condition['version']) && $condition['version'] != ''){
			$sql .= " AND version = '" . ToolUtil::filterInput($condition['version']) . "'";
		}
	
		if(isset($condition['shop_id']) && $condition['shop_id'] != ''){
			$sql .= " AND shop_id = " . ToolUtil::filterInput($condition['shop_id']);
		}
	
		return $sql;
	}
}

?>