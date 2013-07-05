<?php
/* 产品匹配类型
 1 ：随心配
 2 ：同价位热销榜
 3 ： 同类商品
 4 ： 你可能还喜欢
*/


/*错误码定义
1000: 品牌id不合法
1001：商品型号不合法
1002：三级分配不合法
1003：二级分类不存在
1004：一级分类不存在
*/


class IProductRelativity
{
	public static $errCode = 0;
	public static $errMsg = '';

	//一级类目的url
	public static $c1idUrl = array(
		'1009' => 'http://www.51buy.com/appliances_electric.html',
		'384'  => 'http://www.51buy.com/automobile_maintenance.html',
		'1005' => 'http://www.51buy.com/computer_hardware.html',
		'1563' => 'http://www.51buy.com/household_kitchen.html',
		'1007' => 'http://www.51buy.com/mobile_photography.html',
		'7'    => 'http://www.51buy.com/office_equipment.html',
		'1548' => 'http://www.51buy.com/personal_beauty.html',
		'1545' => 'http://www.51buy.com/popular_dress.html',
		'1544' => 'http://www.51buy.com/sports_outside.html',
		'1541' => 'http://www.51buy.com/gift_toy.html'
	);

	//根据二级类名反查一级类目名和url
	public static $c2name2c1nameurl = array(
		'手机通讯|手机配件'
				=> array('name' => '手机/配件', 'url' => 'http://www.51buy.com/mobile_accessories.html'),

		'摄影摄像|苹果专区|摄影配件|数码存储|娱乐影音|学习阅读'
				=> array('name' => '数码/相机', 'url' => 'http://www.51buy.com/photography_digital.html'),

		'笔记本电脑|台式机电脑'
				=> array('name' => '电脑整机', 'url' => 'http://www.51buy.com/computer_accessories.html'),

		'电脑硬件|音频设备|网络设备|电脑外设'
				=> array('name' => '硬件外设', 'url' => 'http://www.51buy.com/hardware_peripherals.html'),

		'正版软件|整机附件|耗材/服务'
				=> array('name' => '电脑附件', 'url' => 'http://www.51buy.com/accessories.html'),

		'白色家电|电视及影音周边'
				=> array('name' => '大家电', 'url' => 'http://www.51buy.com/appliances_electric.html'),

		'家居电器|家务电器|家装电器|个人护理|健康电器'
				=> array('name' => '生活电器', 'url' => 'http://www.51buy.com/household_electric.html'),

		'烹饪电器|时尚饮食'
				=> array('name' => '厨房电器', 'url' => 'http://www.51buy.com/kitchen_electric.html'),
	);

	//获得与c3id具有相同二级类目的所有三级类目name和id。
	public static function getSameCate3($c3id)
	{
		if (!isset($c3id) || $c3id <= 0) {
			self::$errCode = 1002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "c3id($c3id) is invalid";
			return false;
		}

		$c3Info = ICategoryTTC::get($c3id, array('level'=>3, 'status'=>0), array('parent_id', 'name'));
		if (empty($c3Info)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}
		$c3Info = $c3Info[0];

		$c2id = intval($c3Info['parent_id']);

		$c2Info = ICategoryTTC::get($c2id, array('level'=>2,'status'=>0), array('child_id', 'name'));
		if (empty($c2Info)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}
		$c2Info = $c2Info[0];

		$children_ids = explode(',', $c2Info['child_id']);
		$keys = array();
		foreach ($children_ids as $i)
		{
			$keys[] = intval($i);
		}

		$children_info = ICategoryTTC::gets($keys);
		if (empty($children_info)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}

		$result = array();
		$result['c2name'] = $c2Info['name'];
		$result['children'] = array();
		$i = 0;
		foreach ($children_info as $child)
		{
			if ($child['name'] == '赠品' || $child['status'] != 0) {
				continue;
			}
			$i++;
			$result['children'][$i]['name'] = $child['name'];
			$result['children'][$i]['id'] = $child['id'];
		}

		return $result;
	}

