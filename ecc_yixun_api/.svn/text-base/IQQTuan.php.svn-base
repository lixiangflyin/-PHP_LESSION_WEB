<?php
/**
 * 封装Q团操作
 * @author clarkyu
 */
class IQQTuan extends IQQTuanAPI{
	public static $errCode = 0;
	public static $errMsg = '';

	private static function setERR($code, $msg) {
		self::$errCode = $code;
		self::$errMsg = is_array($msg) ? implode(',', $msg) : $msg;
	}

	private static function clearERR(){
		self::setERR(0, '');
	}

	/**
	 * 易迅的商品类别转换
	 * @param string $c3_ids 易迅商品的 c3_ids 属性
	 * @param int $level 二类? 一类?
	 * @return string 易迅商品ID, 也许二类,也许一类.
	 */
	public static function getProductType($c3_ids, $level=2) {
		$ret = false;
		$c3_ret = ICategoryTTC::get($c3_ids, array('level'=>3));
		$ret = ICategoryTTC::get($c3_ret[0]['parent_id'], array('level'=>$level));
		if ($level == 1) {
			$ret = ICategoryTTC::get($ret[0]['parent_id'], array('level'=>$level));
		}

		return $ret[0];
	}

	/**
	 * 取得已上传到QQ团购侧的资源列表。
	 * @param string $condStr 拼装SQL的 where 子句
	 * @param int $start 拼装SQL的 limit 部分
	 * @param int $limit 拼装SQL的 limit 部分
	 * @return mixed false 查询失败; array 查询成功
	 */
	public static function getQQTuanResources($where='', $start=0, $limit=100) {
		self::clearERR();

		$whereStr = (empty($where) ? '1=1' : $where) .  ' ORDER BY `sysno` DESC'; //自增列倒序

		$ret = ICPSDao::getRows('t_cps_resource_qqtuan', '*', $whereStr, $start, $limit);
		if (false === $ret) {
			Logger::err(basename(__FILE__) . '-' . __LINE__ . ', query FAILED with msg: ' . ICPSDao::$errMsg);
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
		}

		return $ret;
	}

	/**
	 * 根据传递的 QQ团侧 商品唯一标识, 获得其存储在 t_cps_resource_qqtuan 表中的信息.
	 * @param string $qqTuanId Q团侧商品唯一ID
	 * @param bool $checkEDM 检查 EDM 完整性?
	 * @return mixed false 查询失败; array Q团资源信息.
	 */
	public static function getQQTuanProductInfo($qqTuanId, $appendEDMInfo = false) {
		self::clearERR();

		if (empty($qqTuanId)) {
			self::setERR(500, 'invalid qqtuan id');
			return false;
		}

		$ret = ICPSDao::getRows('t_cps_resource_qqtuan', '*', "`qqtuan_id` = '{$qqTuanId}'");
		if (false === $ret) {
			self::setERR(ICPSDao::$errCode, ICPSDao::$errMsg);
			return false;
		}
		else if (empty($ret)) {
			self::setERR(404, 'no such qqtuan resource');
			return false;
		}
		//else go on
		$ret = $ret[0];

		if ($appendEDMInfo) {
			$edm = self::getEDMInfoByProductId($ret['product_id'], $ret['wh_id']);
			if (false === $edm) {
				Logger::info("cannot fetch edm info for {$ret['product_id']}");
			}
			else {
				$ret['edm'] = $edm;
			}
		}

		return $ret;
	}

