<?php

if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}

require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . "lib/NetUtil.php");
require_once(PHPLIB_ROOT . "lib/Logger.php");

class EA_ServiceFromERP
{
	public static function informOrderCancel($inform_data)
	{
		//检查输入的参数是否都有
		if(empty($inform_data['order_char_id']))
		{
			//记录日志
			Logger::err("inform_erp_order_cancel  err_info: soid is empty");
			return false;
		}
		$post_data['soid'] = $inform_data['order_char_id'];
		$post_data['stockSysNo'] = $inform_data['stock_id'];
		$post_data['operateType'] = $inform_data['status'];
		
		global $_IP_CFG;
		$url = $_IP_CFG['INFORM_ORDER_CANCEL'] . "/Soservice.asmx/CancelSO";
		$data = "soid={$post_data['soid']}&stockSysNo={$post_data['stockSysNo']}&operateType={$post_data['operateType']}";
		Logger::info("inform_erp_order_cancel post_data : \r\n" . var_export($data,true));
		
		$res = NetUtil::cURLHTTPPost($url, $data, 15);
		Logger::info("inform_erp_order_cancel response : \r\n" . var_export($res,true));
		
		return true;
	}
}


