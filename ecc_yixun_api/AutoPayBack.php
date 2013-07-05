<?php
/**贵就赔三期，自动价保接口
 * Created by JetBrains PhpStorm.
 * User: flycgu
 * Date: 13-2-26
 * Time: 下午3:45
 * To change this template use File | Settings | File Templates.
 */
require_once('Config.php');
class EA_AutoPayBack{
	public static $CMEM_KEY = 'autopayback';
	public static $errCode = 0;
	public static $errMsg = "";
	public static $status = array(
		"APB_STATUS_INIT" => -2,//初始状态
		"APB_STATUS_INVALID" => -1,//赔付失败状态
		"APB_STATUS_APPROVAL" => 0,//赔付中状态
		"APB_STATUS_VALID" => 1,//赔付成功状态
		"APB_STATUS_PRICEDIFF" => -3, //赔付差价小于5%
		"APB_STATUS_INVOICE_FORBIDDEN" => -100, //赔付失败，原因：增值税发票订单
		"APB_STATUS_INVENTORY_FORBIDDEN" => -101, //赔付失败，原因：没有库存
		"APB_STATUS_SECONDHAND_FORBIDDEN" => -102, //赔付失败，原因：二手商品
		"APB_STATUS_USER_FORBIDDEN" => -103, //赔付失败，原因：排除炒货商，批发商，企业客户等非个人用户
		"APB_STATUS_ZAOSHI_FORBIDDEN" => -104, //赔付失败，原因：早市
		"APB_STATUS_TIANHEIHEI_FORBIDDEN" => -105, //赔付失败，原因：天黑黑
		"APB_STATUS_XIANSHIQIANGGOU_FORBIDDEN" => -106, //赔付失败，原因：限时抢购
		"APB_STATUS_TUANGOU_FORBIDDEN" => -107, //赔付失败，原因：团购
		"APB_STATUS_ZHOUMOUQINGCANG_FORBIDDEN" => -108, //赔付失败，原因：周末清仓
		"APB_STATUS_ORDERCANCEL_FORBIDDEN" => -109, //赔付失败，原因：订单取消或全部退货
	);
	
	/**
	 * 价保不陪付状态 对应 的不陪付原因
	 * Enter description here ...
	 * @param int $status
	 * @return string
	 */
	public static function getForbiddenReason($status){
		switch ($status){
			case self::$status['APB_STATUS_INVOICE_FORBIDDEN'] :
				return '您的订单开具增值税发票，享受“价格保护”';
			case self::$status['APB_STATUS_INVENTORY_FORBIDDEN'] :
				return '不在补偿范围：订单中的商品无库存';
			case self::$status['APB_STATUS_SECONDHAND_FORBIDDEN'] :
				return '不在补偿范围：二手商品';
			case self::$status['APB_STATUS_USER_FORBIDDEN'] :
				return '不在补偿范围：您的账户非个人用户';
			case self::$status['APB_STATUS_ZAOSHI_FORBIDDEN'] :
				return '不在补偿范围：早市商品';
			case self::$status['APB_STATUS_TIANHEIHEI_FORBIDDEN'] :
				return '不在补偿范围：天黑黑商品';
			case self::$status['APB_STATUS_XIANSHIQIANGGOU_FORBIDDEN'] :
				return '不在补偿范围：限时抢购商品';
			case self::$status['APB_STATUS_TUANGOU_FORBIDDEN'] :
				return '不在补偿范围：团购商品';
			case self::$status['APB_STATUS_ZHOUMOUQINGCANG_FORBIDDEN'] :
				return '不在补偿范围：周末清仓商品';
			case self::$status['APB_STATUS_ORDERCANCEL_FORBIDDEN'] :
				return '不在补偿范围：您的订单已取消';
			default :
				return '';
		}
	}

	public function setErr($code, $msg)
	{
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	public function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg = "";
	}