	/**
	 * 通过商品ID, 获得商品对应的EDM信息
	 * @param int $pid 商品ID
	 * @param int $wh_id 分站ID
	 * @param bool $all 是否获取全部可用的EDM信息, 默认只返回第一个
	 * @return mixed false 查询失败; array 对应的 EDM 信息
	 */
	public static function getEDMInfoByProductId($pid, $wh_id, $all = false) {
		self::clearERR();

		$mssql = Config::getMSDB("ERP_{$wh_id}");
		if (false === $mssql) {
			self::setERR(500, 'get mssql instance false');
			Logger::err('getEDMInfoByProductId FAILED, get mssql instance false.');
			return false;
		}

		$now = date('Y-m-d H:i:s');
		$sql = "SELECT EDMCode,
								ProductSysNo,
								EDMPrice,
								CONVERT(nvarchar(10), StartDate, 120) as startdate,
								CONVERT(nvarchar(10), EndDate, 120) as enddate,
								IsMobileVerification,
								IsEmailVerification,
								MemberLevelRange
					FROM EDM_Privileges
					WHERE EDMStatus = 1
						AND StartDate <='{$now}'
						AND EndDate >='{$now}'
						AND ProductSysNo = {$pid}
					ORDER BY CreateDate DESC, CheckDate DESC";

		$ret = $mssql->getRows($sql);
		if (false === $ret) {
			Logger::err("get EDM of {$pid} beyond {$now} FAILED");
			self::setERR($mssql->errCode, $mssql->errMsg);
			return false;
		}
		else if (empty($ret)) {
			Logger::err("get EDM of {$pid} beyond {$now} EMPTY");
			self::setERR('501', 'ret is empty');
			return false;
		}
		else {
			return $all ? $ret : $ret[0];
		}
	}

	/**
	 * 上传资源到QQ团购侧
	 * @param array $product_info QQ团购侧需要的商品信息
	 * @return array 上传结果
	 */
	public static function uploadResourceToQQTuan($product_info) {
		self::clearERR();

		$product_info['product_ori_price'] = $product_info['product_ori_price'] * 100; //团购侧以分为单位
		$product_info['product_curr_price'] = $product_info['product_curr_price'] * 100;
		$product_info['real_product_id'] = $product_info['product_id']; //store 'product_id' into another attribute, the real one will be replaced by timestamp.
		$product_info['product_id'] = time(); //using current timestamp as local resource id.

		$xml = self::convertToUploadXML($product_info);
		$ret = self::request(IQQTuanAPI::getRequestUrl('QQTUAN_URL_UPLOAD_B2C'), $xml);
		if (false === $ret) {
			self::setERR(parent::$errCode, parent::$errMsg);
			return false;
		}
		else if ( (!isset($ret['qqgid'])) || empty($ret['qqgid']) ) {
			self::setERR(501, "uploadResourceToQQTuan haven't got QQTuanId, msg is {$ret['retcode']}-{$ret['desc']}.");
			return false;
		}
		else { //获得Q团 gid, 插入一条新的记录
			$ret = ICPSDao::insert('t_cps_resource_qqtuan', array (
				'resource_id' => $product_info['product_id'],
				'product_id' => $product_info['real_product_id'],
				'qqtuan_id' => $ret['qqgid'],
				'edm_code' => $product_info['edm_code'],
				'product_name' => $product_info['product_name'],
				'product_image' => $product_info['product_image'],
				'product_ori_price' => $product_info['product_ori_price'],
				'product_curr_price' => $product_info['product_curr_price'],
				'start_sell_time' => $product_info['start_sell_time'],
				'stop_sell_time' => $product_info['stop_sell_time'],
				'product_type' => $product_info['product_type'],
				'product_url' => $product_info['product_url'],
				'wh_id' => $product_info['wh_id'],
				'status' => 1,
			));
			if ($ret === false) {
				self::setERR(501, basename(__FILE__, '.php') . '|' . __LINE__ . ' [insert qqtuan resource FAILED: '. ICPSDao::$errMsg .']');
				return false;
			}
			else {
				Logger::info("upload ({$product_info['product_id']}, {$product_info['edm_code']}) SUCCESS, qqgid is {$ret['qqgid']}");
				return $ret;
			}
		}
	}

