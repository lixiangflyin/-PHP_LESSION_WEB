<?php
require_once(PHPLIB_ROOT . 'inc/stockrelation.inc.php');
require_once(PHPLIB_ROOT . 'inc/addressToDC.inc.php');
require_once(PHPLIB_ROOT . 'inc/district.inc.php');


class IProductInventory
{
	public static $errCode = 0;
	public static $errMsg = '';


	// 库存语定义
	public static $_StockTips = array(
		// 以下4种描述的为仓库的备货情况
		'available'     => "有货，可当日出库", //本地实库

		// 暂时无货
		'not_available' => "暂时无货",
		'not_enough'    => "库存不足", // not_enough 表示购买数量大于库存量时，此时仓库有货
		'not_sale'      => "暂不销售",
		'invalid_price' => "暂不销售", // 商品初始导入的时候默认价格为999999，对外显示暂不销售

		// 虚库延迟
		'arrival1-3'    => "有货，待备货，2天后出库",
		'arrival2-7'    => "有货，待备货，2天后出库",
		'arrival6'      => "有货，待备货，6天后出库",
		'arrivalN'      => "有货，待备货",
		'arrival10'     => "有货，待备货，10天后出库",

		// 预购延迟
		'bookingN'      => "有货，待仓库调拨", //延迟N天
		'bookingDate'   => "有货，待仓库调拨", //固定日期
		'bookingNoDate' => "有货，待仓库调拨", //非固定日期

	);

	public static $_StockStatus = array(
		'available'     => 0,
		/* 1-99保留值 表示为限运*/
		'not_available' => 101,
		'not_enough'    => 102,
		'not_sale'      => 103,
		'invalid_price' => 104,

		// 虚库
		'arrival1-3'    => 201,
		'arrival2-7'    => 202,
		'arrivalN'      => 203, // 固定延迟天数
		'arrival6'      => 204,
		'arrival10'     => 205,

		// 预购延迟
		'bookingN'      => 210,
		'bookingDate'   => 211, // 固定日期
		'bookingNoDate' => 212, // 非固定日期
	);


	//DC编号对应的默认仓号
	private static  $_DC_Default_Stock = array(
		'SHDC' => 1,
		'NJDC' => 6011,
		'HZDC' => 6021,
		'SZDC' => 1001,
		'GZDC' => 1011,
		'FZDC' => 1021,
		'BJDC' => 2001,
		'QDDC' => 2011,
		'JNDC' => 2021,
		'WHDC' => 3001,
		'CSDC' => 3011,
		'ZZDC' => 3021,
		'CQDC' => 4001,
		'CDDC' => 4011,
		'XADC' => 5001,
		'SYDC' => 7001,
	);

	//每个站对应的默认DC编号
	private static  $_Whid_To_DC = array(
		SITE_SH => 'SHDC',
		SITE_SZ => 'SZDC',
		SITE_BJ => 'BJDC',
		SITE_WH => 'WHDC',
		SITE_CQ => 'CQDC',
		SITE_XA => 'XADC',
	);

	