	/**
	 *
	 * 调用erp接口投递赔付订单
	 * @param array $item
	 * @return -1(错误)/1（正确）/2（重复提交）
	 */
	public static function deliveryOrderItems2ERP($item){
		//参数检查
		if(empty($item) || count($item) == 0){
			self::setErr(1004,"param data error");
			return false;
		}
		//数据预处理
		$post_data['ApplyNo'] = $item['order_char_id'] . "_" . $item['product_id'];
		$post_data['SOID'] = $item['order_char_id'];
		$post_data['SOSysNo'] = intval(substr($item['order_char_id'],2));
		$post_data['ProductID'] = $item['product_char_id'];
		$post_data['ProductName'] = urlencode( mb_convert_encoding($item['name'], 'UTF-8', 'GBK') );
		$post_data['Quantity'] = $item['buy_num'];
		$post_data['OrderPrice'] = $item['real_price']/100;
		$post_data['ComparePrice'] = $item['lowest_price']/100;
		$post_data['Status'] = 0;
		$post_data['OrderTime'] = date("Y-m-d H:i:s",$item['create_time']);
		$post_data['KeepPriceTime'] = date("Y-m-d H:i:s",$item['modify_time']);
		$post_data['Result'] = $item['result'];

		// 调用erp接口，沿用原来贵就赔二期
		global $_IP_CFG;
		$url =  $_IP_CFG['AUTOPAYBACK'] . "/SOService.asmx/InsertKeepPrice";
		$post_data =json_encode(array($post_data));
		$data = "json={$post_data}&StockSysNo={$item['wh_id']}";
		Logger::info("deliveryOrderItems2ERP post_data : \r\n" . var_export($data, true));
		$res = NetUtil::cURLHTTPPost($url,$data, 15);
		Logger::info("deliveryOrderItems2ERP response : \r\n" . var_export($res, true));
		preg_match("/<int xmlns=\"http:\/\/service.ias.icson.com\/\">(\S+)<\/int>/", $res, $matches);

		if(count($matches) == 2){
			$ret = $matches[1];
			if($ret == '1'){
				return 1;
			}
			else if($ret == '2'){
				return 2;
			}
			else {
				return -1;
			}
		} else {
			return -1;
		}
	}


	/**
	 * 调用ERP接口,查询自动价保状态,赔偿积分
	 * @param string $applyno
	 * @param int $stockno
	 * @return array|bool
	 */
	public static function getOrderItemsFromERP($applyno, $stockno){
		global $_IP_CFG;
		$url = $_IP_CFG['AUTOPAYBACK'] . "/SOService.asmx/GetKeepPrice?applyno={$applyno}&StockSysNo={$stockno}";
		$res = NetUtil::cURLHTTPGet($url,15);
		$res = urldecode($res);
		$res = iconv("UTF-8", "GBK//IGNORE", $res);

		preg_match("/<string\s*xmlns=\"http:\/\/service\.ias\.icson\.com\/\">(.*)<\/string>/", $res, $matches);

		if(false === $res){
			$err_msg = basename(__FILE__, '.php') . " |" . __LINE__ . '[url get erp GetKeepPrice faild] applyno:' . $applyno . ' stockno:'. $stockno;
			Logger::err('res:' . $res . $err_msg);
			return false;
		}

		if(empty($matches) || empty($matches[1]) ){
			$err_msg = basename(__FILE__, '.php') . " |" . __LINE__ . '[url get erp GetKeepPrice return data is empty] applyno:' . $applyno . ' stockno:'. $stockno;
			Logger::info('res:' . $res . ' matches:' . var_export($matches, true) . $err_msg);
			return false;
		}

		$return_data = array();
		if(!empty($matches) && count($matches[1]) > 0){
			$temp_data = preg_replace('/.+?({.+}).+/','$1',$matches[1]);
			$res_data = ToolUtil::gbJsonDecode($temp_data);
			if(is_array($res_data) && count($res_data) > 0){
				$return_data['paid_back_price'] = $res_data['CompensatePrice'];
				$return_data['result'] = $res_data['Result'];
			}else{
				self::setErr(1007,"AutoPayBack::getOrderItemsFromERP error,applyno:" . $applyno . " res_data:" . var_export($res_data,true));
				Logger::err(self::$errMsg);
			}
		}

		return $return_data;
	}