	/**
	 * 从 SQLSVR 处同步销量到 MYSQL, 更新 base_count 字段
	 * @param array $productIds 需要同步销量的商品ID
	 * @param int $whid 分站ID
	 * @return bool 同步成功; 反之失败
	 */
	public static function synLocalSales($productIds, $whid) {
		self::clearERR();

		if (empty($productIds)) {
			Logger::err(basename(__FILE__) . '|' . __LINE__ . ' empty productids');
			self::setERR(500, 'empty productids');
			return false;
		}

		$mssql = Config::getMSDB("ERP_BAK_{$whid}");
		if (false === $mssql) {
			Logger::err(basename(__FILE__) . '|' . __LINE__ . ' get mssql FAILED');
			self::setERR(501, 'get mssql FAILED');
			return false;
		}

		$productIdStr = implode(',', $productIds);
		$salesSql = "SELECT
								si.productsysno AS product_id,
								SUM( si.Quantity - ISNULL(si.ReturnQty, 0) ) AS sales_count
							FROM dbo.SO_Master sm
								INNER JOIN dbo.SO_Item si ON sm.sysno=si.sosysno
							WHERE sm.status IN (4,-5)
								AND si.ProductSysNo in ({$productIdStr})
						GROUP BY si.productsysno";
		$salesRet = $mssql->getRows($salesSql);
		if (false === $salesRet) {
			Logger::err(basename(__FILE__) . '|' . __LINE__ . ' exesql FAILED |' . $mssql->errMsg);
			self::setERR(503, "execute query {$salesSql} FAILED");
			return false;
		}
		else if (empty($salesRet)) {
			Logger::err(basename(__FILE__) . '|' . __LINE__ . ' get an empty resultset');
			self::setERR(504, 'get an empty resultset');
			return false;
		}
		else {
			//获取成功, 更新本地mysql数据
			foreach ($salesRet as &$msRet) {
				$_ret = ICPSDao::update(
					't_cps_resource_qqtuan',
					array (
						'sales_count' => $msRet['sales_count'],
					),
					"`product_id` = '{$msRet['product_id']}' AND `wh_id` = '{$whid}'"
				);
				if ($_ret === false) {
					self::setERR(501, basename(__FILE__, '.php') . '|' . __LINE__ . ' [update qqtuan sales_count FAILED: '. ICPSDao::$errMsg .']');
				}
				else {
					Logger::info("update qqtuan sales_count ({$msRet['product_id']}, {$whid}) SUCCESS");
				}
			}

			return $salesRet;
		}
	}

	/**
	 * 检查注册资源当前的剩余库存
	 * @param array $processIds 其中每个元素需要包含量个属性 product_id, qqtuan_id.
	 * @return mixed 还没想好
	 */
	public static function checkStock(&$records, $whid) {
		//$ret = IProductInfoTTC::get($record['product_id'], array('wh_id' => $whid));
		$ret = IProductInventory::getProductInventeory($records['product_id'], $whid);
		
		if (false === $ret) {
			self::setERR(IProductInventory::$errCode, IProductInventory::$errMsg);
			return false;
		}
		else {
			if (count($ret) == 0) {
				self::setERR(400, 'cannot find product info');
				return false;
			}
			else {
				$product = $ret;
				if ($product['num_available'] + $product['virtual_num'] <= QQTUAN_RESOURCE_WARNING_QUANTITY) { //小余警戒库存，发送cancel请求
					$reqRet = self::cancelResourceToQQTuan($records['qqtuan_id']);
					return $reqRet;
				}
			}
		}
	}

