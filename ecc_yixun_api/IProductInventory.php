<?php
require_once(PHPLIB_ROOT . 'inc/stockrelation.inc.php');
require_once(PHPLIB_ROOT . 'inc/addressToDC.inc.php');
require_once(PHPLIB_ROOT . 'inc/district.inc.php');


class IProductInventory
{
	public static $errCode = 0;
	public static $errMsg = '';


	// ����ﶨ��
	public static $_StockTips = array(
		// ����4��������Ϊ�ֿ�ı������
		'available'     => "�л����ɵ��ճ���", //����ʵ��

		// ��ʱ�޻�
		'not_available' => "��ʱ�޻�",
		'not_enough'    => "��治��", // not_enough ��ʾ�����������ڿ����ʱ����ʱ�ֿ��л�
		'not_sale'      => "�ݲ�����",
		'invalid_price' => "�ݲ�����", // ��Ʒ��ʼ�����ʱ��Ĭ�ϼ۸�Ϊ999999��������ʾ�ݲ�����

		// ����ӳ�
		'arrival1-3'    => "�л�����������2������",
		'arrival2-7'    => "�л�����������2������",
		'arrival6'      => "�л�����������6������",
		'arrivalN'      => "�л���������",
		'arrival10'     => "�л�����������10������",

		// Ԥ���ӳ�
		'bookingN'      => "�л������ֿ����", //�ӳ�N��
		'bookingDate'   => "�л������ֿ����", //�̶�����
		'bookingNoDate' => "�л������ֿ����", //�ǹ̶�����

	);

	public static $_StockStatus = array(
		'available'     => 0,
		/* 1-99����ֵ ��ʾΪ����*/
		'not_available' => 101,
		'not_enough'    => 102,
		'not_sale'      => 103,
		'invalid_price' => 104,

		// ���
		'arrival1-3'    => 201,
		'arrival2-7'    => 202,
		'arrivalN'      => 203, // �̶��ӳ�����
		'arrival6'      => 204,
		'arrival10'     => 205,

		// Ԥ���ӳ�
		'bookingN'      => 210,
		'bookingDate'   => 211, // �̶�����
		'bookingNoDate' => 212, // �ǹ̶�����
	);


	//DC��Ŷ�Ӧ��Ĭ�ϲֺ�
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

	//ÿ��վ��Ӧ��Ĭ��DC���
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
		
		$result = array(); //���ս������
		$supplyStockIds = array(); //���пɹ����ֲֵ�id
		
		//��ʼ��ȡ��Ʒ�Ĺ����ֲ֣��Լ�ȷ�����۷ֲ֡�
		$ret = IProductStockTTC::get($product_id, array('sale_stock_id' => $stock_id, 'status' => 0), array('supply_stock_id'));
		if (false === $ret) {
			self::$errCode = 103;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductStockTTC failed]' . IProductStockTTC::$errMsg;
	
			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
	
		//ÿ����Ʒֻ�����ڳ�������������µ�һ���ֿ��г��֣����ֻҪ�ҵ���һ�����۷ֲ֣���ô�ͽ�����
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
		//������ȡ��Ʒ�Ĺ����ֲ�
		
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
		@desc:	��ȡĳ����Ʒ��ĳ����վ(����)�Ŀ��
		@param: product_id,һ����Ʒ��id; 
				wh_id,��վ(����)��id��
		@return:һά���飬
		array(
			��supply_stock_id��=> �����ֲ�id,
			��num_available��=>���ÿ��,
			��virtual_num��=>�����棬
			��sale_stock_id��=> ���۷ֲ�id,
		)
	*/

	//û�п����ͳһ����false�����øú����ķ�����Ҫ�Է���ֵΪfalseʱ���д���
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


