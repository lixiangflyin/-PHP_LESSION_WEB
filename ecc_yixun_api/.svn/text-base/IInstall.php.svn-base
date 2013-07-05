<?php
class IInstall{
	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}

	//拉取已预约的上门安装 列表
	public static function getalready_install($uid, $page, $pageSize){
		$installList = array();
		$total = IProductInstallMentBookTTC::get($uid, array(), array('SysNo'));
		if (false === $total) {
			self::$errCode = IProductInstallMentBookTTC::$errCode;
			self::$errMsg = IProductInstallMentBookTTC::$errMsg;
			Logger::err("IProductInstallMentBookTTC get failed" . " errMsg: " .IProductInstallMentBookTTC::$errMsg ." errCode: " .IProductInstallMentBookTTC::$errCode);
			return false;
		}
		$total = count($total);
		$installList['total'] = $total;

		$data = IProductInstallMentBookTTC::get($uid, array(),array(),$pageSize , $page*$pageSize);

		if(false === $data){
			self::$errCode = IProductInstallMentBookTTC::$errCode;
			self::$errMsg = IProductInstallMentBookTTC::$errMsg;
			Logger::err("IProductInstallMentBookTTC get failed" . " errMsg: " .IProductInstallMentBookTTC::$errMsg ." errCode: " .IProductInstallMentBookTTC::$errCode);
			return false;
		}
		$installList['data'] = $data;
		return $installList;
	}

	//上门预约安装详情
	public static function installdetail($SoSysNo, $uid){
		$details_data = IProductInstallMentBookTTC::get($uid, array('SysNo' => $SoSysNo), array());
		if(false === $details_data){
			self::$errCode = IProductInstallMentBookTTC::$errCode;
			self::$errMsg = IProductInstallMentBookTTC::$errMsg;
			Logger::err("IProductInstallMentBookTTC get" . " errMsg: " .IProductInstallMentBookTTC::$errMsg ." errCode: " .IProductInstallMentBookTTC::$errCode);
			return false;
		}
		return $details_data;
	}

	//取消上门预约安装
	public static function setInstallCanceled($uid, $sysno){
		self::clearERR();
		if(!isset($sysno) || $sysno == ""){
			self::setERR(4001, "sysno is empty, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}
		$sysno = intval($sysno);

		if(!isset($uid) || $uid <= 0) {
			self::setERR(4002, "uid is empty, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}
		$uid = intval($uid);

		$msdb = Config::getMSDB("ERP_1");
		if($msdb === false){
			self::setERR(4003, "init DB failed, code: " . Config::$errCode . "; msg: " . Config::$errMsg);
			return false;
		}

		$select_sql = "select Status from Product_InstallMentBook where SysNo = '{$sysno}' and CreateUserSysNo = '{$uid}'";
		$select_bool = $msdb->getRows($select_sql);
		if($select_bool === false){
			self::setERR(4004, "execSql failed, code: " . $msdb->errCode . "; msg: " . $msdb->errMsg);
			return false;
		}
		if(isset($select_bool[0]['Status']) && $select_bool[0]['Status'] != 0){
			return array('errno' => 2);
		}

		$newRecord = array(
			'CustomerSysno'=>$uid,
			'Status' => -2,
			'rowModifyDate' => date('Y-m-d H:i:s', time()),
		);
		$filter = array('SysNo'=>$sysno);
		$ret = IProductInstallMentBookTTC::update($newRecord, $filter);
		if(false === $ret){
			self::$errCode = IProductInstallMentBookTTC::$errCode;
			self::$errMsg = IProductInstallMentBookTTC::$errMsg;
			Logger::err("IProductInstallMentBookTTC update" . " errMsg: " .IProductInstallMentBookTTC::$errMsg ." errCode: " .IProductInstallMentBookTTC::$errCode);
			return false;
		}

		return true;
	}

	//新增上门预约安装
	public static function addInstall($uid, $installinfo){
		self::clearERR();
		$uid = intval($uid);
		$check = IInstall::checkInstallInfo($installinfo);
		if(false === $check){
			return false;
		}
		$sysno = IIdGenerator::getNewId("productinstallmentbook_Sequence");
		if($sysno === false){
			self::setERR(6001, "IIdGenerator::getNewId failed, code: " . IIdGenerator::$errCode . "; msg: " . IIdGenerator::$errMsg);
			return false;
		}

		$new_install = array();
		$new_install['SysNo']					= $sysno;
		$new_install['ItemType']				= ($installinfo['ItemType'] == '739') ? 1 : 3;
		$new_install['Whid']					= 1;
		$new_install['C3SysNo']					= $installinfo['ItemType'];
		$new_install['SOID']					= $installinfo['soid'];
		$new_install['SoSysNo']					= $installinfo['SoSysNo'];
		$new_install['BranchName']				= ToolUtil::transXSSContent($installinfo['BranchName']);
		$new_install['ProductMode']				= ToolUtil::transXSSContent($installinfo['ProductMode']);
		$new_install['ProductSysNo']			= $installinfo['ProductSysNo'];
		$new_install['InstallTime']				= $installinfo['InstallTime'];
		$new_install['InstallAreaSysNo']		= $installinfo['InstallAreaSysNo'];
		$new_install['InstallAddress']			= ToolUtil::transXSSContent($installinfo['InstallAddress']);
		$new_install['ContactName']				= ToolUtil::transXSSContent($installinfo['ContactName']);
		$new_install['ContactPhone']			= $installinfo['ContactPhone'];
		$new_install['ContactMobile']			= $installinfo['ContactMobile'];
		$new_install['Memo']					= ToolUtil::transXSSContent($installinfo['Memo']);
		if($installinfo['ItemType'] == '739'){//净水设备
			$new_install['PureLandMaterialType']	= $installinfo['PureLandMaterialType'];//{//台盆材质
		}else{//空调
			$new_install['AirConditionLineType']	= $installinfo['AirConditionLineType'];//管线长度
			$new_install['AirConditionBracketType']	= $installinfo['AirConditionBracketType'];//支架
			$new_install['AirConditionWallType']	= $installinfo['AirConditionWallType'];//打墙洞
		}
		$new_install['Status']					= 0;
		$new_install['CustomerSysno']			= $uid;
		$new_install['CreateUserSysNo']			= 33;
		$new_install['CreateTime']				= date('Y-m-d H:i:s', time());
		$new_install['rowCreateDate']			= date('Y-m-d H:i:s', time());
		$new_install['rowModifyDate']			= date('Y-m-d H:i:s', time());

		$rs = IProductInstallMentBookTTC::insert($new_install);
		if(false === $rs){
			self::$errCode = IProductInstallMentBookTTC::$errCode;
			self::$errMsg = IProductInstallMentBookTTC::$errMsg;
			Logger::err("IProductInstallMentBookTTC insert failed" . " errMsg: " .IProductInstallMentBookTTC::$errMsg ." errCode: " .IProductInstallMentBookTTC::$errCode);
			return false;
		}

		return $sysno;
	}

	//上门预约安装填写页面list展示
	public static function reportInstall_list($uid, $order_id){
		if(!ToolUtil::checkInt($order_id)) {
			return false;
		}

		$order_id = preg_replace("/[^0-9a-zA-Z]/", '', $order_id);
		if(empty($order_id)) {
			return false;
		}
		$orderDetail = self::getOneOrderDetailNeedInstall($uid, $order_id);
		if($orderDetail === false){
			Logger::err("IInstall::getOneOrderDetailNeedInstall failed, code: " . self::$errCode . ', msg: ' . self::$errMsg);
			return false;
		}

		return array(
			'errno'	=> 0,
			'data'	=> $orderDetail,
		);

	}

	//上门预约安装检查属性值
	private static function checkInstallInfo($install_info){
		if(!isset($install_info)){
			self::setERR(8001, basename(__FILE__, '.php') . " |" . __LINE__ . ' install_info is invalid');
			return false;
		}

		if(!isset($install_info['CreateUserSysNo']) || $install_info['CreateUserSysNo'] <= 0){
			self::setERR(8002, basename(__FILE__, '.php') . " |" . __LINE__ . ' CreateUserSysNo is invalid');
			return false;
		}

		if(!isset($install_info['SoSysNo']) || $install_info['SoSysNo'] <= 0){
			self::setERR(8003, basename(__FILE__, '.php') . " |" . __LINE__ . ' SoSysNo is invalid');
			return false;
		}

		if(!isset($install_info['BranchName'])){
			self::setERR(8004, basename(__FILE__, '.php') . " |" . __LINE__ . ' BranchName is invalid');
			return false;
		}

		if(!isset($install_info['ProductMode'])){
			self::setERR(8005, basename(__FILE__, '.php') . " |" . __LINE__ . ' ProductMode is invalid');
			return false;
		}

		if(!isset($install_info['InstallTime'])){
			self::setERR(8006, basename(__FILE__, '.php') . " |" . __LINE__ . ' InstallTime is invalid');
			return false;
		}

		if(!isset($install_info['InstallAreaSysNo']) || $install_info['InstallAreaSysNo'] <= 0){
			self::setERR(8007, basename(__FILE__, '.php') . " |" . __LINE__ . ' InstallAreaSysNo is invalid');
			return false;
		}

		if(!isset($install_info['InstallAddress'])){
			self::setERR(8008, basename(__FILE__, '.php') . " |" . __LINE__ . ' InstallAddress is invalid');
			return false;
		}

		if(!isset($install_info['ContactName'])){
			self::setERR(8009, basename(__FILE__, '.php') . " |" . __LINE__ . ' ContactName is invalid');
			return false;
		}

		if(!isset($install_info['ContactPhone'])){
			self::setERR(7010, basename(__FILE__, '.php') . " |" . __LINE__ . ' ContactPhone is invalid');
			return false;
		}

		if($install_info['ItemType'] == '739'){//净水设备
			if(!isset($install_info['PureLandMaterialType']) || $install_info['PureLandMaterialType'] <= 0){
				self::setERR(8011, basename(__FILE__, '.php') . " |" . __LINE__ . ' PureLandMaterialType is invalid');
				return false;
			}
		}else{//空调
			if(!isset($install_info['AirConditionLineType']) || $install_info['AirConditionLineType'] <= 0){
				self::setERR(8012, basename(__FILE__, '.php') . " |" . __LINE__ . ' AirConditionLineType is invalid');
				return false;
			}

			if(!isset($install_info['AirConditionBracketType']) || $install_info['AirConditionBracketType'] <= 0){
				self::setERR(8013, basename(__FILE__, '.php') . " |" . __LINE__ . ' AirConditionBracketType is invalid');
				return false;
			}

			if(!isset($install_info['AirConditionWallType']) || $install_info['AirConditionWallType'] <= 0){
				self::setERR(8014, basename(__FILE__, '.php') . " |" . __LINE__ . ' AirConditionWallType is invalid');
				return false;
			}
		}
		return true;
	}

	//最近一个月
	public static function getUserOrdersNeedInstallOneMonth($uid, $page, $pageSize)
	{
		if (!isset($uid) || $uid <= 0)
		{
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid,'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb))
		{
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return  false;
		}

		$sql = "select * from (
		select hw_id,
		order_char_id,
		flag,
		out_time,
		order_id,
		status,
		order_date,
		pay_type,
		isPayed,
		shipping_type,
		receiver,
		shipping_cost,
		order_cost,
		coupon_code,
		coupon_amt,
		stockNo,
		point,
		row_number() over (order by order_date  desc) rn
		from t_orders_{$db_tab_index['table']} where uid=$uid and (subOrderNum IS NULL OR subOrderNum=0)) tmpres
		where rn >" .  $page*$pageSize . " and rn<=" .($page+1)*$pageSize ;
		$orders =  $orderDb->getRows($sql);
		if (false === $orders)
		{
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}
		if (count($orders) == 0)
		{
		 	return array('total'=>0, 'orders'=>array());
		}

		//只对从属于上海站的仓出货的订单提供上门安装服务
		global $_StockToStation;
		foreach($orders as $key => $o)
		{
			if(!isset($_StockToStation[$o['stockNo']]) || $_StockToStation[$o['stockNo']] != SITE_SH)
			{
				unset($orders[$key]);
			}
		}
		if (count($orders) == 0)
		{
			return array('total'=>0, 'orders'=>array());
		}

		//拉取订单对应的商品
		$sql = "select order_char_id, flag, product_id, product_char_id, name, buy_num from t_order_items_{$db_tab_index['table']} where uid=$uid and product_type=0 and order_char_id in(''";
		$orders_id = array();
		foreach ($orders as $o)
		{
			$sql .= ",'{$o['order_char_id']}'";
			$orders_id[] = $o['order_id'];
		}
		$sql .= ") order by order_char_id";


		$order_items = $orderDb->getRows($sql);
		if (false === $order_items)
		{
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		//ixiuzeng获取商品3级类目名称
		$pids = array();
		$p_c3 = array();
		$p_c3_id = array();

		foreach ($order_items as $oit)
		{
			$pids[] = $oit['product_id'];
		}
		$p_c3 = IProductCommonInfoTTC::gets(array_unique($pids), array(), array('product_id' ,'c3_ids'));
		if(false === $p_c3)
		{
			self::$errCode = IProductCommonInfoTTC::errCode;
			self::$errMsg = IProductCommonInfoTTC::errMsg;
			return false;
		}
		foreach($p_c3 as $pc)
		{
			$p_c3_id[$pc['product_id']] =  $pc['c3_ids'];
		}

		global $_StockToStation;
		global $_OrderState;
		global  $_OrderProcessId;
		//获取所有订单的处理流水

		/*$order_process_flows = IOrderProcessFlowTTC::gets($orders_id, array('process_id'=>$_OrderProcessId['Done']['value']), array('order_id'));
		$order_ids_done = array();
		foreach($order_process_flows as $opf)
		{
			$order_ids_done[] = $opf['order_id'];
		}*/

		foreach ($orders as $key => $or)
		{
			//订单状态是已出库或者是部分退货，且订单的处理流水是99  (modify:'且订单的处理流水是99'条件去除)
			if( !(($or['status'] == $_OrderState['OutStock']['value'] || $or['status'] == $_OrderState['PartlyReturn']['value'])))
			{
				unset($orders[$key]);
				continue;
			}
			$i = 1;
			foreach ($order_items as $oit)
			{
				var_dump($p_c3_id[$oit['product_id']]);
				if (strcmp($oit['order_char_id'] , $or['order_char_id']) === 0)
				{
					if( 736 == $p_c3_id[$oit['product_id']] || 739 == $p_c3_id[$oit['product_id']] )
					{
						$orders[$key]['items'][$i]['name'] = $oit['name'];
						$orders[$key]['items'][$i]['product_char_id'] = $oit['product_char_id'];
						$orders[$key]['items'][$i]['product_id'] = $oit['product_id'];
						$orders[$key]['items'][$i]['buy_num'] = $oit['buy_num'];
						$orders[$key]['items'][$i]['flag'] = $oit['flag'];
						$orders[$key]['items'][$i]['c3_id'] = $p_c3_id[$oit['product_id']];
						$i++;
					}
				}
			}
			if(!isset($orders[$key]['items']))
			{
				unset($orders[$key]);
			}
		}

		if (count($orders) == 0)
		{
			return array('total'=>0, 'orders'=>array());
		}


		//查看TTC中的Product_InstallmentBook中订单商品的预约情况
		$order_array = array();
		foreach ($orders as $o)
		{
			array_push($order_array, $o['order_id']);
		}

		$installedItems = array();
		$status_array = array(0,1);
		$ret = IProductInstallMentBookTTC::get($uid, array(), array('SoSysNo', 'ProductSysNo', 'Status', 'SysNo'));

		if (false === $ret)
		{
			self::$errCode = IProductInstallMentBookTTC::$errCode;
			self::$errMsg = IProductInstallMentBookTTC::$errMsg;
			Logger::err("IProductInstallMentBookTTC get failed" . " errMsg: " .IProductInstallMentBookTTC::$errMsg ." errCode: " .IProductInstallMentBookTTC::$errCode);
			return false;
		}

		if(!empty($ret)){
			foreach($ret as $item){
				$installedItems_each = array();
				if(in_array($item['SoSysNo'], $order_array)
					&& in_array($item['Status'], $status_array)){
						$installedItems_each['SoSysNo'] = $item['SoSysNo'];
						$installedItems_each['ProductSysNo'] = $item['ProductSysNo'];
						$installedItems_each['SysNo'] = $item['SysNo'];
						array_push($installedItems,$installedItems_each);
				}
			}
		}

		$installedcount = array();
		if(count($installedItems) != 0)
		{
			foreach($installedItems as $iis)
			{
				$installedcount[$iis['SoSysNo']][$iis['ProductSysNo']] = isset($installedcount[$iis['SoSysNo']][$iis['ProductSysNo']]) ? $installedcount[$iis['SoSysNo']][$iis['ProductSysNo']] +1 : 1;
			}
		}

		foreach($orders as $key_o => $o)
		{
			foreach($o['items'] as $key => $op)
			{
				$orders[$key_o]['items'][$key]['installed_num'] = isset($installedcount[$o['order_id']][$op['product_id']])? $installedcount[$o['order_id']][$op['product_id']]:0;
				if($orders[$key_o]['items'][$key]['installed_num'] == $orders[$key_o]['items'][$key]['buy_num']){
					unset($orders[$key_o]['items'][$key]);
				}
			}

			if(empty($orders[$key_o]['items']) || count($orders[$key_o]['items']) <=0){
				unset($orders[$key_o]);
			}
		}
		$toal = count($orders);
		return array('total'=>$toal, 'orders'=>$orders);
	}


	//一个月之前
	public static function getUserOrdersNeedInstallOneMonthAgo($uid, $page, $pageSize)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}

		$orders = IOrdersTTC::get($uid, array('subOrderNum'=>0), array('hw_id', 'order_char_id', 'flag', 'out_time', 'order_id', 'status', 'order_date',
		'pay_type', 'isPayed', 'receiver', 'stockNo', 'shipping_cost', 'order_cost', 'shipping_type', 'coupon_code', 'coupon_amt', 'point'), $pageSize , $page*$pageSize);
		if (false === $orders) {
			self::$errCode = IOrdersTTC::$errCode;
			self::$errMsg = IOrdersTTC::$errMsg;
			return false;
		}

		if (count($orders) == 0)
		{
		 	return array('total'=>0, 'orders'=>array());
		}

		//只对从属于上海站的仓出货的订单提供上门安装服务
		global $_StockToStation;
		foreach($orders as $key => $o)
		{
			if(!isset($_StockToStation[$o['stockNo']]) || $_StockToStation[$o['stockNo']] != SITE_SH)
			{
				unset($orders[$key]);
			}
		}
		if (count($orders) == 0)
		{
			return array('total'=>0, 'orders'=>array());
		}

		//拉取订单对应的商品
		$order_items = IOrderItemsTTC::get($uid, array('product_type'=>0), array('order_char_id','flag', 'product_id', 'product_char_id', 'name', 'buy_num'));
		if (false === $order_items) {
			self::$errCode = IOrderItemsTTC::$errCode;
			self::$errMsg = IOrderItemsTTC::$errMsg;
			return false;
		}

		//ixiuzeng获取商品3级类目名称
		$pids = array();
		$p_c3 = array();
		$p_c3_id = array();

		foreach ($order_items as $oit)
		{
			$pids[] = $oit['product_id'];
		}
		$p_c3 = IProductCommonInfoTTC::gets(array_unique($pids), array(), array('product_id' ,'c3_ids'));
		if(false === $p_c3)
		{
			self::$errCode = IProductCommonInfoTTC::errCode;
			self::$errMsg = IProductCommonInfoTTC::errMsg;
			return false;
		}
		foreach($p_c3 as $pc)
		{
			$p_c3_id[$pc['product_id']] =  $pc['c3_ids'];
		}

		global $_StockToStation;
		global $_OrderState;
		global  $_OrderProcessId;
		//获取所有订单的处理流水

		$orders_id = array();
		foreach($orders as $key => $o)
		{
			$orders_id[] = $o['order_id'];
		}
		/*$order_process_flows = IOrderProcessFlowTTC::gets($orders_id, array('process_id'=>$_OrderProcessId['Done']['value']), array('order_id'));
		$order_ids_done = array();
		foreach($order_process_flows as $opf)
		{
			$order_ids_done[] = $opf['order_id'];
		}*/

		foreach ($orders as $key => $or)
		{
			//订单状态是已出库或者是部分退货，且订单的处理流水是99 (modify:'且订单的处理流水是99'条件去除)
			if( !(($or['status'] == $_OrderState['OutStock']['value'] || $or['status'] == $_OrderState['PartlyReturn']['value'])))
			{
				unset($orders[$key]);
				continue;
			}
			$i = 1;
			foreach ($order_items as $oit)
			{
				if (strcmp($oit['order_char_id'] , $or['order_char_id']) === 0)
				{
					if( 736 == $p_c3_id[$oit['product_id']] || 739 == $p_c3_id[$oit['product_id']] )
					{
						$orders[$key]['items'][$i]['name'] = $oit['name'];
						$orders[$key]['items'][$i]['product_char_id'] = $oit['product_char_id'];
						$orders[$key]['items'][$i]['product_id'] = $oit['product_id'];
						$orders[$key]['items'][$i]['buy_num'] = $oit['buy_num'];
						$orders[$key]['items'][$i]['flag'] = $oit['flag'];
						$orders[$key]['items'][$i]['c3_id'] = $p_c3_id[$oit['product_id']];
						$i++;
					}
				}
			}
			if(!isset($orders[$key]['items']))
			{
				unset($orders[$key]);
			}
		}

		if (count($orders) == 0)
		{
			return array('total'=>0, 'orders'=>array());
		}

		//查看TTC 中的Product_InstallmentBook中订单商品的预约情况
		$order_array = array();
		foreach ($orders as $o)
		{
			array_push($order_array, $o['order_id']);
		}

		$installedItems = array();
		$status_array = array(0,1);
		$ret = IProductInstallMentBookTTC::get($uid, array(), array('SoSysNo', 'ProductSysNo', 'Status', 'SysNo'));

		if (false === $ret)
		{
			self::$errCode = IProductInstallMentBookTTC::$errCode;
			self::$errMsg = IProductInstallMentBookTTC::$errMsg;
			Logger::err("IProductInstallMentBookTTC get failed" . " errMsg: " .IProductInstallMentBookTTC::$errMsg ." errCode: " .IProductInstallMentBookTTC::$errCode);
			return false;
		}

		if(!empty($ret)){
			foreach($ret as $item){
				$installedItems_each = array();
				if(in_array($item['SoSysNo'], $order_array)
					&& in_array($item['Status'], $status_array)){
						$installedItems_each['SoSysNo'] = $item['SoSysNo'];
						$installedItems_each['ProductSysNo'] = $item['ProductSysNo'];
						$installedItems_each['SysNo'] = $item['SysNo'];
						array_push($installedItems,$installedItems_each);
				}
			}
		}

		$installedcount = array();
		if(count($installedItems) != 0)
		{
			foreach($installedItems as $iis)
			{
				$installedcount[$iis['SoSysNo']][$iis['ProductSysNo']] = isset($installedcount[$iis['SoSysNo']][$iis['ProductSysNo']]) ? $installedcount[$iis['SoSysNo']][$iis['ProductSysNo']] +1 : 1;
			}
		}

		foreach($orders as $key_o => $o)
		{
			foreach($o['items'] as $key => $op)
			{
				$orders[$key_o]['items'][$key]['installed_num'] = isset($installedcount[$o['order_id']][$op['product_id']])? $installedcount[$o['order_id']][$op['product_id']]:0;
				if($orders[$key_o]['items'][$key]['installed_num'] == $orders[$key_o]['items'][$key]['buy_num']){
					unset($orders[$key_o]['items'][$key]);
				}
			}

			if(empty($orders[$key_o]['items']) || count($orders[$key_o]['items']) <=0){
				unset($orders[$key_o]);
			}
		}
		$toal = count($orders);
		return array('total'=>$toal, 'orders'=>$orders);
	}

	public static function getOneOrderDetailNeedInstall($uid, $order_id)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid[$uid] is empty";
			return false;
		}
		if (!isset($order_id) || $order_id == "") {
			self::$errCode = -2019;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "order_id[$order_id] is empty";
			return false;
		}
		$order_id = intval($order_id);

		$db_tab_index = ToolUtil::getMSDBTableIndex($uid,'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return  false;
		}

		$sql = "select
				hw_id,
				stockNo,
				flag,
				order_id,
				order_char_id,
				receiver,
				receiver_zip,
				receiver_tel,
				receiver_addr,
				receiver_addr_id,
				receiver_mobile,
				status,
				order_date,
				isPayed,
				pay_type
				from t_orders_{$db_tab_index['table']} where uid=$uid and order_char_id='$order_id'";

		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::$errCode = $orderDb->errCode;
			self::$errMsg = $orderDb->errMsg;
			return false;
		}

		$inSqlSvr = false;
		if (count($orders) == 1)
		{
			$inSqlSvr = true;
		}
		else
		{
			$orders = IOrdersTTC::get($uid, array('order_char_id'=>$order_id), array(
				'hw_id',
				'flag',
				'order_id',
				'order_char_id',
				'status',
				'receiver',
				'receiver_zip',
				'receiver_tel',
				'receiver_addr',
				'receiver_addr_id',
				'receiver_mobile',
				'order_date',
				'isPayed',
				'pay_type',
				'stockNo',
			));
			if (false === $orders) {
				self::$errCode = IOrdersTTC::$errCode;
				self::$errMsg = IOrdersTTC::$errMsg;
				return false;
			}
			if (count($orders) == 0) {
				self::$errCode = -999;
				self::$errMsg = "订单不存在";
				return  false;
			}
		}
		$order = &$orders[0];

		global $_OrderState;
		global  $_OrderProcessId;
		//订单状态是已出库或者是部分退货，且订单的处理流水是99 (modify:'且订单的处理流水是99'条件去除)
		//$order_process_flows = IOrderProcessFlowTTC::get($order['order_id'], array('process_id'=>$_OrderProcessId['Done']['value']), array('order_id'));
		if(!(($order['status'] == $_OrderState['OutStock']['value'] || $order['status'] == $_OrderState['PartlyReturn']['value'])))
		{
			return array();
		}

		//拉取订单对应的商品
		if ($inSqlSvr === true)
		{
			$sql = "select product_id, flag, product_char_id, product_type, main_product_id, name,weight, buy_num,warranty, price, cash_back from t_order_items_{$db_tab_index['table']} where uid=$uid  and product_type=0  and order_char_id='$order_id' ";
			$order_items = $orderDb->getRows($sql);
			if (false === $order_items) {
				self::$errCode = $orderDb->errCode;
				self::$errMsg = $orderDb->errMsg;
				return false;
			}
		}
		else
		{
			$order_items = IOrderItemsTTC::get($uid, array('order_char_id'=>$order_id, 'product_type' => 0), array('product_id', 'flag', 'product_char_id', 'product_type', 'main_product_id', 'name','weight', 'buy_num','warranty', 'price','cash_back'));
			if (false === $order_items) {
				self::$errCode = IOrderItemsTTC::$errCode;
				self::$errMsg = IOrderItemsTTC::$errMsg;
				return false;
			}
		}

		//ixiuzeng获取商品3级类目名称
		$pids = array();
		$p_c3 = array();
		$p_c3_id = array();
		$p_mode = array();
		$p_manufacturer = array();

		foreach ($order_items as $oit)
		{
			$pids[] = $oit['product_id'];
		}
		$p_c3 = IProductCommonInfoTTC::gets(array_unique($pids), array(), array('product_id' ,'c3_ids','manufacturer','mode'));
		if(false === $p_c3)
		{
			self::$errCode = IProductCommonInfoTTC::errCode;
			self::$errMsg = IProductCommonInfoTTC::errMsg;
			return false; 
		}
		foreach($p_c3 as $pc)
		{
			$p_c3_id[$pc['product_id']] =  $pc['c3_ids'];
			$p_mode[$pc['product_id']] =  $pc['mode'];
			$p_manufacturer[$pc['product_id']] =  $pc['manufacturer'];
		}

		$i = 1;
		foreach ($order_items as $oit)
		{
			//var_dump($oit);
			var_dump($p_c3_id[$oit['product_id']]);
			if( 736 == $p_c3_id[$oit['product_id']] || 739 == $p_c3_id[$oit['product_id']] )
			{
				$order['items'][$i]['name'] = $oit['name'];
				$order['items'][$i]['product_char_id'] = $oit['product_char_id'];
				$order['items'][$i]['product_id'] = $oit['product_id'];
				$order['items'][$i]['buy_num'] = $oit['buy_num'];
				$order['items'][$i]['flag'] = $oit['flag'];
				$order['items'][$i]['c3_id'] = $p_c3_id[$oit['product_id']];
				$order['items'][$i]['mode'] = $p_mode[$oit['product_id']];
				$order['items'][$i]['manufacturer'] = $p_manufacturer[$oit['product_id']];
				$order['items'][$i]['install_info'] = array();
				$i++;
			}
		}

		if(!isset($order['items']))
		{
			return array();
		}

		$installedItems = array();
		$status_array = array(0,1);
		//$ret = IProductInstallMentBookTTC::get($uid, array('SoSysNo' => $order['order_id']), array());

		$ret = IInstallApi::getList($uid, $order['order_id'], 1, 10);
		//var_dump($ret);

		if(!empty($ret)){
			foreach($ret['data']['Items'] AS $item){
				$installedItems_each = array();
				if(in_array($item['Status'], $status_array)){
					$installedItems_each['SoSysNo'] = $item['SoSysNo'];
					$installedItems_each['ProductSysNo'] = $item['ProductSysNo'];
					$installedItems_each['SysNo'] = $item['ReqSysNo'];
					$installedItems_each['Status'] = $item['Status'];
					$installedItems_each['InstallTime'] = $item['EVisitDate'];
					$installedItems_each['CreateTime'] = $item['CreateTime'];
					array_push($installedItems,$installedItems_each);
				}
			}
		}

		if(count($installedItems) != 0)
		{
			foreach ($order['items'] as $key => $oit)
			{
				foreach($installedItems as $iis)
				{
					if($oit['product_id'] == $iis['ProductSysNo'])
					{
						$order['items'][$key]['install_info'][] = $iis;
					}
				}
			}
		}

		return $order;
	}

}
// End Of Script