	/**
	 * 同步注册资源的销售量到团购侧
	 * @param array $processIds 其中每个元素需要包含两个属性 qqtuan_id 和 sales_count.
	 * @return mixed false 同步失败; object 同步成功, 获得响应
	 */
	public static function synResourceSales(&$processIds) {
		$spid = QQTUAN_SPID;
		$xmlParts = array();
		foreach ($processIds as &$items) {
			$xmlParts[] = "<item>
	<qqgid>{$items['qqtuan_id']}</qqgid>
	<sellcount>{$items['sales_count']}</sellcount>
</item>";
		}
		$xmlDataStr = implode('', $xmlParts);
		$xml = "<?xml version='1.0' encoding='utf-8' ?>
<groupon>
<ver>1.0</ver>
<spid>{$spid}</spid>
<data>
{$xmlDataStr}
</data>
</groupon>";

		$xml = mb_convert_encoding($xml, 'UTF-8', 'GBK');
		$ret = self::request(IQQTuanAPI::getRequestUrl('QQTUAN_URL_SYNSALES'), $xml);
		if (false === $ret) {
			self::setERR(parent::$errCode, parent::$errMsg);
			return false;
		}
		else { //同步销量成功
			return $ret;
		}
	}

	/**
	 * QQ团资源下架
	 * @param string $qqgid 资源的QQ团购侧ID.
	 * @param int $wh_id 分站ID, 默认为上海
	 * @return array 上传结果
	 */
	public static function cancelResourceToQQTuan($qqgid) {
		self::clearERR();

		$xml = self::convertToCancelXML($qqgid);
		$ret = self::request(IQQTuanAPI::getRequestUrl('QQTUAN_URL_CANCEL'), $xml);
		if (false === $ret) {
			self::setERR(parent::$errCode, parent::$errMsg);
			return false;
		}
		else { //更新status
			$ret = ICPSDao::update(
				't_cps_resource_qqtuan',
				array (
					'status' => 0,
				),
				"`qqtuan_id` = '{$qqgid}' "
			);
			if ($ret === false) {
				self::setERR(501, basename(__FILE__, '.php') . '|' . __LINE__ . ' [update qqtuan resource FAILED: '. ICPSDao::$errMsg .']');
				return false;
			}
			else {
				Logger::info("cancel ({$qqgid}) SUCCESS");
				return $ret;
			}
		}
	}

	/**
	 * 同步订单信息到QQ团购.
	 * @param array $cpsOrder QQ团购侧订单
	 * @return mixed 同步结果
	 */
	public static function synOrder($cpsOrder) {
		self::clearERR();

		$ret = self::_appendAddress($cpsOrder); //添加地址信息
		if (false === $ret) {
			return json_encode(array(
				'retcode' => self::$errCode,
				'desc' => self::$errMsg,
			));
		}

		$xml = self::convertToOrderXML($cpsOrder);
		$ret = self::request(IQQTuanAPI::getRequestUrl('QQTUAN_URL_ORDER_B2C'), $xml);

		if (false === $ret) { //未获得正确返回
			return json_encode(array(
				'retcode' => parent::$errCode,
				'desc' => parent::$errMsg,
			));
		}
		else { //获得正确返回
			if (intval($ret['retcode']) == 0) { //同步成功, 更新 order_status, sync_order_status, sync_time
				$updateRet = ICPSDao::update(
					CPSConfig::getCorrespondingTable(CPSConfig::$providerQQTuan),
					array(
						'sync_order_status' => $cpsOrder['order_status'], //上次推单状态
						'sync_time' => date('Y-m-d H:i:s', time()), //上次推单时间
					),
					"`order_id` = '{$cpsOrder['order_id']}' "
				);

				if (false === $updateRet) {
					return  json_encode(array( 'retcode' => ICPSDao::$errCode, 'desc' => ICPSDao::$errMsg, ));
				}
				else {
					return  json_encode(array( 'retcode' => '0', 'desc' => 'dao update success', ));
				}
			}
			else { //同步失败
				Logger::err('SYNC qqtuan order FAILED' . str_replace(array("\r", "\n"), '', $ret));
				return json_encode($ret);
			}
		}
	}