	public static function getProductStockInventeory($product_id, $stock_id)
	{
		if (!isset($product_id) || $product_id <= 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";
		
			Logger::err("product[$product_id] error. errCode(" . self::$errCode . ")" . self::$errMsg);
		
			return false;
		}
		
		if (!isset($stock_id) || $stock_id <= 0) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "stock_id($stock_id) is invalid";
		
			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		
		$result = array(); //最终结果数组
		$supplyStockIds = array(); //所有可供货分仓的id
		
		//开始获取商品的供货分仓，以及确认销售分仓。
		$ret = IProductStockTTC::get($product_id, array('sale_stock_id' => $stock_id, 'status' => 0), array('supply_stock_id'));
		if (false === $ret) {
			self::$errCode = 103;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductStockTTC failed]' . IProductStockTTC::$errMsg;
	
			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
	
		//每个商品只可能在出现在区域管理下的一个仓库中出现，因此只要找到了一个销售分仓，那么就结束。
		if (!empty($ret)) {
			$result['sale_stock_id'] = $stock_id;
			foreach ($ret as $r) {
				$supplyStockIds[] = $r['supply_stock_id'];
			}
		}
		
		if (empty($supplyStockIds)) {
			self::$errCode = 104;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) has no supply stock";
			Logger::err("(" . $stock_id . " ---" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		$supplyStockIds = array_unique($supplyStockIds);
		//结束获取商品的供货分仓
		
		if (!in_array($stock_id, $supplyStockIds)) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "stock_id($stock_id) not in supply stock";
			Logger::err("(" . $stock_id . " ---" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		
		$inventory = IInventoryStockTTC::get($product_id, array('status' => 0, 'stock_id' => $stock_id), array('product_id', 'stock_id', 'num_available', 'virtual_num', 'account_num'));
		if (empty($inventory)) {
			Logger::err(basename(__FILE__, '.php') . " |" . __LINE__ . "[product_id($product_id) has no inventorys records]");
			return false;
		}
		
		$result['supply_stock_id'] = $inventory[0]['stock_id'];
		$result['num_available'] = $inventory[0]['num_available'];
		$result['virtual_num'] = $inventory[0]['virtual_num'];
		$result['account_num'] = $inventory[0]['account_num'];
		
		return $result;
	}
	
	

	/*
		@name:	getProductInventeory
		@desc:	获取某个商品在某个分站(区域)的库存
		@param: product_id,一个商品的id; 
				wh_id,分站(区域)的id；
		@return:一维数组，
		array(
			‘supply_stock_id’=> 供货分仓id,
			‘num_available’=>可用库存,
			‘virtual_num’=>虚拟库存，
			‘sale_stock_id’=> 销售分仓id,
		)
	*/

	//没有库存是统一返回false，调用该函数的方法需要对返回值为false时进行处理。
	public static function getProductInventeory($product_id, $wh_id, $district_id = 0)
	{
		if (!isset($product_id) || $product_id <= 0)
		{
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) is invalid";

			Logger::err("product[$product_id] error. errCode(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}

		if (!isset($wh_id) || $wh_id <= 0)
		{
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "district_id($district_id) is invalid";

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}


		//开始根据三级地址获取唯一对应的DC,目的区域
		$des_dc = self::getDCFromDistrict($district_id, $wh_id);
		if(empty($des_dc))
		{
			self::$errCode = 102;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "district has no DC";

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		//结束


		//获取DC下的默认仓，以及默认仓对应的销售仓
		$default_stock = self::$_DC_Default_Stock[$des_dc];   //DC对应的默认仓


		//根据默认仓找到所有的供货仓
		$true_supply_stock = array();
		$ret_product_stock = IProductStockTTC::get($product_id, array('sale_stock_id' => $default_stock, 'status' => 0));
		if (empty($ret_product_stock))
		{
			self::$errCode = 103;
			if(false === $ret_product_stock)
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductStockTTC failed]' . IProductStockTTC::$errMsg;
			}
			else
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id) has no supply stock";
			}

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		foreach($ret_product_stock as $data)
		{
			$true_supply_stock[] = $data['supply_stock_id'];
		}


		//开始获取所有可供货分仓的库存
		$allInventory = IInventoryStockTTC::get($product_id, array('status' => 0));
		if (empty($allInventory))
		{
			self::$errCode = 104;
			if(false === $allInventory)
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
			}
			else
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[product_id($product_id) has no inventorys records]";
			}

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}

		$inventorys = array();
		foreach ($allInventory as $ai)
		{
			if (in_array($ai['stock_id'], $true_supply_stock))
			{
				$inventorys[$ai['stock_id']] = $ai;
			}
		}
		if(empty($inventorys))
		{
			Logger::err(basename(__FILE__, '.php') . " |" . __LINE__ . "[product_id($product_id) has no inventorys in supply_stocks]");
			return false;
		}


		//返回优先级最高且有库存的供货仓中的库存
		$result = array(
			'product_id'    => $product_id,
			'sale_stock_id' => $default_stock,
			'supply_stock_id' => $default_stock,
			'num_available' => 0,
			'virtual_num' => 0,
			'account_num' => 0,
		);