	/**
	 * 登录后或者订单详情调用，查看用户成功赔付的记录展示，有没结果的赔付记录则调用ERP的接口获取最新结果。
	 * @param int $uid
	 * @param string $order_char_id
	 * @return array|bool
	 */
	public static function getPayBackInfoMyOrders($uid){
		//参数检查
		if(is_null($uid) || !is_numeric($uid)){
			self::setErr(1005,"param uid error");
			return false;
		}
		$orders = self::getUsersOrders($uid);
		if(false === $orders){
			self::setErr(2001,"getUsersOrders error :" . self::$errMsg);
			return false;
		}
		if(empty($orders)){
			return array();
		}
		foreach($orders as $order){
			$pay_back_info = self::autoPayBack_cmem_get($order['order_char_id']);
			//var_dump($pay_back_info);
			if($pay_back_info === false){
				self::setErr(1005,self::$errMsg);
				Logger::err("autoPayBack_cmem_get error:" . self::$errMsg);
				continue;
			}
			if(empty($pay_back_info)){
				continue;
			}
			foreach($pay_back_info as $k => $info){
				if($info['result'] == self::$status['APB_STATUS_INIT'] || $info['result'] == self::$status['APB_STATUS_APPROVAL']){
					$applyno = $info['order_char_id'] . "_" . $info['product_id'];
					$resp = self::getOrderItemsFromERP($applyno,$info['wh_id']);
					if(false === $resp || empty($resp)){
						self::setErr(self::$errCode,self::$errMsg);
						Logger::err("AutoPayBack::getPayBackInfo获取ERP数据接口错误：" . self::$errMsg);
						//接口获取错误
						continue;
					}
					else{
						$pay_back_info[$k]['paid_back_price'] = $resp['paid_back_price'];
						$pay_back_info[$k]['result'] = $resp['result'];
						$ret = self::autoPayBack_cmem_set($order['order_char_id'],$pay_back_info);
						if(false === $ret){
							Logger::err("cmem设置信息失败：" . $uid . " error:" . self::$errMsg);
						}
						//赔付成功添加消息提示
						if($resp['result'] == self::$status['APB_STATUS_VALID']){
							$msg = "订单" . $pay_back_info[$k]['order_char_id'] . "中的商品" . $pay_back_info[$k]['product_id'] . "已经自动赔付" . $pay_back_info[$k]['paid_back_price'] . "积分";
							ISMS::insertSMS($uid, ISmsBizs::Price_Record, $msg);
						}
					}
				}
			}

		}
		return true;

	}
	/**
	 * 我的订单和订单详情调用，查看用户成功赔付的记录展示，有没结果的赔付记录则调用ERP的接口获取最新结果。
	 * @param string $order_char_id
	 * @return array|bool
	 */
	public static function getOnePayBackInfo($order_char_id){
		//参数检查
		if(!isset($order_char_id) || $order_char_id == ""){
			self::setErr(1005,"param order_char_id error");
			return false;
		}
		$pay_back_info = self::autoPayBack_cmem_get($order_char_id);
		//var_dump($pay_back_info);
		if($pay_back_info === false){
			self::setErr(1005,self::$errMsg);
			Logger::err("autoPayBack_cmem_get error:" . self::$errMsg);
			return false;
		}
		if(empty($pay_back_info)){
			return array();
		}
		return $pay_back_info;

	}