	/**
	 * 同步 "订单状态更改" 到QQ团购.
	 * @param array $cpsOrder QQ团购侧订单
	 * @return mixed 同步结果
	 */
	public static function synOrderStatus($cpsOrder) {
		self::clearERR();

		$ret = self::_appendExpressInfo($cpsOrder); //添加物流信息
		if (false === $ret) {
			return json_encode(array(
				'retcode' => self::$errCode,
				'desc' => self::$errMsg,
			));
		}

		$xml = self::convertToOrderStatusXML($cpsOrder);
		$ret = self::request(IQQTuanAPI::getRequestUrl('QQTUAN_URL_UPDATE_ORDER_B2C'), $xml);

		if (false === $ret) { //未获得正确返回
			return json_encode(array(
				'retcode' => parent::$errCode,
				'desc' => parent::$errMsg,
			));
		}
		else { //获得正确返回
			if (intval($ret['retcode']) == 0) { //同步成功, 更新 sync_order_status
				$updateRet = ICPSDao::update(
					CPSConfig::getCorrespondingTable(CPSConfig::$providerQQTuan),
					array(
						'sync_order_status' => $cpsOrder['order_status'], //上次推单状态
						'sync_time' => date('Y-m-d H:i:s', time()), //上次推单时间
					),
					"`order_id` = '{$cpsOrder['order_id']}' "
				);
				if (false === $updateRet) {
					return  json_encode(array(
						'retcode' => ICPSDao::$errCode,
						'desc' => ICPSDao::$errMsg,
					));
				}
				else {
					return  json_encode(array(
						'retcode' => '0',
						'desc' => 'dao update success',
					));
				}
			}
			else { //同步失败
				return json_encode($ret);
			}
		}
	}

	/**
	 * 转换请求中的
	 * @param string $data 查询参数, 需要解密, 解码并将 XML 转换成 Array
	 * @return array
	 */
	public static function convertConsultParams($data) {
		self::clearERR();

		$ret = @simplexml_load_string(self::decrypt(str_replace(' ', '+', $data)));
		if (empty($ret)) {
			self::setERR(501, __CLASS__ . '::' . __FUNCTION__ . ', convert query data to xml failed.');
			return false;
		}

		$ret = self::utf2Gbk(self::_objectToArray($ret));
		if (! isset($ret['qqgid']) || empty($ret['qqgid'])) {
			self::setERR(401, __CLASS__ . '::' . __FUNCTION__ . 'none qqgid.');
			return false;
		}

		return $ret;
	}

	/**
	 * 转换查询结果
	 * @param array $orders 查得的订单
	 * @param array $params POST中的参数
	 * @return string xml 形式的结果
	 */
	public static function convertForConsult(&$orders, $params) {
		Logger::info(count($orders) . " orders wait for print {$params['type']}.");

		if ($params['type'] == QQTUAN_CONSULT_DETAIL) {
			return (count($orders) > 0)
				? self::convertForDetailConsult($orders[0])
				: self::resultError('404', 'no such order');
		}
		else if ($params['type'] == QQTUAN_CONSULT_BATCH) {
			return self::convertForBatchConsult($orders);
		}
		else {
			Logger::err('IQQTuan::convertForConsult unknown consult type');
			return self::resultError('500', 'unknown consult type');
		}
	}

	/**
	 * 将查得的订单转换成对应的 XML 格式
	 * @param array $orders
	 * @param string $req
	 * @return string XML格式的响应
	 */
	public static function convertForBatchConsult(&$orders) {
		$spid = QQTUAN_SPID;
		$ret = <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<resp>
	<ver>1.0</ver>
	<spid>{$spid}</spid>
	<retcode>0</retcode>
	<desc>success</desc>
EOL;
		foreach($orders as &$order) {
			$ret .= "<orderid>{$order['order_id']}</orderid>";
		}
		$ret .= '</resp>';

		return $ret;
	}