		global $_ODO_MODE;
		$odo_mode = isset($_ODO_MODE[$default_stock]) ? $_ODO_MODE[$default_stock] : array();
		if (count($odo_mode) == 0)
		{
			return $result;
		}

		foreach ($odo_mode as $key => $odo)
		{
			if (isset($inventorys[$key]) && (($inventorys[$key]['num_available'] + $inventorys[$key]['virtual_num']) > 0))
			{
				$result['supply_stock_id'] = $key;
				$result['num_available'] = $inventorys[$key]['num_available'];
				$result['virtual_num'] = $inventorys[$key]['virtual_num'];
				$result['account_num'] = $inventorys[$key]['account_num'];
				break;
			}
		}

		return $result;
	}


	/*
		@name:	getProductsInventeory
		@desc:	获取多个商品在某个分站(区域)的库存
		@param: product_ids，数组array(商品id1, 商品id2)，多个商品id; 
				wh_id,分站(区域)的id；
		@return:一维数组，
		array(
			商品id1 => array(
				'product_id' => 商品id,
				‘sale_stock_id’=> 销售分仓id,
				‘supply_stock_id’=> 供货分仓id,
				‘num_available’=>可用库存,
				‘virtual_num’=>虚拟库存),
			),
			商品id2 => array(
				'product_id' => 商品id,
				‘sale_stock_id’=> 销售分仓id,
				‘supply_stock_id’=> 供货分仓id,
				‘num_available’=>可用库存,
				‘virtual_num’=>虚拟库存),
			),
		)
	*/
	//没有库存是统一返回false，调用该函数的方法需要对返回值为false时进行处理。
	public static function getProductsInventeory($product_ids, $wh_id, $district_id = 0)
	{
		if (!isset($product_ids) || !is_array($product_ids)) //必须是数组
		{
			self::$errCode = 200;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_ids($product_ids) is invalid";
			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		$product_ids = array_unique($product_ids);

		if (!isset($wh_id) || $wh_id <= 0)
		{
			self::$errCode = 201;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}


		//开始 根据三级地址获取唯一对应的DC,目的区域
		$des_dc = self::getDCFromDistrict($district_id, $wh_id);
		if(empty($des_dc))
		{
			self::$errCode = 202;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "district has no DC";

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		//结束


		//获取DC下的默认仓
		$default_stock = self::$_DC_Default_Stock[$des_dc];   //DC对应的默认仓


		///开始 确认每个商品的销售仓
		$ret_product_stock = IProductStockTTC::gets($product_ids, array('sale_stock_id' => $default_stock, 'status' => 0));
		if (empty($ret_product_stock))
		{
			self::$errCode = 203;
			if(false === $ret_product_stock)
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductStockTTC failed]' . IProductStockTTC::$errMsg;
			}
			else
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "all products has no stocks";
			}

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}

		$supplyStockIds = array();  //该数组记录每个商品的销售仓
		foreach($ret_product_stock as $data)
		{
			$supplyStockIds[$data['product_id']][] = $data['supply_stock_id'];
		}
		///结束 确认每个商品的销售仓


		///开始 每个商品在所有仓的库存
		$allInventorys = IInventoryStockTTC::gets($product_ids, array('status' => 0));
		if (empty($allInventorys))
		{
			self::$errCode = 204;
			if(false === $allInventorys)
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[gets IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;
			}
			else
			{
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "all products has no Inventorys";
			}
			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		///结束 每个商品在所有仓的库存



		///开始 每个商品在各个出货仓的库存数量
		$supplyStockInventorys = array();
		foreach ($allInventorys as $inventory)
		{
			if (isset($supplyStockIds[$inventory['product_id']]) && in_array($inventory['stock_id'], $supplyStockIds[$inventory['product_id']]))
			{
				$supplyStockInventorys[$inventory['product_id']][$inventory['stock_id']] = $inventory;
			}
		}
		///结束 每个商品在各个出货仓的库存数量


		$result = array();  //返回的参数
		foreach ($product_ids as $pid)
		{
			$result[$pid] = array(
				'product_id'      => $pid,
				'sale_stock_id'   => $default_stock,
				'supply_stock_id' => $default_stock,
				'num_available'   => 0,
				'virtual_num'     => 0,
				'account_num'     => 0,
			);
		}


		///返回优先级最高的供货仓中的库存
		global $_ODO_MODE;
		$odo_mode = isset($_ODO_MODE[$default_stock]) ? $_ODO_MODE[$default_stock] : array();
		if (count($odo_mode) == 0)
		{
			return 0;
		}

		foreach($product_ids as $pid)
		{
			foreach ($odo_mode as $stock_id => $odo)
			{
				if( isset($supplyStockInventorys[$pid][$stock_id]) &&
				    ($supplyStockInventorys[$pid][$stock_id]['num_available']+$supplyStockInventorys[$pid][$stock_id]['virtual_num'] > 0) )
				{
					$result[$pid]['supply_stock_id'] = $stock_id;
					$result[$pid]['num_available'] = $supplyStockInventorys[$pid][$stock_id]['num_available'];
					$result[$pid]['virtual_num'] = $supplyStockInventorys[$pid][$stock_id]['virtual_num'];
					$result[$pid]['account_num'] = $supplyStockInventorys[$pid][$stock_id]['account_num'];
					break;
				}
			}
		}

		return $result;
	}

	/*
		获取指定商品 指定出货仓的库存（主要用于赠品库存）
		@name:	getProductsInventeoryWithSupplyStock
		@desc:	获取多个商品在某个分站(区域)的库存
		@param: product_ids，数组array(商品id1=>出货仓id, 商品id2=>出货仓id); 
				wh_id,分站(区域)的id；
		@return:一维数组，
		array(
			商品id1 => array(
				'product_id' => 商品id,
				‘sale_stock_id’=> 销售分仓id,
				‘supply_stock_id’=> 供货分仓id,
				‘num_available’=>可用库存,
				‘virtual_num’=>虚拟库存),
			),
			商品id2 => array(
				'product_id' => 商品id,
				‘sale_stock_id’=> 销售分仓id,
				‘supply_stock_id’=> 供货分仓id,
				‘num_available’=>可用库存,
				‘virtual_num’=>虚拟库存),
			),
		)
	*/
	public static function getProductsInventeoryWithSupplyStock($product_ids)
	{
		if (empty($product_ids)) {
			return array();
		}

		$supplyInventorys = IInventoryStockTTC::gets(array_keys($product_ids), array('status' => 0), array('product_id', 'stock_id', 'num_available', 'virtual_num'));
		if ((false === $supplyInventorys)) {
			self::$errCode = 205;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[gets IInventoryStockTTC failed]' . IInventoryStockTTC::$errMsg;

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}

		$result = array();
		foreach ($product_ids as $pid => $stock) {
			foreach ($supplyInventorys as $sinventory) {
				if ($pid == $sinventory['product_id'] && $stock == $sinventory['stock_id']) {
					$result[$pid] = $sinventory;
					break;
				}
			}
		}
		return $result;
	}

	// 设置商品的分站的库存信息到变量中
	public static function setProductsInventoryInfo($productIds, $wh_id, $productWhInfo , $district_id = 0)
	{
		//ixiuzeng添加获取多个商品的库存
		$productsInventoryInfo = self::getProductsInventeory($productIds, $wh_id, $district_id);

		if (false === $productsInventoryInfo) {
			foreach ($productWhInfo as $key => $wi) {
				$productWhInfo[$key]['virtual_num'] = 0;
				$productWhInfo[$key]['num_available'] = 0;
				$productWhInfo[$key]['psystock'] = $wh_id;
				$productWhInfo[$key]['status'] = PRODUCT_STATUS_VALID;
			}
		} else {
			foreach ($productWhInfo as $key => $wi) {
				$exist = false;
				foreach ($productsInventoryInfo as $psii) {
					if ($psii['product_id'] == $wi['product_id']) {
						$productWhInfo[$key]['virtual_num'] = $psii['virtual_num'];
						$productWhInfo[$key]['num_available'] = $psii['num_available'];
						$productWhInfo[$key]['psystock'] = $psii['supply_stock_id'];
						$exist = true;
						break;
					}
				}

				if (!$exist) {
					$productWhInfo[$key]['virtual_num'] = 0;
					$productWhInfo[$key]['num_available'] = 0;
					$productWhInfo[$key]['psystock'] = $wh_id;
					$productWhInfo[$key]['status'] = PRODUCT_STATUS_VALID;
				}
			}
		}

		return array(
			"productWhInfo" => $productWhInfo,
			"inventoryInfo" => $productsInventoryInfo,
		);
	}

	// 设置商品的分站的库存信息到变量中
	public static function setProductInventoryInfo($product_id, $wh_id, $product, $district_id = 0)
	{
		$ret = self::setProductsInventoryInfo(array($product_id), $wh_id, array($product),$district_id);
		if (false === $ret)
			return false;

		return array(
			"productWhInfo" => $ret['productWhInfo'][0],
			"inventoryInfo" => $ret['inventoryInfo'],
		);
	}


    /**
     * 套餐和随心配屏蔽拆单情况,将$product_ids中与$main_product不在同一个供货仓的商品id过滤掉，返回过滤后的$product_ids数组
     * @param $main_product
     * @param $product_ids
     * @param $wh_id
     * @return array|bool
     */
    public static function checkInventoryProducts($main_product,$product_ids,$wh_id , $district_id = 0){
        if (!isset($main_product) || $main_product <= 0) {
            self::$errCode = 100;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "main_product($main_product) is invalid";
            Logger::err("main_product[$main_product] error. errCode(" . self::$errCode . ")" . self::$errMsg);
            return false;
        }

        if (!isset($wh_id) || $wh_id <= 0) {
            self::$errCode = 101;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "wh_id($wh_id) is invalid";
            Logger::err("(" . self::$errCode . ")" . self::$errMsg);
            return false;
        }
        if (!isset($product_ids) || !is_array($product_ids)) //必须是数组
        {
            self::$errCode = 200;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_ids($product_ids) is invalid";
            Logger::err("(" . self::$errCode . ")" . self::$errMsg);
            return false;
        }
        $result = array();
        //先获取主商品的库存情况
        $mainInventoryInfo = self::getProductInventeory($main_product, $wh_id, $district_id);
        if (false === $mainInventoryInfo){
            return array();
        }
        //再获取套餐其他商品以及随心配商品的库存情况
        $subInventoryInfo = self::getProductsInventeory($product_ids, $wh_id, $district_id);
        if (false === $subInventoryInfo){
            return array();
        }
        foreach($subInventoryInfo as $info){
            if($info['supply_stock_id'] == $mainInventoryInfo['supply_stock_id'] && ($info['num_available']+$info['virtual_num'])>0){
                $result[] = $info['product_id'];
            }
        }
        return $result;
    }

	/*
	 * 该方法根据提供的三级地址id，以及站id，获得最终对应的DC
	 *
	 */
	public static function getDCFromDistrict($district_id, $wh_id)
	{
		global $_District, $_ADDRESS_DC_MODE;
		$city_id = isset($_District[$district_id]['city_id']) ? $_District[$district_id]['city_id'] : 0;
		$province_id = isset($_District[$district_id]['province_id']) ? $_District[$district_id]['province_id'] : 0;

		if(isset($_ADDRESS_DC_MODE[$district_id]))
		{
			$des_dc = $_ADDRESS_DC_MODE[$district_id];
		}
		else if(isset($_ADDRESS_DC_MODE[$city_id]))
		{
			$des_dc = $_ADDRESS_DC_MODE[$city_id];
		}
		else if(isset($_ADDRESS_DC_MODE[$province_id]))
		{
			$des_dc = $_ADDRESS_DC_MODE[$province_id];
		}
		else
		{
			$des_dc = isset(self::$_Whid_To_DC[$wh_id]) ? self::$_Whid_To_DC[$wh_id] : false;
		}

		return $des_dc;
	}

}