	//根据商品ID获得所属一级类目ID
	public static function getC1ByC3Id($c3_ids){
		if( !is_array( $c3_ids ))	$c3_ids = array( $c3_ids );

		$c3_ids = array_unique($c3_ids);

		$result = ICategoryTTC::gets($c3_ids, array('level'=>3), array('id', 'parent_id'));
		if (empty($result)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}

		$c3info = array();

		$c2_ids = array();
		foreach( $result as $item ){
			$c3info[ $item['id'] ] = $item['parent_id'];
			$c2_ids[] = $item['parent_id'];
		}
		$result = ICategoryTTC::gets($c2_ids, array('level'=>2), array('id', 'parent_id'));
		if (empty($result)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}

		$c1info = array();
		foreach( $result as $item ){
			$c1info[ $item['id'] ] = $item['parent_id'];
		}

		$c1_ids = array();

		foreach( $c3_ids as $c3_id ){
			$c2_id = isset($c3info[ $c3_id ]) ? $c3info[ $c3_id ] : 0;
			if( !empty($c2_id) ){
				$c1_ids[$c3_id] = isset( $c1info[$c2_id] ) ? $c1info[$c2_id] : 0;
			}
			else{
				$c1_ids[$c3_id] = 0;
			}
		}
		return $c1_ids;
	}

	//获得品牌的浏览器路径？？？？？
	public static function getBrowsePath($brandId, $mode, $c3id, $nobrand = false)
	{
		if (!isset($brandId) || $brandId <= 0) {
			self::$errCode = 1000;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "brandId($brandId) is invalid";
			return false;
		}
		if (!isset($mode)) {
			self::$errCode = 1001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "mode($mode) is invalid";
			return false;
		}

		if (!isset($c3id) || $c3id <= 0) {
			self::$errCode = 1002;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "c3id($c3id) is invalid";
			return false;
		}
		$c3Info = ICategoryTTC::get($c3id, array('level'=>3), array('parent_id', 'name'));
		if (empty($c3Info)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}
		$c3Info = $c3Info[0];

		$c2id = intval($c3Info['parent_id']);

		$c2Info = ICategoryTTC::get($c2id, array('level'=>2), array('parent_id', 'name'));
		if (empty($c2Info)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}

		$c2Info = $c2Info[0];


		$c1id = intval($c2Info['parent_id']);

		$c1Info = ICategoryTTC::get($c1id, array('level'=>1), array('parent_id', 'name'));
		if (empty($c1Info)) {
			self::$errCode = ICategoryTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
			return false;
		}

		$c1Info = $c1Info[0];

		if ($nobrand === false) {
			$brandInfo = IManufacturerTTC::get($brandId, array(), array('name'));
			if (empty($brandInfo)) {
				self::$errCode = IManufacturerTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IManufacturerTTC failed]' . IManufacturerTTC::$errMsg;
				return false;
			}
			$brandInfo = $brandInfo[0];
		}


		$result = array();
		$result[1]['url'] = isset(self::$c1idUrl[$c1id]) ? self::$c1idUrl[$c1id] : "";
		$result[1]['name'] = $c1Info['name'];
		$result[1]['id'] = $c1id;
		$result[2]['url'] = "";
		$result[2]['name'] = $c2Info['name'];
		$result[2]['id'] = $c2id;
		$result[3]['url'] = "http://list.51buy.com/" . $c3id . "--------.html";
		$result[3]['name'] = $c3Info['name'];
		$result[3]['id'] = $c3id;
		if ($nobrand === false) {
			$result[4]['url'] = "";
			$result[4]['name'] = $brandInfo['name'] . " " . $mode;
		}

		foreach (self::$c2name2c1nameurl as $c2names => $c1nameurl)
		{
			if (strstr($c2names, $result[2]['name']))
			{
				$result[1]['url'] = $c1nameurl['url'];
				$result[1]['name'] = $c1nameurl['name'];
				break;
			}
		}