	/**
	 * 将查得的订单转换成对应的 XML 格式
	 * @param array $orders
	 * @param string $req
	 * @return string XML格式的响应
	 */
	public static function convertForDetailConsult($order) {
		$ret = self::_appendAddress($order); //添加用户信息
		if (false === $ret) {
			return self::resultError(self::$errCode, self::$errMsg);
		}

		$spid = QQTUAN_SPID;
		$ret = <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<resp>
	<ver>1.0</ver>
	<spid>{$spid}</spid>
	<retcode>0</retcode>
	<desc>success</desc>
	<data>
		<qqgid>{$order['qqtuan_id']}</qqgid>
		<openid>{$order['openid']}</openid>
		<openkey>{$order['openkey']}</openkey>
		<orderid>{$order['order_id']}</orderid>
		<count>{$order['buy_count']}</count>
		<pay>{$order['order_pay_amount']}</pay>
		<buytime>{$order['order_create_time']}</buytime>
		<goodsproperty></goodsproperty>
		<name>{$order['name']}</name>
		<mobile>{$order['mobile']}</mobile>
		<tel>{$order['tel']}</tel>
		<address>
			<province>{$order['address']['province']}</province>
			<city>{$order['address']['city']}</city>
			<area>{$order['address']['area']}</area>
			<detail>{$order['address']['detail']}</detail>
			<zip>{$order['address']['zip']}</zip>
		</address>
	</data>
</resp>
EOL;

		return mb_convert_encoding($ret, 'UTF-8', 'GBK');
	}

	/**
	 * 根据条件, 查询Q团订单
	 * @param string $params POST请求中的参数
	 * @param int $start LIMIT 开始列
	 * @param int $limit LIMIT 选取条数
	 * @return mixed FALSE 查询失败; array 查询成功
	 */
	public static function consultRet($params, $where, $start=0, $limit=1000) {
		self::clearERR();

		$mysql = Config::getDB('icson_core');
		if (empty($mysql)) {
			self::setERR(Config::$errCode, Config::$errMsg);
			return false;
		}

		$ret = array();
		if (QQTUAN_CONSULT_DETAIL == $params['type']) {
			if (empty($params['qqgid']) || empty($params['orderid'])) {
				self::setERR('500', __CLASS__ . '::' . __FUNCTION__ . ' qqgid or orderid missing.');
				return false;
			}

			$col= '*';
			$where = "`order_id` = '{$params['orderid']}'";
		}
		else if (QQTUAN_CONSULT_BATCH == $params['type']) {
			if (empty($params['qqgid']) || empty($params['date'])) {
				self::setERR('500', __CLASS__ . '::' . __FUNCTION__ . ' qqgid or date missing.');
				return false;
			}

			$col = 'order_id';
			$date = str_replace('-', '', $params['date']);
			$where = "`qqtuan_id`='{$params['qqgid']}' AND `order_create_time` BETWEEN '{$date}000000' AND '{$date}235959'";
		}

		$ret = ICPSDao::getRows('t_cps_order_qqtuan', $col, $where, $start, $limit);
		if ($ret === false) {
			self::setERR(ICPSDao::$errCode, ICPS::$errMsg);
			return false; //exit
		}
		return $ret; //exit
	}

	/**
	 * 根据条件, 查询Q团订单
	 * @param string $params POST请求中的参数
	 * @param int $start LIMIT 开始列
	 * @param int $limit LIMIT 选取条数
	 * @return mixed FALSE 查询失败; array 查询成功
	 */
	public static function consultSynRet($where, $start=0, $limit=1000) {
		self::clearERR();

		$mysql = Config::getDB('icson_core');
		if (empty($mysql)) {
			self::setERR(Config::$errCode, Config::$errMsg);
			return false;
		}

		$ret = ICPSDao::getRows('t_cps_order_qqtuan', '*', $where, $start, $limit);
		if ($ret === false) {
			self::setERR(400, __CLASS__.'::'. __FUNCTION__ . ' fetch QQTuan consult ret FAILED');
			return false; //exit
		}
		else if (count($ret) == 0) {
			return $ret; //exit
		}

		foreach ($ret as &$order) {
			$op1 = self::_appendSalesCount($order);
			if (false === $op1) {
				return self::resultError(self::$errCode, self::$errMsg);
			}

			$op2 = self::_appendAddress($order); //添加用户信息
			if (false === $op2) {
				return self::resultError(self::$errCode, self::$errMsg);
			}
		}

		return $ret;
	}

