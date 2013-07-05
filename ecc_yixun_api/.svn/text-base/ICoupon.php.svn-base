<?php

require_once(PHPLIB_ROOT . 'lib/DataReport.php');

require_once(PHPLIB_ROOT . 'api/inc/IMerchantsCouponIndexTTC.php');//电信券数据存入@daopingsun
require_once(PHPLIB_ROOT . 'api/inc/ICouponTTC.php');//电信券字样查询比对@daopingsun
require_once(PHPLIB_ROOT . 'api/inc/IMerchantsCouponLogTTC.php');//推单
require_once(PHPLIB_ROOT . 'api/inc/IUserCouponIndexTTC.php');
class ICoupon
{
	public static $errCode = 0;
	public static $errMsg = '';

	public static $CouponType = array(
	'public' => 9,
	'personal' => 8);

	public static $WhId = array(
			0 => "全站",
			1 => "上海",
			1001 => "广东",
			2001 => "北京",
			3001 => "武汉",
            4001 => "重庆",
			5001 => "西安",
	);

	public static function getCoupons($uid, $isCanUse, $page, $pageSize, $wh_id = SITE_SH)
	{
		if ($isCanUse === true) {
			return self::getAvaiableCoupons($uid, $page, $pageSize, $wh_id);
		}else
		{
			return self::getNonAvaiableCoupons($uid, $page, $pageSize, $wh_id) ;
		}
	}
	public static function getAvaiableCoupons($uid, $page, $pageSize, $wh_id=1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}