		return $result;
	}


    /**
     * Get the information of products by mind accroding to product id, parent id and requirement number
     * @param $product_id_ product id
     * @param $limit_ the requirement number, 0 equal unlimitation
     * @return array(array ('product_id', 'product_char_id', 'name', 'price', 'discount_price'))
     * @future lost the limit number
     */
	//获得随心配商品
    public static function getProductsByMind ($product_id_, $wh_id_, $limit_ = array())
    {
        if (!isset($product_id_) || $product_id_ <= 0)
        {
            self::$errCode = 400;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id_) is invalid";
            return false;
        }

        // Get the products by mind from ProductrRelativityTTC and the products are in store
        $district_id = isset($limit_['district_id']) ? $limit_['district_id'] : 0;

        $products = self::getAvailbleProductsByType($product_id_, $wh_id_, PRODUCT_BY_MIND, array('relative_id', 'property', 'updatetime', 'sortnum'),$district_id);
        if (false === $products)
        {
            return false;
        }

        return $products;
    }

    /**
     * Gets available relative products according to get type.
     * @param int     $product_id_ product id
     * @param int     $wh_id_      warehouse id
     * @param enum    $type_       get type
     * @param array() $need_       need columns.
     * @return array(array('product_id', 'product_char_id', 'name', 'price', 'discount_price'))
     */
    static private function getAvailbleProductsByType($product_id_, $wh_id_, $type_, $need_, $district_id = 0)
    {
        $products = array();
        // Gets relative products info from TTC
        //ixiuzeng添加，广东站的随心配从广东站获取，上海和北京的随心配依然从上海获取
        $wh = $wh_id_;
        if ($type_ == PRODUCT_BY_MIND) {
        	if (1001 == $wh_id_){
        		$wh = 1001;
        	}
        	else{
        		$wh = 1;
        	}
        }

        $items = IProductRelativityTTC::get($product_id_, array('type' => $type_, 'wh_id' => $wh, 'status' => 1), $need_);
        if (false === $items)
        {
            self::$errCode = IProductRelativityTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductRelativityTTC failed]' . IProductRelativityTTC::$errMsg;
            return false;
        }
        else
        {
            // Gets the array of relative product ids
            $relative_ids = array();
            $products_property = array();
            $products_updatetime = array();
            $products_sortnum = array();
            foreach ($items AS $item)
            {
                $relative_ids[] = $item['relative_id'];
                $products_property[$item['relative_id']] = $item['property'];
                $products_updatetime[$item['relative_id']] = $item['updatetime'];
                $products_sortnum[$item['relative_id']] = $item['sortnum'];
            }
            //检查库存，屏蔽跨仓以及没货的随心配

            $relative_ids = IProductInventory::checkInventoryProducts($product_id_,$relative_ids,$wh_id_,$district_id);
            if(false === $relative_ids){
                self::$errCode = IProductInventory::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[checkInventoryProducts failed]' . IProductInventory::$errMsg;
                return false;
            }

            $products_info = IProduct::getProductsInfo($relative_ids, $wh_id_, true, false,$district_id);
            if($products_info === false){
                self::$errCode = IProduct::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProduct failed]' . IProduct::$errMsg;
                return false;
            }

            foreach ($products_info as $product_info)
            {
                // The product must be in store
                if ( 0 < $product_info['num_available'] + $product_info['virtual_num'])
                {
                    // The sale price
                    $price = $product_info['price'] + $product_info['cash_back'];
                    // The discount price is product price add cash cut minus the preferential price which save in property column
                    $discount_price = $price - $products_property[$product_info['product_id']];

                    $product['product_id']      = $product_info['product_id'];
                    $product['product_char_id'] = $product_info['product_char_id'];
                    $product['name']            = $product_info['name'];
                    $product['price']           = (0 < $price) ? $price : 0;
                    $product['discount_price']  = (0 < $discount_price) ? $discount_price : 0;
                    $product['market_price']    = $product_info['market_price'];
                    $product['updatetime']      = $products_updatetime[$product_info['product_id']];
                    $product['sortnum']         = $products_sortnum[$product_info['product_id']];

                    $products[] = $product;
                }
            }
        }

        usort($products, "IProductRelativity::cmpUpdateTime");

        return $products;
    }

	static private function cmpUpdateTime($a, $b)
	{
		if ($a['sortnum'] >= 1 && $a['sortnum'] <= 4 && $b['sortnum'] >= 1 && $b['sortnum'] <= 4)
		{
			if($a['sortnum'] == $b['sortnum'])
				return 0;
			else
				return ($a['sortnum'] < $b['sortnum']) ? -1 : 1;
		}
		else if ($a['sortnum'] >= 1 && $a['sortnum'] <= 4)
		{
			return -1;
		}
		else if ($b['sortnum'] >= 1 && $b['sortnum'] <= 4)
		{
			return 1;
		}
		else
		{
			if($a['updatetime'] == $b['updatetime'])
				return 0;
			else
				return ($a['updatetime'] > $b['updatetime']) ? -1 : 1;
		}
	}
}