	/**
	 * 返回出错相应的XML格式
	 * @param string $code 错误代码
	 * @param string $msg 错误信息
	 * @param string $debug Debug 信息, 如果有必要的话
	 * @return string XML格式的错误响应
	 */
	public static function resultError($code, $msg, $debug=null) {
		$spid =QQTUAN_SPID;
		$debug = empty($debug) ? null : "<debug>{$debug}</debug>";
		return <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<resp>
	<ver>1.0</ver>
	<spid>{$spid}</spid>
	<retcode>{$code}</retcode>
	<desc>{$msg}</desc>
	$debug
	</resp>
EOL;
	}

	/**
	 * 返回空结果集相应的XML格式
	 * @param string $code 错误代码
	 * @param string $msg 错误信息
	 * @param string $debug Debug 信息, 如果有必要的话
	 * @return string XML格式的错误响应
	 */
	public static function resultEmpty() {
		$spid =QQTUAN_SPID;
		return <<<EOL
<?xml version="1.0" encoding="utf-8"?>
<resp>
	<ver>1.0</ver>
	<spid>{$spid}</spid>
	<retcode>0</retcode>
	<desc>success</desc>
	</resp>
EOL;
	}

	/**
	 * 为单个订单添加销量信息
	 * @param array $order 单个订单信息
	 * @return bool TRUE 处理成功; FALSE 处理失败.
	 */
	private static function _appendSalesCount(&$order) {
		self::clearERR();

		$info = self::getQQTuanProductInfo($order['qqtuan_id']);
		if (false === $info) {
			self::setERR(500, __CLASS__ . '::' . __FUNCTION__ . " get resource {$order['qqtuan_id']} FAILED");
			return false;
		}
		else {
			$order['sales_count'] = $info['sales_count'];
			return true;
		}
	}

	/**
	 * 为多个订单添加销量信息
	 * @param array $order 单个订单信息
	 * @return bool TRUE 处理成功; FALSE 处理失败.
	 */
	private static function _appendSalesCountBatch(&$orders) {
		self::clearERR();

		$qqtuanIds = self::_extractKeys($orders, 'qqtuan_id');
		$infos = self::getQQTuanProductInfoBatch($qqtuanIds);
		if (false === $info) {
			Logger::err(__CLASS__ . '::' . __FUNCTION__ . ", get qqtuan_id {$order['qqtuan_id']} FAILED.");
		}
//		foreach ()
		return true;
	}

	/**
	 * 为订单添加"物流信息"
	 * @param array $order
	 * @return bool 操作结果
	 */
	private static function _appendExpressInfo(&$order) {
		self::clearERR();

		$order_flow = IOrder::geOrderFlow($order['uid'], $order['order_id']);

		if (false === $order_flow) {
			if (IOrder::$errCode === -999) {
				Logger::info("cps_express_qqtuan, {$order_id} not exists.");
				return json_encode(array(
					'retcode'=> IOrder::$errCode,
					'desc' => IOrder::$errMsg,
				));
			}
			else {
				Logger::err("order {$order_id}, IOrder::geOrderFlow failed-" . IOrder::$errCode . '-' . IOrder::$errMsg);
				return json_encode(array(
					'retcode'=> IOrder::$errCode,
					'desc' => IOrder::$errMsg,
				));
			}
		}
		else {
			$order['logistic'] = ($order_flow['third_type'] != 0) ? $order_flow['third_type'] : '51buy';
			$order['logisticno'] = ($order_flow['third_sysno'] != 0) ? $order_flow['third_sysno'] : $order['order_id'];
			return true;
		}
	}