		//��ʼ����������ַ��ȡΨһ��Ӧ��DC,Ŀ������
		$des_dc = self::getDCFromDistrict($district_id, $wh_id);
		if(empty($des_dc))
		{
			self::$errCode = 102;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "district has no DC";

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		//����


		//��ȡDC�µ�Ĭ�ϲ֣��Լ�Ĭ�ϲֶ�Ӧ�����۲�
		$default_stock = self::$_DC_Default_Stock[$des_dc];   //DC��Ӧ��Ĭ�ϲ�


		//����Ĭ�ϲ��ҵ����еĹ�����
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


		//��ʼ��ȡ���пɹ����ֲֵĿ��
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


		//�������ȼ�������п��Ĺ������еĿ��
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
		@desc:	��ȡ�����Ʒ��ĳ����վ(����)�Ŀ��
		@param: product_ids������array(��Ʒid1, ��Ʒid2)�������Ʒid; 
				wh_id,��վ(����)��id��
		@return:һά���飬
		array(
			��Ʒid1 => array(
				'product_id' => ��Ʒid,
				��sale_stock_id��=> ���۷ֲ�id,
				��supply_stock_id��=> �����ֲ�id,
				��num_available��=>���ÿ��,
				��virtual_num��=>������),
			),
			��Ʒid2 => array(
				'product_id' => ��Ʒid,
				��sale_stock_id��=> ���۷ֲ�id,
				��supply_stock_id��=> �����ֲ�id,
				��num_available��=>���ÿ��,
				��virtual_num��=>������),
			),
		)
	*/
	//û�п����ͳһ����false�����øú����ķ�����Ҫ�Է���ֵΪfalseʱ���д���
	public static function getProductsInventeory($product_ids, $wh_id, $district_id = 0)
	{
		if (!isset($product_ids) || !is_array($product_ids)) //����������
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


		//��ʼ ����������ַ��ȡΨһ��Ӧ��DC,Ŀ������
		$des_dc = self::getDCFromDistrict($district_id, $wh_id);
		if(empty($des_dc))
		{
			self::$errCode = 202;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "district has no DC";

			Logger::err("(" . self::$errCode . ")" . self::$errMsg);
			return false;
		}
		//����


		//��ȡDC�µ�Ĭ�ϲ�
		$default_stock = self::$_DC_Default_Stock[$des_dc];   //DC��Ӧ��Ĭ�ϲ�


		///��ʼ ȷ��ÿ����Ʒ�����۲�
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

		$supplyStockIds = array();  //�������¼ÿ����Ʒ�����۲�
		foreach($ret_product_stock as $data)
		{
			$supplyStockIds[$data['product_id']][] = $data['supply_stock_id'];
		}
		///���� ȷ��ÿ����Ʒ�����۲�


		///��ʼ ÿ����Ʒ�����вֵĿ��
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
		///���� ÿ����Ʒ�����вֵĿ��



		///��ʼ ÿ����Ʒ�ڸ��������ֵĿ������
		$supplyStockInventorys = array();
		foreach ($allInventorys as $inventory)
		{
			if (isset($supplyStockIds[$inventory['product_id']]) && in_array($inventory['stock_id'], $supplyStockIds[$inventory['product_id']]))
			{
				$supplyStockInventorys[$inventory['product_id']][$inventory['stock_id']] = $inventory;
			}
		}
		///���� ÿ����Ʒ�ڸ��������ֵĿ������


		$result = array();  //���صĲ���
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


		///�������ȼ���ߵĹ������еĿ��
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
		��ȡָ����Ʒ ָ�������ֵĿ�棨��Ҫ������Ʒ��棩
		@name:	getProductsInventeoryWithSupplyStock
		@desc:	��ȡ�����Ʒ��ĳ����վ(����)�Ŀ��
		@param: product_ids������array(��Ʒid1=>������id, ��Ʒid2=>������id); 
				wh_id,��վ(����)��id��
		@return:һά���飬
		array(
			��Ʒid1 => array(
				'product_id' => ��Ʒid,
				��sale_stock_id��=> ���۷ֲ�id,
				��supply_stock_id��=> �����ֲ�id,
				��num_available��=>���ÿ��,
				��virtual_num��=>������),
			),
			��Ʒid2 => array(
				'product_id' => ��Ʒid,
				��sale_stock_id��=> ���۷ֲ�id,
				��supply_stock_id��=> �����ֲ�id,
				��num_available��=>���ÿ��,
				��virtual_num��=>������),
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

	// ������Ʒ�ķ�վ�Ŀ����Ϣ��������
	public static function setProductsInventoryInfo($productIds, $wh_id, $productWhInfo , $district_id = 0)
	{
		//ixiuzeng��ӻ�ȡ�����Ʒ�Ŀ��
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

	// ������Ʒ�ķ�վ�Ŀ����Ϣ��������
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
     * �ײͺ����������β����,��$product_ids����$main_product����ͬһ�������ֵ���Ʒid���˵������ع��˺��$product_ids����
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
        if (!isset($product_ids) || !is_array($product_ids)) //����������
        {
            self::$errCode = 200;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_ids($product_ids) is invalid";
            Logger::err("(" . self::$errCode . ")" . self::$errMsg);
            return false;
        }
        $result = array();
        //�Ȼ�ȡ����Ʒ�Ŀ�����
        $mainInventoryInfo = self::getProductInventeory($main_product, $wh_id, $district_id);
        if (false === $mainInventoryInfo){
            return array();
        }
        //�ٻ�ȡ�ײ�������Ʒ�Լ���������Ʒ�Ŀ�����
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
	 * �÷��������ṩ��������ַid���Լ�վid��������ն�Ӧ��DC
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