	/**
	 * 我的订单中调用，查看用户成功赔付的记录展示，有没结果的赔付记录则调用ERP的接口获取最新结果。
	 * @param int $uid
	 * @param string $order_char_id
	 * @return array|bool
	 */
	public static function getPayBackInfo($uid, $curPage, $pageSize = 10){
		//参数检查
		if(!isset($uid) || !is_numeric($uid)){
			self::setErr(1005,"param uid error");
			return false;
		}
		if(!isset($curPage) || !is_numeric($curPage)){
			self::setErr(1005,"param curPage error");
			return false;
		}
		//先全量拉取一遍
		$allorders = array();
		$orders = self::getUsersOrders($uid);
		if(false === $orders){
			self::setErr(2002,self::$errMsg);
			Logger::err(self::$errMsg);
			$orders = array();
		}
		$ordersOneMonthAgo = self::getUsersOrdersOneMonthAge($uid);
		if(false === $ordersOneMonthAgo){
			self::setErr(2002,self::$errMsg);
			Logger::err(self::$errMsg);
			$ordersOneMonthAgo = array();
		}
		$allorders = array_merge($ordersOneMonthAgo,$orders);
		$pay_back_info = array();
		foreach($allorders as $k => $order){
			$ret = self::getOnePayBackInfo($order['order_char_id']);
			if(false === $ret){
				self::setErr(2003,self::$errMsg);
				Logger::err(self::$errMsg);
				continue;
			}
			if(empty($ret)){
				continue;
			}
			foreach($ret as $i){
					if(isset($i['result']) && 
						( 
							$i['result'] == EA_AutoPayBack::$status['APB_STATUS_INVALID'] 
							|| $i['result'] == EA_AutoPayBack::$status['APB_STATUS_PRICEDIFF'] 
							|| $i['result'] == EA_AutoPayBack::$status['APB_STATUS_VALID'] 
							|| $i['result'] <= -100
						) 
					){
						$pay_back_info[] = $i;
					}


			}
		}
		if(empty($pay_back_info)){
			return array();
		}
		//倒序数组
		$pay_back_info = array_reverse($pay_back_info);
		$show_info['total'] = count($pay_back_info);
		$show_info['data'] = array_slice($pay_back_info,($curPage-1)*$pageSize,$pageSize);
		return $show_info;
	}

	/**
	 * @param $uid
	 * @return array|bool
	 */
	public static function getUsersOrders($uid){
		if (!isset($uid) || $uid <= 0) {
			self::setErr(2000,"uid error");
			return false;
		}
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid, 'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);
		if (empty($orderDb)) {
			self::setErr($orderDb->errCode,$orderDb->errMsg);
			return false;
		}
		$sql = "select order_char_id from t_orders_{$db_tab_index['table']} where uid=$uid";
		$orders = $orderDb->getRows($sql);
		if (false === $orders) {
			self::setErr($orderDb->errCode,$orderDb->errMsg);
			return false;
		}
		if (count($orders) == 0) {
			return array();
		}
		return $orders;
	}

	/**
	 * @param $uid
	 * @return array|bool
	 */
	public static function getUsersOrdersOneMonthAge($uid){
		if (!isset($uid) || $uid <= 0) {
			self::setErr(2000,"uid error");
			return false;
		}
		$orders = IOrdersTTC::get($uid, array(), array('order_char_id'));
		if (false === $orders) {
			self::setErr(IOrdersTTC::$errCode,IOrdersTTC::$errMsg);
			return false;
		}
		if (count($orders) == 0) {
			return array();
		}
		return $orders;
	}
	/**
	 * 自动价保cmem获取操作封装
	 * @param string $key
	 * @return array|bool|mix
	 */
	public static function autoPayBack_cmem_get($key){
		//参数检查
		if($key == ""){
			self::setErr(1001,"param error");
			return false;
		}
		$ret = EL_SimpleCmem::get(self::$CMEM_KEY,$key);
		if(false === $ret){
			self::setErr(1001,EL_SimpleCmem::errno());
			return false;
		}
		if(null == $ret){
			return array();
		}
		return $ret;
	}

	/**
	 * 自动价保cmem设置/更新操作封装
	 * @param string $key
	 * @param array $value
	 * @return bool
	 */
	public static function autoPayBack_cmem_set($key, $value){
		//参数检查
		if($key == ""){
			self::setErr(1001,"param key error");
			return false;
		}
		if(empty($value)){
			self::setErr(1002,"param value error");
			return false;
		}
		$ret = EL_SimpleCmem::set(self::$CMEM_KEY,$key,$value);
		if(false === $ret){
			self::setErr(1003,EL_SimpleCmem::errno());
			return false;
		}
		return true;
	}

	/**
	 * 自动价保cmem删除操作封装
	 * @param string $key
	 * @return bool
	 */
	public static function autoPayBack_cmem_del($key){
		//参数检查
		if($key == ""){
			self::setErr(1001,"param key error");
			return false;
		}
		$ret = EL_SimpleCmem::del(self::$CMEM_KEY,$key);
		if(false === $ret){
			self::setErr(1003,EL_SimpleCmem::errno());
			return false;
		}
		return true;
	}
}