	/**
	 * 为单个订单添加物流和用户信息
	 * @param array $order 单个订单信息
	 * @return bool TRUE 处理成功; FALSE 处理失败.
	 */
	private static function _appendAddress(&$order) {
		self::clearERR();

		if (empty($order['uid']) || empty($order['order_id'])) {
			self::setERR(500, __CLASS__ . '::' . __FUNCTION__ . ' uid or order_id missing');
			return false;
		}

		$order_detail = IOrder::getOneOrderDetail($order['uid'], $order['order_id']);
		if (false === $order_detail) {
			self::setERR(500, __CLASS__ . '::' . __FUNCTION__ . ' fetch none order');
			return false;
		}

		$user = IUser::getUserInfo($order['uid']);
		if (false === $user) {
			self::setERR(500, __CLASS__ . '::' . __FUNCTION__ . ' fetch none user');
			return false;
		}

		$order['openid'] = str_replace('Login_QQ__', '', $user['icsonid']);
		$order['name'] = $order_detail['receiver'];
		$order['mobile'] = $order_detail['receiver_mobile'];
		$order['tel'] = $order_detail['receiver_tel'];

		$loc = ToolUtil::getLocInfo($order_detail['receiver_addr_id']);
		// city QTuan侧province和city长度都设定utf-8 128
		$cityname = explode('(',$loc['city_name']);
	 	$city = explode('（', $cityname[0]); 
	 	
		$order['address'] = array(
			'province' => $loc['province_name'],
			'city' => $city[0],
			'area' => (false !== strpos($loc['name'], '(')) ? substr($loc['name'], 0, strpos($loc['name'], '(')) : $loc['name'], //去掉括号部分
			'detail' => $order_detail['receiver_addr'],
			'zip' => strlen(trim($order_detail['receiver_zip']))>10 ? 0 : trim($order_detail['receiver_zip']),
		);

		return true;
	}

	/**
	 * 转换 erp 中的 order_status 到 qqtuan 侧的状态
	 * @param int $status ERP中的订单状态
	 * @return int Q团侧订单状态
	 */
	public static function convertOrderStatus($status, $cpsOrder) {
		$statusMap = array (
			//-1 无效订单; 0-用户已下单; 2-商户已发货; 4-交易结束; 5-退款(不传递)
			'-5' => '4', //部分退货
			'-4' => '4', //全部退货
			'-3' => '4', //主管作废
			'-2' => '4', //客户作废
			'-1' => '4', //员工作废
			'0' => '0', //待审核
			'1' => '0', //待出库
			'2' => '0', //待支付
			'3' => '0', //待主管审
			'4' => '2', //已出库
		);

		if (intval($cpsOrder['pay_online']) == 1) { //针对在线支付的订单，状态有不同
			$statusMap['1'] = QQTUAN_STATUS_WAIT_FOR_EXPRESS; //“待出库”对应有改变

			if (empty($cpsOrder['sync_order_status'])) { //“未推送过”且“作废”的订单全部置为 -1（无效）。
				$statusMap['-5'] = '-1';
				$statusMap['-4'] = '-1';
				$statusMap['-3'] = '-1';
				$statusMap['-2'] = '-1';
				$statusMap['-1'] = '-1';
			}
			//else remain
		}

		return isset($statusMap[$status]) ? $statusMap[$status] : false; //no matching status
	}

	/**
	 * 包裹团购需要的js代码, 在物流响应上.
	 * @param string $json
	 * @return string
	 */
	public static function warpExpressOutter($json) {
		return str_replace('{holder}', $json, QQTUAN_EXPRESS_JS_OUTTER);
	}

	/**
	 * 抽取数组中指定的key, 组成结果集
	 * @param array $objs
	 * @param string $key
	 * @return array
	 */
	private static function _extractKeys(&$objs, $key, $unique=true) {
		$ret = array();
		foreach ($objs as &$item) {
			$ret[] = $item[$key];
		}
		return ($unique) ? array_unique($ret) : $ret;
	}
}

// End Of Script