		$userCou = IUserCouponIndexTTC::get($uid); //展示所有的可用优惠券
		if (false === $userCou)
		{
			self::$errCode = IUserCouponIndexTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserCouponIndexTTC failed]' . IUserCouponIndexTTC::$errMsg;
			return false;
		}


		$couponIds = array();
		foreach ($userCou as $key => $uc)
		{
			$couponIds[] = trim($uc['coupon_code']);
		}
		if (0 == count($couponIds)) {
			return array('total'=>0, 'coupons'=>array());
		}
		$couponInfo = ICouponTTC::gets($couponIds);
		if (false === $couponInfo) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}

		$now = time();
		global $_CouponStatus;
		$resCou = array();
		$i = 0;
		foreach ($couponInfo as $couInfo)
		{
			if ($couInfo['user_id'] == 0) {  //公共优惠券不展示
				continue;
			}else if ($couInfo['user_id'] > 0 && $couInfo['user_id'] != $uid) {
				IUserCouponIndexTTC::remove($uid, array('coupon_code'=>$couInfo['coupon_code']));
				continue;
			}
			if ($couInfo['used_degree']  >= $couInfo['max_use_degree'] ||
				$couInfo['valid_time_to'] < $now ||
				($couInfo['status'] != $_CouponStatus['activated'] && $couInfo['status'] != $_CouponStatus['partly_used']) ) {
				continue;
			}
			foreach ($userCou as $uc)
			{
				if ($couInfo['coupon_code'] == $uc['coupon_code'] && !empty($couInfo['allow_use_time']) && $couInfo['allow_use_time'] <= $uc['used_times']) {
					continue 2;
				}
			}
			$resCou[$i]['coupon_code'] = $couInfo['coupon_code'];
			$resCou[$i]['wh_id'] = $couInfo['wh_id'];
			$resCou[$i]['coupon_id'] = $couInfo['coupon_id'];
			$resCou[$i]['coupon_name'] = $couInfo['coupon_name'];
			$resCou[$i]['sale_amt'] = $couInfo['sale_amt'];
			$resCou[$i]['coupon_amt'] = $couInfo['coupon_amt'];
			$resCou[$i]['coupon_type'] = $couInfo['coupon_type'];
			$resCou[$i]['valid_time_from'] = $couInfo['valid_time_from'];
			$resCou[$i]['valid_time_to'] = $couInfo['valid_time_to'];
			$resCou[$i]['batchno'] = $couInfo['batchno'];
			if($couInfo['valid_time_from'] > $now)
			{
				$resCou[$i]['status_desc'] = "未到有效期";
			}else if($couInfo['used_degree']  >= $couInfo['max_use_degree'])
			{
				$resCou[$i]['status_desc'] = "已使用";
			}else if($couInfo['status'] != $_CouponStatus['activated'] && $couInfo['status'] != $_CouponStatus['partly_used'])
			{
				$resCou[$i]['status_desc'] = "未激活或已使用";
			}else
			{
				$resCou[$i]['status_desc'] = "可用";
			}
			$i++;
		}
		usort($resCou, "ICoupon::compByBatch");
		$resCou = array_slice($resCou, $page * $pageSize, $pageSize);
		return array('total'=>$i, 'coupons'=>&$resCou);
	}

	private static function compByBatch(&$a, &$b)
	{
		return $a['batchno'] < $b['batchno'];
	}

	public static function getNonAvaiableCoupons($uid, $page, $pageSize, $wh_id)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}

		$userCou = IUserCouponIndexTTC::get($uid); //展示所有的可用优惠券
		if (false === $userCou)
		{
			self::$errCode = IUserCouponIndexTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserCouponIndexTTC failed]' . IUserCouponIndexTTC::$errMsg;
			return false;
		}


		$couponIds = array();
		foreach ($userCou as $key => $uc)
		{
			$couponIds[] = trim($uc['coupon_code']);
		}
		if (0 == count($couponIds)) {
			return array('total'=>0, 'coupons'=>array());
		}
		$couponInfo = ICouponTTC::gets($couponIds);
		if (false === $couponInfo) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}

		$now = time();
		global $_CouponStatus;
		$resCou = array();
		$i = 0;
		foreach ($couponInfo as $couInfo)
		{
			if($couInfo['user_id'] == 0)
			{
				continue;
			}
			$useAbaible = true;
			if ($couInfo['used_degree']  >= $couInfo['max_use_degree'] ||
				$couInfo['valid_time_to'] < $now ||
				($couInfo['status'] != $_CouponStatus['activated'] && $couInfo['status'] != $_CouponStatus['partly_used']) ) {
				$useAbaible = false;
			}
			foreach ($userCou as $uc)
			{
				if ($couInfo['coupon_code'] == $uc['coupon_code'] && !empty($couInfo['allow_use_time']) && $couInfo['allow_use_time'] <= $uc['used_times']) {
					$useAbaible = false;
					break;
				}
			}
			if (false === $useAbaible) {
				$resCou[$i]['coupon_code'] = $couInfo['coupon_code'];
				$resCou[$i]['wh_id'] = $couInfo['wh_id'];
				$resCou[$i]['coupon_id'] = $couInfo['coupon_id'];
				$resCou[$i]['coupon_name'] = $couInfo['coupon_name'];
				$resCou[$i]['sale_amt'] = $couInfo['sale_amt'];
				$resCou[$i]['coupon_amt'] = $couInfo['coupon_amt'];
				$resCou[$i]['coupon_type'] = $couInfo['coupon_type'];
				$resCou[$i]['valid_time_from'] = $couInfo['valid_time_from'];
				$resCou[$i]['valid_time_to'] = $couInfo['valid_time_to'];
				$resCou[$i]['batchno'] = $couInfo['batchno'];
				$resCou[$i]['use_time'] = $couInfo['used_time'];
				$resCou[$i]['orders'] = '';
				if ($couInfo['used_time'] > 0)
				{
					 foreach ($userCou as $uc)
	                {
	                        if ($couInfo['coupon_code'] == $uc['coupon_code']) {
	                                $resCou[$i]['orders'] = $uc['order_ids'];
	                                break;
	                        }
	                }
				}
				if($couInfo['used_degree']  >= $couInfo['max_use_degree'])
				{
					$resCou[$i]['status_desc'] = "已使用";
				}
				else if($couInfo['status'] != $_CouponStatus['activated'] && $couInfo['status'] != $_CouponStatus['partly_used'])
				{
					$resCou[$i]['status_desc'] = "未激活或已使用";
				}else //if($couInfo['valid_time_to'] < $now)
				{
					$resCou[$i]['status_desc'] = "已经过期";
				}

				$i++;
			}
		}
		usort($resCou, "ICoupon::compByUserTime");
		$resCou = array_slice($resCou, $page * $pageSize, $pageSize);
		return array('total'=>$i, 'coupons'=>&$resCou);
	}
	private static function compByUserTime(&$a, &$b)
	{
		return $a['use_time'] <  $b['use_time'];
	}

	public static function checkCoupon($uid, $couponCode, $destination, $payType, $wh_id=1, $clientType=0, $cpInfo = null)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}

		if (!isset($couponCode) || strlen($couponCode) <= 0) {
			self::$errCode = 904;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "couponCode($couponCode)不合法";
			return false;
		}
		$couponCode = trim($couponCode);

		if (!isset($destination) || $destination <= 0) {
			self::$errCode = 900;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination)不合法";
			return false;
		}

		if (!isset($payType) || $payType <= 0) {
			self::$errCode = 905;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payType($payType)不合法";
			return false;
		}

		//获取优惠券资料
		$coupon = ICouponTTC::get($couponCode);
		if (false === $coupon) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}
		if (0 == count($coupon)) {
			self::$errCode = 906;
			self::$errMsg = "该优惠券在当前站点不存在，请检查您的优惠券输入是否有误及您输入的优惠券支持使用的站点。";
			return false;
		}
		$coupon = $coupon[0];

		$now = time();

		if ($coupon['valid_time_from'] > $now) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券尚未生效";
			return false;
		}

		if ($coupon['valid_time_to'] < $now) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券已经过期";
			return false;
		}

		global $_CouponStatus;
		//优惠券状态不合法
		if ($coupon['status'] != $_CouponStatus['activated'] && $coupon['status'] != $_CouponStatus['partly_used']) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券已经使用或尚未激活";
			return false;
		}

		//优惠券总的使用次数已经用完
		if ($coupon['max_use_degree'] <= $coupon['used_degree']) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券已经达到最大使用次数，不能再使用";
			return false;
		}

		if ($coupon['user_id'] > 0){
			if ($coupon['user_id'] != $uid) {
				IUserCouponIndexTTC::remove($uid, array('coupon_code'=>$couponCode));
				self::$errCode = 906;
				self::$errMsg =  "您无权使用该优惠券";
				return false;
			}
		}
		//手机优惠券判断start
		if ($coupon['flag'] != 0){
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) != M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为易迅客户端专享,无法直接在网站端使用,请至对应平台使用";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为易迅wap端专享,无法直接在网站端使用,请至对应平台使用";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为易迅wap端专享和易迅客户端专享,无法直接在网站端使用,请至对应平台使用";
				return false;
			}
			if ($clientType == 1 && ($coupon['flag']&M_BUY_ONLY) != M_BUY_ONLY) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为客户端专享，此处无法使用,请至对应平台使用";
				return false;
			}
			if ($clientType == 2 && ($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为wap端专享，此处无法使用,请至对应平台使用";
				return false;
			}
		}
		//手机优惠券判断end
		
		
		if ($wh_id != $coupon['wh_id'] && $coupon['wh_id'] != SITE_ALL) {
			self::$errCode = 906;
			self::$errMsg =  "该优惠券仅限" . self::$WhId[$coupon['wh_id']] . "站使用";
			return false;
		}

		//检测优惠券使用地区
		if ($coupon['area_coll'] != NULL && $coupon['area_coll'] != "" ) {
			$areas = explode(',', $coupon['area_coll']);

			global $_District;
			if (!in_array($destination,  $areas) &&
			    !in_array($_District[$destination]['city_id'],  $areas) &&
			    !in_array($_District[$destination]['province_id'],  $areas) ) {
				self::$errCode = 906;
				self::$errMsg =  "您所在地区不符合优惠券的使用区域";
				return false;
			}
		}

		//检测优惠券使用支持的支付方式
		if ($coupon['pay_type'] != NULL && $coupon['pay_type'] != "" ) {
			$paytypes = explode(',', $coupon['pay_type']);
			if (!in_array($payType,  $paytypes)) {
				self::$errCode = 906;
				self::$errMsg =  "您选择的支付方式不满足优惠券的使用要求";
				return false;
			}
		}
		//如果优惠券有限制单人最大使用次数
		if ($coupon['allow_use_time'] > 0) {
			$couUserInfo = IUserCouponIndexTTC::get($uid, array('coupon_code'=> $couponCode));
			if (false === $couUserInfo) {
				self::$errCode = IUserCouponIndexTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserCouponIndexTTC failed]' . IUserCouponIndexTTC::$errMsg;
				return false;
			}
			if (isset($couUserInfo[0])) {
				$couUserInfo = &$couUserInfo[0];
				if ($couUserInfo['used_times'] >= $coupon['allow_use_time']) {
					self::$errCode = 906;
					self::$errMsg =  "该优惠券已经使用过" .$couUserInfo['used_times'] . "次，不能再使用,订单号为：" . $couUserInfo['order_ids'] ;
					return false;
				}
			}

		}

		//订单中出特价商品后，订单的金额 >= 优惠券使用需要的最低金额
		if(!$cpInfo) {//拉取购物车中商品		
			$orderItems = IShoppingCart::get($uid);
			if (false === $orderItems) {
				self::$errCode = IShoppingCart::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IShoppingCart failed]' . IShoppingCart::$errMsg;
				return false;
			}
		}
		else { //合约机
			global $_CP_Sp_Data;
			$orderItems = array();
			$contractInfo = ICpContractTTC::get($cpInfo['contract_key']);
			if($contractInfo === false) {
				self::$errCode = IShoppingCart::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICpContractTTC failed]' . ICpContractTTC::$errMsg;
				return false;
			}
			if(empty($contractInfo)) {
				self::$errCode = 906;
				self::$errMsg = '没有找到合约信息';
				return false;
			}
			$contractInfo = $contractInfo[0];
			$sp_id = $contractInfo['sp_id'];
			$card_product_id = $contractInfo['card_id'];
			$orderItems[] = array('product_id' => $card_product_id, 'buy_count' => 1);
			if($contractInfo['product_id'] != $contractInfo['card_id']) { //预存话费 或者 购机入网
				$orderItems[] = array('product_id' => $contractInfo['product_id'], 'buy_count' => 1);
			}
		}

		$product_ids = array();
		foreach ($orderItems as $item)
		{
			$product_ids[] = $item['product_id'];
		}
		//拉取商品的基本信息
		$products = IProduct::getProductsInfo($product_ids, $wh_id, false, false, $destination);
		if (false === $products) {
			self::$errCode = IProductTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductTTC failed]' . IProductTTC::$errMsg;
			return false;
		}
		if($cpInfo) {//如果是合约机需要重写卡的价格
			if($contractInfo['product_id'] != $contractInfo['card_id']) {
				if(($products[$contractInfo['product_id']]['flag'] & CP_YCHF) == CP_YCHF) {
					$service_type = 1;
				}
				else if(($products[$contractInfo['product_id']]['flag'] & CP_GJRW) == CP_GJRW) {
					$service_type = 2;
				}
				else {
					self::$errCode =  906;
					self::$errMsg = "商品{$contractInfo['product_id']}不是定制机";
					return false;
				}
			}
			else {
				$service_type = 4;
			}
			if($service_type == 4)
				$packageInfo = ICustomPhone::getPackageOneFee(0, $contractInfo['package_id'], $wh_id);
			else
				$packageInfo = ICustomPhone::getPackageOneFee($contractInfo['product_id'], $contractInfo['package_id'], $wh_id);
			if($packageInfo === false) {
				self::$errCode =  ICustomPhone::$errCode;
				self::$errMsg= basename(__FILE__, '.php') . " |" . __LINE__ . '[ICustomPhone getPackageOneFee failed]' . ICustomPhone::$errMsg;
				return false;
			}
			foreach($products as &$p_item) {
				if($p_item['product_id'] == $card_product_id) {
					if($service_type == 4) {
					}
					else if($service_type == 2) {
						if (!isset($packageInfo['predeposit_fee'])) {
							self::$errCode = 906;
							self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " SIM卡($card_product_id) {{$p_item['name']}} 购机入网 价格获取失败";
							return false;
						}
						$p_item['price'] = $packageInfo['predeposit_fee'] * 100;
					}
					else if($service_type == 1) {
						$p_item['price'] = 0;
					}
					else {
						self::$errCode = 906;
						self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " 非法sp_id:$sp_id";
						return false;
					}
				}
			}
		}
		global $_CouponType;

		//如果是品类优惠券，需要拉取每个商品对应的二级分类，一级分类
		if ($coupon['category_coll'] != "") {
			$c3ids = array();
			foreach ($products as $p)
			{
				$c3ids[] = $p['c3_ids'];
			}
			//获取二级id
			$cates = ICategoryTTC::gets($c3ids, array('level'=>3,'status'=>0));
			if (false === $cates) {
				self::$errCode = ICategoryTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
				return false;
			}

			$c2ids = array();
			foreach ($products as $key => $p)
			{
				foreach ($cates as $c)
				{
					if ($c['id'] == $p['c3_ids']) {
						$products[$key]['c2id'] = intval($c['parent_id']);
						$c2ids[] =  intval($c['parent_id']);
					}
				}
			}
			//获取一级id
			$cates = ICategoryTTC::gets($c2ids, array('level'=>2, 'status'=>0));
			if (false === $cates) {
				self::$errCode = ICategoryTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
				return false;
			}
			foreach ($products as $key => $p)
			{
				foreach ($cates as $c)
				{
					if ($c['id'] == $p['c2id']) {
						$products[$key]['c1id'] = intval($c['parent_id']);
					}
				}
			}
		}

		global $_CouponType;
		//需要订单中指定品牌的商品价格超过优惠券所需价格
		if ( $coupon['manufactory_coll'] != "" )
		{
			$manufactorList = explode(',', $coupon['manufactory_coll']);

			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if ( ($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT
							|| !in_array($p['manufacturer'],$manufactorList) )
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}
		if ($coupon['category_coll'] != "" ) {
			$cates = explode(',', $coupon['category_coll']);
			$cate1 = array();
			$cate2 = array();
			$cate3 = array();
			foreach ($cates as $cate)
			{
				$cc = explode('_', $cate );
				if ($cc[0] == "C1" || $cc[0] == "c1") {
					$cate1[] = ($cc[1]);
				}else if ($cc[0] == "C2" || $cc[0] == "c2") {
					$cate2[] = ($cc[1]);
				}else if ($cc[0] == "C3" || $cc[0] == "c3") {
					$cate3[] = ($cc[1]);
				}
			}


			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if (($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT
						 || (!in_array($p['c3_ids'], $cate3)
						 && !in_array($p['c2id'], $cate2)
						 &&	!in_array($p['c1id'], $cate1)))
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}

		if ($coupon['product_coll'] != "" )
		{
			if(strncmp($coupon['product_coll'], 'p_',2) == 0)
			{
				$coupon['product_coll'] = substr($coupon['product_coll'], 2);
			}
			$pList = explode(',' , $coupon['product_coll']);
			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if (($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT
						|| !in_array($item['product_id'], $pList))
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}

		if ($coupon['manufactory_coll'] == ""
			&& $coupon['category_coll'] == ""
			&& $coupon['product_coll'] == "" )
		{
			// 整网抵扣
			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if (($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT)
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}

		$orderAmt = 0;
		$subOrder = array();
		if(0 == count($orderItems))
		{
			self::$errCode = 907;
			self::$errMsg = "您购物车中的商品都不在本张优惠券要求的商品范围内，请修改后购买";
			return false;
		}

		foreach($orderItems as $item)
		{
			if (isset($products[$item['product_id']])) {
				$tmp = $products[$item['product_id']]['price'] * $item['buy_count'];
				@$subOrder[$products[$item['product_id']]['psystock']]['orderAmt'] += $tmp;
				@$subOrder[$products[$item['product_id']]['psystock']]['pids'][] = $item['product_id'];
				$orderAmt += $tmp;
			}
		}
		if ($orderAmt < $coupon['sale_amt'])
		{
			self::$errCode = 907;
			self::$errMsg = "符合优惠的购买商品的金额总和不满足使用要求";
			return false;
		}

		//获取用户信息
		$user = array();
		if (($coupon['user_grade_coll'] != NULL && $coupon['user_grade_coll'] != "") ||
			 ($coupon['need_mail_verify'] == 1) || ($coupon['need_mobile_verify'] == 1)) {

			$user = IUser::getUserInfo($uid);
			if (false === $user) {
				self::$errCode = IUser::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUser failed]' . IUser::$errMsg;
				return false;
			}
		}

		if ($coupon['user_grade_coll'] != NULL && $coupon['user_grade_coll'] != "") {
			$gradeList = explode(',', $coupon['user_grade_coll']);
			if (!in_array($user['level'], $gradeList)) {
				self::$errCode = 907;
				self::$errMsg =  "您的会员等级不能使用当前优惠券";
				return false;
			}
		}
		if ($coupon['need_mail_verify'] == 1) {
			if (!isset($user['bindEmail']) || $user['bindEmail'] != 1) {
				self::$errCode = 908;
				self::$errMsg =  "该优惠券需要邮箱验证";
				return false;
			}
		}
		if ($coupon['need_mobile_verify'] == 1) {
			if (!isset($user['bindMobile']) || $user['bindMobile'] != 1) {
				self::$errCode = 909;
				self::$errMsg =  "该优惠券需要手机验证";
				return false;
			}
		}

		//分摊优惠券金额到各个子单
		//ixiuzeng修改：优惠券分摊的bug，增加一种情况——优惠券的优惠金额 > 订单符合要求的总金额
		if ($orderAmt < $coupon['coupon_amt'])
		{
			$coupon['coupon_amt'] = $orderAmt;
		}

		$remain = $coupon['coupon_amt'];
		ksort($subOrder);
		foreach ($subOrder as $key=>$so)
		{
			$tmp = 10 * bcdiv($so['orderAmt'] * $coupon['coupon_amt'] , 10 * $orderAmt, 0);
			$subOrder[$key]['coupon_amt'] = $tmp;
			$remain -= $tmp;
		}
		if (0 != $tmp) {
			$subOrder[$key]['coupon_amt'] += $remain;
		}

		$retArray = array();
		/*******************************START**************************************/		
		//@modified by EdisonTsai on 14:52 2012/11/21 for fix the non-sent bug
		//检查是否电信优惠券 @daopingsun 11:43 2012/9/6
		if(strpos($coupon['coupon_name'] , '上海电信用户专用') !== false ){ //电信券检查逻辑	，优惠券名称存在“电信”字样，优惠券没有用过且已发送给电信端		

			$mid = SHTEL_MID;			
			$rs = IMerchantsCouponIndexTTC::get($mid,array('coupon_code' => $couponCode , 'is_used' => 0));	
			if($rs !== false && count($rs)!= 0){
				$retArray['merchant'] =  1;//电信券增加回传指示字段		
			}else{
				//@added by EdisonTsai on 18:03 2012/11/23 for lock down invalid coupon
				self::$errCode  = 906;
				self::$errMsg	= '优惠券已经使用或尚未激活';
				return false;
				//虽然含‘电信’字样，但该券不是电信券，或者是电信券但还没有发送给电信端（未升效），以后跟进
				//目前限制电信券只能使用一次，所以已用过的电信券在以上代码就能check出来，不会进入else内
			}	
		}
		/*********************************END************************************/	
		$retArray['amt'] = $coupon['coupon_amt'];
		$retArray['batchno'] = $coupon['batchno'];
		$retArray['code'] = $couponCode;
		$retArray['type'] = $coupon['coupon_type'] <= 5? ($coupon['coupon_type'] == 2? 0:1) : $coupon['account_type'];  //整网优惠券，无需分摊到Pm
		$retArray['used_degree'] = $coupon['used_degree'];
		$retArray['max_use_degree'] = $coupon['max_use_degree'];
		$retArray['user_id'] = $coupon['user_id'];
		$retArray['wh_id'] = $coupon['wh_id'];
		$retArray['allow_use_time'] = $coupon['allow_use_time'];
		$retArray['subOrders'] = $subOrder;
		return  $retArray;
	}


	public static function checkAppCoupon($uid, $couponCode, $destination, $payType, $wh_id=1,$productsInfo=array())
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}

		if (!isset($couponCode) || strlen($couponCode) <= 0) {
			self::$errCode = 904;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "couponCode($couponCode)不合法";
			return false;
		}
		$couponCode = trim($couponCode);

		if (!isset($destination) || $destination <= 0) {
			self::$errCode = 900;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination)不合法";
			return false;
		}

		if (!isset($payType) || $payType <= 0) {
			self::$errCode = 905;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payType($payType)不合法";
			return false;
		}

		if(empty($productsInfo))
			return false;
		else
			$orderItems = $productsInfo;

		//获取优惠券资料
		$coupon = ICouponTTC::get(trim($couponCode));
		if (false === $coupon) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}
		if (0 == count($coupon)) {
			self::$errCode = 906;
			self::$errMsg = "该优惠券在当前站点不存在，请检查您的优惠券输入是否有误及您输入的优惠券支持使用的站点。";
			return false;
		}
		$coupon = $coupon[0];

		$now = time();

		if ($coupon['valid_time_from'] > $now) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券尚未生效";
			return false;
		}

		if ($coupon['valid_time_to'] < $now) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券已经过期";
			return false;
		}

		global $_CouponStatus;
		//优惠券状态不合法
		if ($coupon['status'] != $_CouponStatus['activated'] && $coupon['status'] != $_CouponStatus['partly_used']) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券已经使用或尚未激活";
			return false;
		}

		//优惠券总的使用次数已经用完
		if ($coupon['max_use_degree'] <= $coupon['used_degree']) {
			self::$errCode = 906;
			self::$errMsg =  "优惠券已经达到最大使用次数，不能再使用";
			return false;
		}

		if ($coupon['user_id'] > 0){
			if ($coupon['user_id'] != $uid) {
				IUserCouponIndexTTC::remove($uid, array('coupon_code'=>$couponCode));
				self::$errCode = 906;
				self::$errMsg =  "您无权使用该优惠券";
				return false;
			}
		}

		if ($wh_id != $coupon['wh_id'] && $coupon['wh_id'] != SITE_ALL) {
			self::$errCode = 906;
			self::$errMsg =  "该优惠券仅限" . self::$WhId[$coupon['wh_id']] . "站使用";
			return false;
		}
		
		//手机优惠券判断start
		if ($coupon['flag'] != 0){
			if (($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为wap端专享，此处无法使用，请至对应平台使用";
				return false;
			}
		}
		//手机优惠券判断end

		//检测优惠券使用地区
		if ($coupon['area_coll'] != NULL && $coupon['area_coll'] != "" ) {
			$areas = explode(',', $coupon['area_coll']);

			global $_District;
			if (!in_array($destination,  $areas) &&
			    !in_array($_District[$destination]['city_id'],  $areas) &&
			    !in_array($_District[$destination]['province_id'],  $areas) ) {
				self::$errCode = 906;
				self::$errMsg =  "您所在地区不符合优惠券的使用区域";
				return false;
			}
		}

		//检测优惠券使用支持的支付方式
		if ($coupon['pay_type'] != NULL && $coupon['pay_type'] != "" ) {
			$paytypes = explode(',', $coupon['pay_type']);
			if (!in_array($payType,  $paytypes)) {
				self::$errCode = 906;
				self::$errMsg =  "您选择的支付方式不满足优惠券的使用要求";
				return false;
			}
		}
		//如果优惠券有限制单人最大使用次数
		if ($coupon['allow_use_time'] > 0) {
			$couUserInfo = IUserCouponIndexTTC::get($uid, array('coupon_code'=> $couponCode));
			if (false === $couUserInfo) {
				self::$errCode = IUserCouponIndexTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserCouponIndexTTC failed]' . IUserCouponIndexTTC::$errMsg;
				return false;
			}
			if (isset($couUserInfo[0])) {
				$couUserInfo = &$couUserInfo[0];
				if ($couUserInfo['used_times'] >= $coupon['allow_use_time']) {
					self::$errCode = 906;
					self::$errMsg =  "该优惠券已经使用过" .$couUserInfo['used_times'] . "次，不能再使用,订单号为：" . $couUserInfo['order_ids'] ;
					return false;
				}
			}

		}

		//订单中出特价商品后，订单的金额 >= 优惠券使用需要的最低金额

		//手机直接传入过来的商品
		$product_ids = array();
		foreach ($orderItems as $item)
		{
			$product_ids[] = $item['product_id'];
		}
		//拉取商品的基本信息
		$products = IProduct::getProductsInfo($product_ids, $wh_id, false, false, $destination);
		if (false === $products) {
			self::$errCode = IProductTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductTTC failed]' . IProductTTC::$errMsg;
			return false;
		}
		global $_CouponType;

		//如果是品类优惠券，需要拉取每个商品对应的二级分类，一级分类
		if ($coupon['category_coll'] != "") {
			$c3ids = array();
			foreach ($products as $p)
			{
				$c3ids[] = $p['c3_ids'];
			}
			//获取二级id
			$cates = ICategoryTTC::gets($c3ids, array('level'=>3,'status'=>0));
			if (false === $cates) {
				self::$errCode = ICategoryTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
				return false;
			}

			$c2ids = array();
			foreach ($products as $key => $p)
			{
				foreach ($cates as $c)
				{
					if ($c['id'] == $p['c3_ids']) {
						$products[$key]['c2id'] = intval($c['parent_id']);
						$c2ids[] =  intval($c['parent_id']);
					}
				}
			}
			//获取一级id
			$cates = ICategoryTTC::gets($c2ids, array('level'=>2, 'status'=>0));
			if (false === $cates) {
				self::$errCode = ICategoryTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICategoryTTC failed]' . ICategoryTTC::$errMsg;
				return false;
			}
			foreach ($products as $key => $p)
			{
				foreach ($cates as $c)
				{
					if ($c['id'] == $p['c2id']) {
						$products[$key]['c1id'] = intval($c['parent_id']);
					}
				}
			}
		}

		global $_CouponType;
		//需要订单中指定品牌的商品价格超过优惠券所需价格
		if ( $coupon['manufactory_coll'] != "" )
		{
			$manufactorList = explode(',', $coupon['manufactory_coll']);

			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if ( ($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT
							|| !in_array($p['manufacturer'],$manufactorList) )
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}
		if ($coupon['category_coll'] != "" ) {
			$cates = explode(',', $coupon['category_coll']);
			$cate1 = array();
			$cate2 = array();
			$cate3 = array();
			foreach ($cates as $cate)
			{
				$cc = explode('_', $cate );
				if ($cc[0] == "C1" || $cc[0] == "c1") {
					$cate1[] = ($cc[1]);
				}else if ($cc[0] == "C2" || $cc[0] == "c2") {
					$cate2[] = ($cc[1]);
				}else if ($cc[0] == "C3" || $cc[0] == "c3") {
					$cate3[] = ($cc[1]);
				}
			}


			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if (($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT
						 || (!in_array($p['c3_ids'], $cate3)
						 && !in_array($p['c2id'], $cate2)
						 &&	!in_array($p['c1id'], $cate1)))
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}

		if ($coupon['product_coll'] != "" )
		{
			if(strncmp($coupon['product_coll'], 'p_',2) == 0)
			{
				$coupon['product_coll'] = substr($coupon['product_coll'], 2);
			}
			$pList = explode(',' , $coupon['product_coll']);
			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if (($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT
						|| !in_array($item['product_id'], $pList))
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}

		if ($coupon['manufactory_coll'] == ""
			&& $coupon['category_coll'] == ""
			&& $coupon['product_coll'] == "" )
		{
			// 整网抵扣
			foreach ($orderItems as $key=>$item)
			{
				foreach ($products as $p)
				{
					if ($p['product_id'] == $item['product_id'])
					{
						if (($p['flag'] & COUPON_PRODUCT) == COUPON_PRODUCT)
						{
							unset($orderItems[$key]);
						}
						break;
					}
				}
			}
		}

		$orderAmt = 0;
		$subOrder = array();
		foreach($orderItems as $item)
		{
			if (isset($products[$item['product_id']])) {
				$tmp = $products[$item['product_id']]['price'] * $item['buy_count'];
				@$subOrder[$products[$item['product_id']]['psystock']]['orderAmt'] += $tmp;
				@$subOrder[$products[$item['product_id']]['psystock']]['pids'][] = $item['product_id'];
				$orderAmt += $tmp;
			}
		}
		if ($orderAmt < $coupon['sale_amt'])
		{
			self::$errCode = 907;
			self::$errMsg = "符合优惠的购买商品的金额总和不满足使用要求";
			return false;
		}

		//获取用户信息
		$user = array();
		if (($coupon['user_grade_coll'] != NULL && $coupon['user_grade_coll'] != "") ||
			 ($coupon['need_mail_verify'] == 1) || ($coupon['need_mobile_verify'] == 1)) {

			$user = IUser::getUserInfo($uid);
			if (false === $user) {
				self::$errCode = IUser::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUser failed]' . IUser::$errMsg;
				return false;
			}
		}
		
		if ($coupon['user_grade_coll'] != NULL && $coupon['user_grade_coll'] != "") {
			$gradeList = explode(',', $coupon['user_grade_coll']);
			if (!in_array($user['level'], $gradeList)) {
				self::$errCode = 907;
				self::$errMsg =  "您的会员等级不能使用当前优惠券";
				return false;
			}
		}
		if ($coupon['need_mail_verify'] == 1) {
			if (!isset($user['bindEmail']) || $user['bindEmail'] != 1) {
				self::$errCode = 907;
				self::$errMsg =  "该优惠券需要邮箱验证";
				return false;
			}
		}
		if ($coupon['need_mobile_verify'] == 1) {
			if (!isset($user['bindMobile']) || $user['bindMobile'] != 1) {
				self::$errCode = 907;
				self::$errMsg =  "该优惠券需要邮箱验证";
				return false;
			}
		}

		//分摊优惠券金额到各个子单
		//ixiuzeng修改：优惠券分摊的bug，增加一种情况——优惠券的优惠金额 > 订单符合要求的总金额
		if ($orderAmt < $coupon['coupon_amt'])
		{
			$coupon['coupon_amt'] = $orderAmt;
		}
		$remain = $coupon['coupon_amt'];
		ksort($subOrder);
		foreach ($subOrder as $key=>$so)
		{
			$tmp = 10 * bcdiv($so['orderAmt'] * $coupon['coupon_amt'] , 10 * $orderAmt, 0);
			$subOrder[$key]['coupon_amt'] = $tmp;
			$remain -= $tmp;
		}
		if (0 != $tmp) {
			$subOrder[$key]['coupon_amt'] += $remain;
		}

		$retArray = array();
		$retArray['amt'] = $coupon['coupon_amt'];
		$retArray['batchno'] = $coupon['batchno'];
		$retArray['code'] = $couponCode;
		$retArray['type'] = $coupon['coupon_type'] <= 5? ($coupon['coupon_type'] == 2? 0:1) : $coupon['account_type'];  //整网优惠券，无需分摊到Pm
		$retArray['used_degree'] = $coupon['used_degree'];
		$retArray['max_use_degree'] = $coupon['max_use_degree'];
		$retArray['user_id'] = $coupon['user_id'];
		$retArray['wh_id'] = $coupon['wh_id'];
		$retArray['allow_use_time'] = $coupon['allow_use_time'];
		$retArray['subOrders'] = $subOrder;
		return  $retArray;
	}



	public static function getUserCoupon($uid, $wh_id=1)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}

		$coupons = IUserCouponIndexTTC::get($uid);
		if (false === $coupons) {
			self::$errCode = IUserCouponIndexTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserCouponIndexTTC failed]' . IUserCouponIndexTTC::$errMsg;
			return false;
		}

		$couponCodes = array();
		foreach ($coupons as $c)
		{
			if ($c['wh_id'] == $wh_id || $c['wh_id'] == SITE_ALL) {
				$couponCodes[] = trim($c['coupon_code']);
			}
		}

		$couponInfos = ICouponTTC::gets($couponCodes);
		if (false === $couponInfos) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}

		$result = array();
		$now = time();

		global $_CouponStatus;
		$i = 0;
		foreach ($couponInfos as $key=>$coupon)
		{
			if ($coupon['user_id'] == 0) //公共优惠券不展示
			{
				continue;
			}

			if ($coupon['user_id'] > 0 && $coupon['user_id'] != $uid) {
				IUserCouponIndexTTC::remove($uid, array('coupon_code'=>$coupon['coupon_code']));
				continue;
			}
			if ($coupon['valid_time_from'] > $now || $coupon['valid_time_to'] < $now)
			{
				unset($couponInfos[$key]);
                continue;
            }
			if ($coupon['wh_id'] != $wh_id && $coupon['wh_id'] != SITE_ALL)
			{
				unset($couponInfos[$key]);
				continue;
			}
			//优惠券总的使用次数已经用完
			if ($coupon['max_use_degree'] <= $coupon['used_degree']) {
				unset($couponInfos[$key]);
				continue;
			}

			//优惠券状态不合法
			if ($coupon['status'] != $_CouponStatus['activated'] && $coupon['status'] != $_CouponStatus['partly_used']) {
				unset($couponInfos[$key]);
				continue;
			}
			//优惠券单人最大次数已经使用完
			if ($coupon['allow_use_time'] > 0) {
				$used = false;
				foreach ($coupons as $userCou)
				{
					if ($userCou['coupon_code'] == $coupon['coupon_code'] && $userCou['used_times'] >= $coupon['allow_use_time']) {
						unset($couponInfos[$key]);
						$used = true;
						break;
					}
				}
				if (true === $used) {
					unset($couponInfos[$key]);
					continue;
				}
			}


			$result[$i]['code'] = $coupon['coupon_code'];
			$result[$i]['content'] = $coupon['coupon_name'];
			$result[$i]['coupon_amt'] = $coupon['coupon_amt'];
			$result[$i]['valid_time_from'] = date('Y-m-d', $coupon['valid_time_from']);
			$result[$i]['valid_time_to'] =  date('Y-m-d', $coupon['valid_time_to']);
			$i++;
		}
		return  $result;
	}


	/*
		@name: createCouponCode
		@desc: 由城市id和优惠券类型创建couponcode
		@return: 返回couponCode
	*/
	public static function createCouponCode($wh_id, $CouponType)
	{
		$prefix = "";	// 2位
		switch ($wh_id)
		{
			case SITE_ALL:
				$prefix = "AL";
				break;
			case SITE_SH:
				$prefix = "SH";
				break;
			case SITE_SZ:
				$prefix = "SZ";
				break;
			case SITE_BJ:
				$prefix = "BJ";
				break;
            case SITE_CQ:
                $prefix = "CQ";
                break;
            case SITE_WH:
            	$prefix = "WH";
            	break;
			case SITE_XA:
            	$prefix = "XA";
            	break;
			default:
				return false;
				break;
		}
		$couponCode = uniqid();	// 13位
		$suffix = sprintf("%04x", rand(0, 0xffff));	// 4位
		$couponCode = $prefix.$CouponType.$couponCode.$suffix; // 20位
		return strtoupper($couponCode);
	}

	//$num ：生成同一个批次下多张公共优惠券
	public static function genPubCoupon($batchno, $num=1)
	{
		if ($batchno < 0) {
			self::$errCode = -102;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "batch($batchno)不合法";
			return false;
		}

		$msDB = ToolUtil::getMSDBObj('ICSON_CORE');
		if (false === $msDB) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		$sql = "select * from t_coupon_resource where batch=$batchno";
		$couponSource = $msDB->getRows($sql);
		if (false === $couponSource) {
			self::$errCode = $msDB->errCode;
			self::$errMsg = $msDB->errMsg;
			return false;
		}else if (count($couponSource) != 1) {
			self::$errCode = -103;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "coupon source($batchno) is not exist";
			return false;
		}
		$couponSource = $couponSource[0];

		if ($couponSource['coupon_type'] != self::$CouponType['public']) {  //如果是公共优惠券，无需领取
			self::$errCode = -104;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "不是公共优惠券，不能调用该接口";
			return false;
		}
		global $_CouponStatus;
		if ($couponSource['status'] != $_CouponStatus['activated']) {
			self::$errCode = -105;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷状态不是激活";
			return false;
		}

		if ($couponSource['num'] < $couponSource['num_pubed'] + $num) {
			self::$errCode = -106;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷已经超过最大生成张数";
			return false;
		}

		$newCoupon = array(
			'coupon_code' => '',
			'wh_id' => $couponSource['wh_id'],
			'coupon_id' => '',	  //待删除
			'coupon_name' => $couponSource['coupon_name'],
			'coupon_amt' => $couponSource['coupon_amt'],
			'sale_amt' => $couponSource['sale_amt'],
			'coupon_type' => $couponSource['coupon_type'],
			'valid_time_from' => $couponSource['valid_time_from'],
			'valid_time_to' => $couponSource['valid_time_to'],
			'max_use_degree' => $couponSource['max_use_times'],
			'used_degree' => 0,
			'used_time' => 0,
			'batchno' => $couponSource['batch'],
			'status' => $couponSource['status'],
			'category_coll' => $couponSource['category'],
			'product_coll' => $couponSource['productids'],
			'manufactory_coll' => $couponSource['manufactory'],
			'area_coll' => '',   //待删除
			'user_id' => 0,
			'user_grade_coll' => $couponSource['user_grade'],
			'pay_type' => 0,   //待删除
			'allow_use_time' => $couponSource['max_use_times'],
			'need_mail_verify' => $couponSource['need_mail_verify'],
			'need_mobile_verify' => $couponSource['need_mobile_verify']	,
			'account_type' => $couponSource['account_type'],
			'flag' => $couponSource['flag'],
		);

		$succeed = 0;

		$now = date('Y-m-d H:i:s');
		@$clientIP = ToolUtil::getClientIP();

		for ($i = 0; $i < $num; $i++)
		{
			$newCode = self::createCouponCode($couponSource['wh_id'], $couponSource['coupon_type']);
			$newCoupon['coupon_code'] = $newCode;

			$ret = ICouponTTC::insert($newCoupon);
			if (false === $ret) {
				self::$errCode = ICouponTTC::$errCode;
				self::$errMsg = ICouponTTC::$errMsg;
				continue;
			}
			$succeed++;
			echo $newCode . "\n";
			DataReport::report(3100, DATA_TYPE_1DAY, array($couponSource['wh_id'],$couponSource['batch'],0,-1, $clientIP, $now,$newCode));
		}


		//更新优惠券资源表
		$sql = "update t_coupon_resource set num_pubed = num_pubed+$succeed where batch=$batchno";
		$ret = $msDB->execSql($sql);
		if (false === $ret) {
			self::$errCode = $msDB->errCode;
			self::$errMsg = $msDB->errMsg;
			return false;
		}
		return true;
	}

	//$num ：发放张数
	public static function fetchCoupon($uid, $batchno, $num=1, $userLevel = -1) //userLevel,用来上报优惠券发放数据，-1代表调用者没有用户级别，需要函数内获取，>=0代表调用者已经获取用户级别
	{
		if ($uid <= 0) {
			self::$errCode = -101;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}
		if ($batchno < 0) {
			self::$errCode = -102;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "batch($batchno)不合法";
			return false;
		}

		$msDB = ToolUtil::getMSDBObj('ICSON_CORE');
		if (false === $msDB) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		$sql = "select * from t_coupon_resource where batch=$batchno";
		$couponSource = $msDB->getRows($sql);
		if (false === $couponSource) {
			self::$errCode = $msDB->errCode;
			self::$errMsg = $msDB->errMsg;
			return false;
		}else if (count($couponSource) != 1) {
			self::$errCode = -103;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "coupon source($batchno) is not exist";
			return false;
		}
		$couponSource = $couponSource[0];

		if ($couponSource['coupon_type'] == self::$CouponType['public']) {  //如果是公共优惠券，无需领取
			self::$errCode = -104;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "公共优惠券，无需领取";
			return false;
		}
		global $_CouponStatus;
		if ($couponSource['status'] != $_CouponStatus['activated']) {
			self::$errCode = -105;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷状态不是激活";
			return false;
		}

		if ($couponSource['num'] < $couponSource['num_pubed'] + $num) {
			self::$errCode = -106;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷领取完毕";
			return false;
		}
		if ($couponSource['valid_time_from'] < 10000) {  //从领取之日起N天有效的有效期类型
			$couponSource['valid_time_from'] = mktime(0,0,0,date('n'),date('j') + $couponSource['valid_time_from'], date('Y'));
			$couponSource['valid_time_to'] = $couponSource['valid_time_from'] + 24*3600*$couponSource['valid_time_to'] - 1;
		}

		$newCoupon = array(
			'coupon_code' => '',
			'wh_id' => $couponSource['wh_id'],
			'coupon_id' => '',	  //待删除
			'coupon_name' => $couponSource['coupon_name'],
			'coupon_amt' => $couponSource['coupon_amt'],
			'sale_amt' => $couponSource['sale_amt'],
			'coupon_type' => $couponSource['coupon_type'],
			'valid_time_from' => $couponSource['valid_time_from'],
			'valid_time_to' => $couponSource['valid_time_to'],
			'max_use_degree' => $couponSource['max_use_times'],
			'used_degree' => 0,
			'used_time' => 0,
			'batchno' => $couponSource['batch'],
			'status' => $couponSource['status'],
			'category_coll' => $couponSource['category'],
			'product_coll' => $couponSource['productids'],
			'manufactory_coll' => $couponSource['manufactory'],
			'area_coll' => '',   //待删除
			'user_id' => $uid,
			'user_grade_coll' => $couponSource['user_grade'],
			'pay_type' => 0,   //待删除
			'allow_use_time' => $couponSource['max_use_times'],
			'need_mail_verify' => $couponSource['need_mail_verify'],
			'need_mobile_verify' => $couponSource['need_mobile_verify']	,
			'account_type' => $couponSource['account_type'],
			'flag' => $couponSource['flag'],
		);

		$newCouponIndex = array(
			'user_id' => $uid,
			'coupon_code' => '',
			'used_times' => 0,  //主要用来控制公共优惠券的单人使用次数
			'order_ids' => '',
			'wh_id' =>  $couponSource['wh_id'],
		);

		$mysqlDB = ToolUtil::getDBObj('coupon', 1);
		if (false === $mysqlDB) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		//开启事务，插入优惠券表
		$sql = "start transaction";
		$ret = $mysqlDB->execSql($sql);
		if (false === $ret){
			self::$errCode = $mysqlDB->errCode;
			self::$errMsg = $mysqlDB->errMsg;
			return false;
		}
		$codeArr = array();

		for ($i = 0; $i < $num; $i++)
		{
			$newCode = self::createCouponCode($couponSource['wh_id'], $couponSource['coupon_type']);
			$newCoupon['coupon_code'] = $newCode;
			$newCouponIndex['coupon_code'] = $newCode;
			$codeArr[] = $newCode;

			$hash = ToolUtil::TTCStr2Hash($newCode);
			$dbtable = ToolUtil::getCouponDBTableIndex($hash);
			$mysqlDB = ToolUtil::getDBObj('coupon', $dbtable['db']);
			if (false === $mysqlDB) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;
				$sql = "rollback";
				$mysqlDB->execSql($sql);
				return false;
			}

			$ret = $mysqlDB->insert("t_coupon_{$dbtable['table']}", $newCoupon);
			if (false === $ret) {
				self::$errCode = $mysqlDB->errCode;
				self::$errMsg = $mysqlDB->errMsg;

				$sql = "rollback";
				$mysqlDB->execSql($sql);
				return false;
			}
			$dbtable = ToolUtil::getCouponDBTableIndex($uid);
			$mysqlDB = ToolUtil::getDBObj('user_coupon_index', $dbtable['db']);
			if (false === $mysqlDB) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;

				$sql = "rollback";
				$mysqlDB->execSql($sql);
				return false;
			}

			$ret = $mysqlDB->insert("t_user_coupon_index_{$dbtable['table']}", $newCouponIndex);
			if (false === $ret) {
				self::$errCode = $mysqlDB->errCode;
				self::$errMsg = $mysqlDB->errMsg;

				$sql = "rollback";
				$mysqlDB->execSql($sql);
				return false;
			}
		}


		//更新优惠券资源表
		$sql = "update t_coupon_resource set num_pubed = num_pubed+$num where batch=$batchno and num >= num_pubed + $num";
		$ret = $msDB->execSql($sql);
		if (false === $ret) {
			self::$errCode = $msDB->errCode;
			self::$errMsg = $msDB->errMsg;

			$sql = "rollback";
			$mysqlDB->execSql($sql);
			return false;
		}else if (1 != $msDB->getAffectedRows()) {
			self::$errCode = -106;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷领取完毕";

			$sql = "rollback";
			$mysqlDB->execSql($sql);
			return false;
		}

		$sql = "commit";
		$mysqlDB->execSql($sql);

		//插入数据成功,发送异步请求purge TTC
		if($userLevel == -1)
		{
			$userLevel = 0;
			$userInfo = IUser::getUserInfo($uid);
			if (false != $userInfo) {
				$userLevel = $userInfo['level'];
			}
		}
		$now = date('Y-m-d H:i:s');
		$clientIP = ToolUtil::getClientIP();
		$coupon_ttc = Config::getTTC('ICouponTTC');
		$user_coupon_idx_ttc = Config::getTTC('IUserCouponIndexTTC');
		foreach ($codeArr as $code)
		{
			//IAsyTask::purgeTTCData('ICouponTTC', $code);	
			if (!$coupon_ttc->purge($code))
			{
				self::$errCode = -1001;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "ICouponTTC的purge操作失败";
				Logger::err("coupon_ttc purge failed");
			}
			
			DataReport::report(3100, DATA_TYPE_1DAY, array($couponSource['wh_id'],$couponSource['batch'],$uid,$userLevel, $clientIP, $now,$code));
		}
		
		//IAsyTask::purgeTTCData('IUserCouponIndexTTC', $uid);
		if (!$user_coupon_idx_ttc->purge($uid))
		{
			self::$errCode = -1001;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "IUserCouponIndexTTC的purge操作失败";
			Logger::err("user_coupon_index_ttc purge failed");
		}

		return ($num > 1)? $codeArr: $codeArr[0];
	}

	//$$batchnum = array(batchno1=>num1, batchno2=>num2)
	public static function fetchCoupons($uid, $batchnum, $db = null, $userLevel = -1) //$db 不为空的时候，由调用者发起事务和提交事务
	{
		if ($uid <= 0) {
			self::$errCode = -101;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}
		if (!is_array($batchnum) || count($batchnum) <= 0) {
			self::$errCode = -102;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "batchnum($batchnum)不合法";
			return false;
		}

		$msDB = ToolUtil::getMSDBObj('ICSON_CORE');
		if (false === $msDB) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		$sql = "select * from t_coupon_resource where batch in(" . implode(",", array_keys($batchnum)) . ")";
		$couponSources = $msDB->getRows($sql);
		if (false === $couponSources) {
			self::$errCode = $msDB->errCode;
			self::$errMsg = $msDB->errMsg;
			return false;
		}else if (count($couponSources) != count($batchnum)) {
			self::$errCode = -103;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "some source is not exist";
			return false;
		}

		foreach ($couponSources as &$couponSource)
		{
			if ($couponSource['coupon_type'] == self::$CouponType['public']) {  //如果是公共优惠券，无需领取
				self::$errCode = -104;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "公共优惠券，无需领取";
				return false;
			}
			global $_CouponStatus;
			if ($couponSource['status'] != $_CouponStatus['activated']) {
				self::$errCode = -105;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷状态不是激活";
				return false;
			}

			if ($couponSource['num'] < $couponSource['num_pubed'] + $batchnum[$couponSource['batch']]) {
				self::$errCode = -106;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷领取完毕";
				return false;
			}
			if ($couponSource['valid_time_from'] < 10000) {  //从领取之日起N天有效的有效期类型
				$couponSource['valid_time_from'] = mktime(0,0,0,date('n'),date('j') + $couponSource['valid_time_from'], date('Y'));
				$couponSource['valid_time_to'] = $couponSource['valid_time_from'] + 24*3600*$couponSource['valid_time_to'] - 1;
			}

		}
		$mysqlDB = $db;
		if (null == $db) {
			$mysqlDB = ToolUtil::getDBObj('coupon', 1);
			if (false === $mysqlDB) {
				self::$errCode = Config::$errCode;
				self::$errMsg = Config::$errMsg;
				return false;
			}
			//开启事务，插入优惠券表
			$sql = "start transaction";
			$ret = $mysqlDB->execSql($sql);
			if (false === $ret){
				self::$errCode = $mysqlDB->errCode;
				self::$errMsg = $mysqlDB->errMsg;
				return false;
			}
		}

		$codeArr = array();
		$batch_wh = array();
		foreach ($couponSources as $coupon)
		{
			$batch_wh[$coupon['batch']] = $coupon['wh_id'];
			$newCoupon = array(
				'coupon_code' => '',
				'wh_id' => $coupon['wh_id'],
				'coupon_id' => '',	  //待删除
				'coupon_name' => $coupon['coupon_name'],
				'coupon_amt' => $coupon['coupon_amt'],
				'sale_amt' => $coupon['sale_amt'],
				'coupon_type' => $coupon['coupon_type'],
				'valid_time_from' => $coupon['valid_time_from'],
				'valid_time_to' => $coupon['valid_time_to'],
				'max_use_degree' => $coupon['max_use_times'],
				'used_degree' => 0,
				'used_time' => 0,
				'batchno' => $coupon['batch'],
				'status' => $coupon['status'],
				'category_coll' => $coupon['category'],
				'product_coll' => $coupon['productids'],
				'manufactory_coll' => $coupon['manufactory'],
				'area_coll' => '',   //待删除
				'user_id' => $uid,
				'user_grade_coll' => $coupon['user_grade'],
				'pay_type' => 0,   //待删除
				'allow_use_time' => $coupon['max_use_times'],
				'need_mail_verify' => $coupon['need_mail_verify'],
				'need_mobile_verify' => $coupon['need_mobile_verify']	,
				'account_type' => $coupon['account_type'],
				'flag' => $coupon['flag'],
			);

			$newCouponIndex = array(
				'user_id' => $uid,
				'coupon_code' => '',
				'used_times' => 0,  //主要用来控制公共优惠券的单人使用次数
				'order_ids' => '',
				'wh_id' =>  $coupon['wh_id'],
			);

			for ($i = 0; $i < $batchnum[$coupon['batch']]; $i++)
			{
				$newCode = self::createCouponCode($coupon['wh_id'], $coupon['coupon_type']);
				$newCoupon['coupon_code'] = $newCode;
				$newCouponIndex['coupon_code'] = $newCode;
				$codeArr[$coupon['batch']][] = $newCode;
				$hash = ToolUtil::TTCStr2Hash($newCode);
				$dbtable = ToolUtil::getCouponDBTableIndex($hash);
				$mysqlDB = ToolUtil::getDBObj('coupon', $dbtable['db']);
				if (false === $mysqlDB) {
					self::$errCode = Config::$errCode;
					self::$errMsg = Config::$errMsg;
					$sql = "rollback";
					$mysqlDB->execSql($sql);
					return false;
				}

				$ret = $mysqlDB->insert("t_coupon_{$dbtable['table']}", $newCoupon);
				if (false === $ret) {
					self::$errCode = $mysqlDB->errCode;
					self::$errMsg = $mysqlDB->errMsg;

					$sql = "rollback";
					$mysqlDB->execSql($sql);
					return false;
				}
				$dbtable = ToolUtil::getCouponDBTableIndex($uid);
				$mysqlDB = ToolUtil::getDBObj('user_coupon_index', $dbtable['db']);
				if (false === $mysqlDB) {
					self::$errCode = Config::$errCode;
					self::$errMsg = Config::$errMsg;

					$sql = "rollback";
					$mysqlDB->execSql($sql);
					return false;
				}

				$ret = $mysqlDB->insert("t_user_coupon_index_{$dbtable['table']}", $newCouponIndex);
				if (false === $ret) {
					self::$errCode = $mysqlDB->errCode;
					self::$errMsg = $mysqlDB->errMsg;

					$sql = "rollback";
					$mysqlDB->execSql($sql);
					return false;
				}
			}
		}

		$fetchNumArr = array();
		foreach ($batchnum as $batch=>$num)
		{
			$fetchNumArr[$num][] = $batch;
		}
		foreach ($fetchNumArr as $num => $batchs)
		{
			//更新优惠券资源表
			$sql = "update t_coupon_resource set num_pubed = num_pubed+$num where  num >= num_pubed + $num and batch in(" . implode(",",$batchs) . ")";
			$ret = $msDB->execSql($sql);
			if (false === $ret) {
				self::$errCode = $msDB->errCode;
				self::$errMsg = $msDB->errMsg;

				$sql = "rollback";
				$mysqlDB->execSql($sql);
				return false;
			}else if (count($batchs) != $msDB->getAffectedRows()) {
				self::$errCode = -106;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷领取完毕";

				$sql = "rollback";
				$mysqlDB->execSql($sql);
				return false;
			}
		}
		if (null == $db) {
			$sql = "commit";
			$mysqlDB->execSql($sql);
		}

		//插入数据成功,发送异步请求purge TTC
		if($userLevel == -1)
		{
			$userLevel = 0;
			$userInfo = IUser::getUserInfo($uid);
			if (false != $userInfo) {
				$userLevel = $userInfo['level'];
			}
		}
		$now = date('Y-m-d H:i:s');
		$clientIP = ToolUtil::getClientIP();
		$coupon_ttc = Config::getTTC('ICouponTTC');
		$user_coupon_idx_ttc = Config::getTTC('IUserCouponIndexTTC');
		foreach ($codeArr as $batch=>$codes)
		{
			foreach ($codes as $code )
			{
				//IAsyTask::purgeTTCData('ICouponTTC', $code);
				if (!$coupon_ttc->purge($code))
				{
					self::$errCode = -1001;
					self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "ICouponTTC的purge操作失败";
					Logger::err("coupon_ttc purge failed");
				}
				
				DataReport::report(3100, DATA_TYPE_1DAY, array($batch_wh[$batch],$batch,$uid,$userLevel,$clientIP, $now,$code));
			}
		}
		//IAsyTask::purgeTTCData('IUserCouponIndexTTC', $uid);
		if (!$user_coupon_idx_ttc->purge($uid))
		{
			self::$errCode = -1001;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "IUserCouponIndexTTC的purge操作失败";
			Logger::err("user_coupon_index_ttc purge failed");
		}
		return $codeArr;
	}

	public static function insertPubCoupon($batchno)
	{
		if ($batchno < 0) {
			self::$errCode = -102;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "batch($batchno)不合法";
			return false;
		}

		$msDB = ToolUtil::getMSDBObj('ICSON_CORE');
		if (false === $msDB) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		$sql = "select * from t_coupon_resource where batch=$batchno";
		$couponSource = $msDB->getRows($sql);
		if (false === $couponSource) {
			self::$errCode = $msDB->errCode;
			self::$errMsg = $msDB->errMsg;
			return false;
		}else if (count($couponSource) != 1) {
			self::$errCode = -103;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "coupon source($batchno)不存在";
			return false;
		}
		$couponSource = $couponSource[0];

		if ($couponSource['coupon_type'] != self::$CouponType['public']) {  //如果不是公共优惠券，则不能调用该函数
			self::$errCode = -104;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "公共优惠券，无需领取";
			return false;
		}
		global $_CouponStatus;
		if ($couponSource['status'] != $_CouponStatus['activated']) {
			self::$errCode = -105;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "优惠卷状态不是激活";
			return false;
		}

		$newCoupon = array(
			'coupon_code' => $couponSource['coupon_code'],
			'wh_id' => $couponSource['wh_id'],
			'coupon_id' => '',	  //待删除
			'coupon_name' => $couponSource['coupon_name'],
			'coupon_amt' => $couponSource['coupon_amt'],
			'sale_amt' => $couponSource['sale_amt'],
			'coupon_type' => $couponSource['coupon_type'],
			'valid_time_from' => $couponSource['valid_time_from'],
			'valid_time_to' => $couponSource['valid_time_to'],
			'max_use_degree' => $couponSource['num'],   //该券最大使用次数总和
			'used_degree' => $couponSource['num_pubed'],  //已经使用次数总和
			'used_time' => 0,
			'batchno' => $couponSource['batch'],
			'status' => $couponSource['status'],
			'category_coll' => $couponSource['category'],
			'product_coll' => $couponSource['productids'],
			'manufactory_coll' => $couponSource['manufactory'],
			'area_coll' => '',   //待删除
			'user_id' => 0,
			'user_grade_coll' => $couponSource['user_grade'],
			'pay_type' => 0,   //待删除
			'allow_use_time' => $couponSource['max_use_times'],			//单人最大使用次数
			'need_mail_verify' => $couponSource['need_mail_verify'],
			'need_mobile_verify' => $couponSource['need_mobile_verify']	,
			'flag' => $couponSource['flag'],
		);

		$ret = ICouponTTC::insert($newCoupon);
		if (false === $ret) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg = ICouponTTC::$errMsg;
			return false;
		}
		return  true;
	}

	public static function invalidPubCoupon($couponCode)
	{
		if ($couponCode == '') {
			self::$errCode = -102;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "couponCode($couponCode)不合法";
			return false;
		}
		$couponCode = trim($couponCode);

		global $_CouponStatus;
		$newCoupon = array(
			'coupon_code' => $couponCode,
			'status' =>  $_CouponStatus['invalid'],
		);

		$ret = ICouponTTC::update($newCoupon);
		if (false === $ret) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg = ICouponTTC::$errMsg;
			return false;
		}
		return  true;
	}
	//$coupon 为checkCoupon函数的返回值
	/*
		$retArray['amt'] = $coupon['coupon_amt'];
		$retArray['code'] = $couponCode;
		$retArray['type'] = $coupon['coupon_type'];
		$retArray['used_degree'] = $coupon['used_degree'];
		$retArray['max_use_degree'] = $coupon['max_use_degree'];
		$retArray['user_id'] = $coupon['user_id'];
		$retArray['wh_id'] = $coupon['wh_id'];<br>
		$retArray['batchno'] = $coupon['batchno'];
		$retArray['allow_use_time'] = $coupon['allow_use_time'];

	*/
	public static function useCoupon($uid, $coupon, $order_id, $db = null, $userLevel = -1, $wh_id = 1)   //$db不为null的时候，说明调用者负责开启，提交事务
	{
		$existInIndexCache = true;
		if (0 == $coupon['user_id']) {  //如果是公共优惠券，需要判断是否已经存在使用记录，来决定是插入还是update
			$exist = IUserCouponIndexTTC::get($uid, array('coupon_code'=>$coupon['code']));
			if (false === $exist) {
				self::$errCode = IUserCouponIndexTTC::$errCode;
				self::$errMsg = IUserCouponIndexTTC::$errMsg;
				return false;
			}
			if (count($exist) == 0) {
				$existInIndexCache = false;
			}
		}
		global $_CouponStatus;
		$st = $_CouponStatus['partly_used'];

		if ($coupon['used_degree'] + 1 >= $coupon['max_use_degree']) {
			$st = $_CouponStatus['used'];
		}
		$mysqlDb = $db;

		$now = time();
		$dbtable = ToolUtil::getCouponDBTableIndex(ToolUtil::TTCStr2Hash($coupon['code']));
		$mysqlDb = ToolUtil::getDBObj('coupon', $dbtable['db']);
		if (false === $mysqlDb) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}

		if ($db == null) {
			$sql = "start transaction";
			$ret = $mysqlDb->execSql($sql);
			if (false === $ret) {
				self::$errCode = $mysqlDb->errCode;
				self::$errMsg = $mysqlDb->errMsg;
				return false;
			}
		}
		$sql = "update t_coupon_{$dbtable['table']} set used_degree=used_degree+1, used_time=$now, status=$st where coupon_code='{$coupon['code']}' and wh_id={$coupon['wh_id']} and used_degree < max_use_degree";
		$ret = $mysqlDb->execSql($sql);
		if (false === $ret || $mysqlDb->getAffectedRows() == 0) {
			self::$errCode = $mysqlDb->errCode;
			self::$errMsg = $mysqlDb->errMsg;

			$sql = "rollback";
			$mysqlDb->execSql($sql);
			return false;
		}
		$dbtable = ToolUtil::getCouponDBTableIndex($uid);
		$mysqlDb = ToolUtil::getDBObj('user_coupon_index', $dbtable['db']);
		if (false === $mysqlDb) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			$sql = "rollback";
			$mysqlDb->execSql($sql);
			return false;
		}
		if ($existInIndexCache === true) { //更新
			$sql = "update t_user_coupon_index_{$dbtable['table']} set used_times=used_times+1, order_ids=concat('$order_id,', order_ids) where user_id=$uid and coupon_code='{$coupon['code']}' and wh_id={$coupon['wh_id']} and used_times < {$coupon['allow_use_time']}";
		}else
		{
			$sql = "insert into t_user_coupon_index_{$dbtable['table']} values($uid, '{$coupon['code']}', {$coupon['wh_id']}, 1, '$order_id')";
		}
		$ret = $mysqlDb->execSql($sql);
		if (false === $ret || $mysqlDb->getAffectedRows() == 0) {
			self::$errCode = $mysqlDb->errCode;
			self::$errMsg = $mysqlDb->errMsg;

			$sql = "rollback";
			$mysqlDb->execSql($sql);
			return false;
		}
		if ($db == null) {
			$sql = 'commit';
			$mysqlDb->execSql($sql);
		}

		IAsyTask::purgeTTCData('IUserCouponIndexTTC', $uid);
		IAsyTask::purgeTTCData('ICouponTTC', trim($coupon['code']));
		/*
		require_once(PHPLIB_ROOT . 'api/inc/IUserCouponIndexTTC.php');//勿删
		//new purge
		$user_coupon_idx_ttc = Config::getTTC('IUserCouponIndexTTC');
		if (!$user_coupon_idx_ttc->purge($uid))
		{
			$ttc_purge_result = $user_coupon_idx_ttc->purge($uid);
			if (!$ttc_purge_result)
			{
				Logger::err("user_coupon_idx_ttc purge failed");
			}
		}
		require_once(PHPLIB_ROOT . 'api/inc/ICouponTTC.php');//勿删
		//new purge
		$coupon_ttc = Config::getTTC('ICouponTTC');
		if (!$coupon_ttc->purge($coupon['code']))
		{
			$ttc_purge_result = $coupon_ttc->purge($coupon['code']);
			if (!$ttc_purge_result)
			{
				Logger::err("coupon_ttc purge failed");
			}
		}
		*/
		if($userLevel == -1)
		{
			$userLevel = 0;
			$userInfo = IUser::getUserInfo($uid);
			if (false != $userInfo) {
				$userLevel = $userInfo['level'];
			}
		}
		$orders = explode(",", $order_id);
		foreach ($orders as $ooooo)
		{
			if(empty($ooooo) || $ooooo == '')
			{
				continue;
			}
			DataReport::report(3101, DATA_TYPE_1DAY, array($wh_id,$ooooo,$coupon['batchno'],$uid,$userLevel,$coupon['code']));
		}
		
		/*******************************电信优惠券相关START*********************************/
		//是电信优惠券则更新数据     （电信容错处理以后跟进）
		//验证电信券：1：含“电信”字样;2:已发送至电信方;3：没用过	
		//@modified by EdisonTsai on 14:57 2012/11/21 for fix the non-sent bug
		//@modified by EdisonTsai on 14:47 2012/11/21 for add uid in extra field
		//@daopingsun 11:45 2012/9/6
		$rsCouponData = ICouponTTC::get(trim($coupon['code']));
		if(false === $rsCouponData){//有可能出错，但不能影响下单逻辑，容错处理以后跟进
		}
		if($rsCouponData !== false && count($rsCouponData) != 0 ){
			if(strpos($rsCouponData[0]['coupon_name'],'上海电信用户专用')!== false){//存在“电信”字样
				$rsMCIData = IMerchantsCouponIndexTTC::get(SHTEL_MID,array('coupon_code' => $coupon['code'], 'is_used' => 0));
				//modified by EdisonTsai on 15:23 2012/11/21 for add '=='
				if($rsMCIData !== false && count($rsMCIData) != 0){//确认是电信券（1、存在‘电信’字样；2、未使用过；3、已发送电信端）
								
					$arrMCIData = array(
						'mid' 			=> SHTEL_MID,
						'coupon_code'	=> $coupon['code'],
						'used_time' 	=> $now,
						'is_used' 		=> 1,
						'order_ids'		=> $order_id.(trim($rsMCIData[0]['order_ids']) == ''?'':','.$rsMCIData[0]['order_ids']),
						'batch' 		=> $coupon['batchno']
					);
					
					$rsMCIData_u = IMerchantsCouponIndexTTC::update($arrMCIData,array('coupon_code' => $coupon['code']));
					if(false === $rsMCIData_u){//有可能出错，但不能影响下单逻辑，容错处理以后跟进
					}	
				  	
				  	$rsMCLData_g = IMerchantsCouponLogTTC::get(SHTEL_MID,array('coupon_code' => $coupon['code']));
				  	
					/**
					 * @modified by EdisonTsai on 15:08 2012/11/21 for fix the non-sent bug
					 */
					if($rsMCLData_g !== false && isset($rsMCLData_g[0]['extra_content']) && count($rsMCLData_g) > 0){

				  		$rsMCLData_u = IMerchantsCouponLogTTC::update(
				  			array(
				  				'mid'				=> SHTEL_MID,
			 					'coupon_amount' 	=> $rsCouponData[0]['coupon_amt'],
				 				'order_ids'	 		=> $order_id.(trim($rsMCIData[0]['order_ids']) == ''?'':','.$rsMCIData[0]['order_ids']),
			 	 				'add_time' 			=> $now,
			 	 				'sent_time'			=> 0,
			 	 				'end_time'			=> 0,
				  				'status' 			=> 2,//预推送状态
				  			),
				  			array('coupon_code' => $coupon['code'])
				  		);

				  		if(false === $rsMCLData_u)
						{
						    //有可能出错，但不能影响下单逻辑，容错处理以后跟进
				  		}  //end if
						
				  	}else{
						//此处后续要接入Clogger
					}  //end if
					
				}
			}
		}		
		/*******************************电信优惠券相关END*********************************/
		
		return true;
	}

	//ixiuzeng添加
	//查询用户某个批次的优惠券的数量
    public static function getCouponNumofUser($uid, $batchno)  
    {
    	//检查输入参数的合法性
    	if (!isset($uid) || $uid <= 0) 
    	{
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)不合法";
			return false;
		}
		
    	if (!isset($batchno) || $batchno < 0) 
    	{
			self::$errCode = -102;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "batch($batchno)不合法";
			return false;
		}

		//获得该用户的所有优惠券
    	$userCoupons = IUserCouponIndexTTC::get($uid);
		if (false === $userCoupons) 
		{
			self::$errCode = IUserCouponIndexTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserCouponIndexTTC failed]' . IUserCouponIndexTTC::$errMsg;
			return false;
		}	
    	if(count($userCoupons) === 0)
		{
			return 0;
		}
		
    	$couponCodes = array();
		foreach ($userCoupons as $key => $uc)
		{
			$couponCodes[] = trim($uc['coupon_code']);
		}
		
		
		//筛选出属于$batchno批次的优惠券
    	$rightCoupons = ICouponTTC::gets($couponCodes, array('batchno' => $batchno));
		if (false === $rightCoupons) 
		{
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}
		
		//筛选出coupon_type为8或9的优惠券
		$number = 0;
		foreach ($rightCoupons as $key=>&$rc)
		{
			if (($rc['coupon_type'] == self::$CouponType['public']) 
				|| ($rc['coupon_type'] == self::$CouponType['personal'])) 
			{
				$number++;
			}
		}
		
		return $number;
    }
	
}

