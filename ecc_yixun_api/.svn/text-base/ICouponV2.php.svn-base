<?php
require_once(PHPLIB_ROOT . 'lib/DataReport.php');
require_once(PHPLIB_ROOT . 'api/inc/IMerchantsCouponIndexTTC.php');//电信券数据存入@daopingsun
require_once(PHPLIB_ROOT . 'api/inc/ICouponTTC.php');//电信券字样查询比对@daopingsun
require_once(PHPLIB_ROOT . 'api/inc/IMerchantsCouponLogTTC.php');//推单
require_once(PHPLIB_ROOT . 'api/inc/IUserCouponIndexTTC.php');

class ICouponV2
{
	public static $errCode = 0;
	public static $errMsg = '';

	public static $CouponType = array(
		'public' => 9,
		'personal' => 8
	);

	public static $WhId = array(
		0 => "全站",
		1 => "上海",
		1001 => "广东",
		2001 => "北京",
		3001 => "武汉",
		4001 => "重庆",
		5001 => "西安",
	);

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
				self::$errMsg =  "该优惠券为易迅客户端专享,无法直接在网站端使用,请到ios或Android客户端使用";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为易迅wap端专享,无法直接在网站端使用,请至m.51buy.com使用";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为易迅手机专享,无法直接在网站端使用,请至对应平台使用";
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
			//$orderItems = IShoppingCart::get($uid);

			// TODO，更改之前获取商品列表的方式
			// 获取在线购物车的商品列表
			$result = IPreOrderV2::getItemList(
				$uid,
				$wh_id,
				array('type' => IShoppingCart::ONLINE_CART)
			);

			if (false === $result) {
				self::$errCode = IShoppingCart::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IShoppingCart failed]' . IShoppingCart::$errMsg;
				return false;
			}

			$orderItems = $result['items'];
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

		// 符合要求的商品，进行批价


		Logger::info($orderItems);
		$ret = IPreOrderV2::getItemInfo($orderItems, $wh_id, $products);
		if (false === $ret) {
			self::$errMsg = IPreOrderV2::$errMsg;
			self::$errCode = IPreOrderV2::$errCode;
			return false;
		}

		$items = $ret['items'];


		// TODO 接入新的促销批价
		$rule_id = !empty($newOrder['rule_id']) ? intval($newOrder['rule_id']) : 0;
		Logger::info($items);
		Logger::info($wh_id);
		Logger::info($uid);
		Logger::info($rule_id);
		$promotionRule = IPromotionRuleV2::checkRuleForOrder($items, $wh_id, $uid, $rule_id);
		if (false === $promotionRule) {
			self::$errCode = IPromotionRuleV2::$errCode;
			self::$errMsg = IPromotionRuleV2::$errMsg;
			return false;
		}
		$orderItems = $promotionRule['items'];


		/*
		 * TODO 计算满足调价的商品的总金额
		foreach($orderItems as $item)
		{
			if (isset($products[$item['product_id']])) {
				$tmp = $products[$item['product_id']]['price'] * $item['buy_count'];
				@$subOrder[$products[$item['product_id']]['psystock']]['orderAmt'] += $tmp;
				@$subOrder[$products[$item['product_id']]['psystock']]['pids'][] = $item['product_id'];
				$orderAmt += $tmp;
			}
		}
		 *更改为如下逻辑：
		 */

		foreach($orderItems as $it)
		{
			$subOrderKey = $it['psystock'];
			if($it['package_id'] == 0 )
			{
				// 该商品的最终总价格
				$pPrice = $it['promotion_price'];
			}
			else
			{
				// 套餐商品总的最终总价格
				$pPrice = $it['promotion_price'] - $it['cash_back'] * $it['buy_count'];
			}
			@$subOrder[$subOrderKey]['orderAmt'] += $pPrice;
			@$subOrder[$subOrderKey]['pids'][] = $it['product_id'];
			$orderAmt += $pPrice;
		}


		if ($orderAmt < $coupon['sale_amt'])
		{
			self::$errCode = 907;
			//self::$errMsg = "符合优惠的购买商品的金额总和不满足使用要求";
			$orderAmtRMB = floatval($orderAmt / 100);
			$saleAmtRMB = floatval($coupon['sale_amt'] / 100);
			$diffAmtRMB = floatval($saleAmtRMB - $orderAmtRMB);
			self::$errMsg = "符合优惠条件的商品总额{$orderAmtRMB}元，使用该券总额需要达到{$saleAmtRMB}元，您的总额不满足使用要求，还需消费{$diffAmtRMB}元";
			return false;
		}

		//获取用户信息
		$user = array();
		if (($coupon['user_grade_coll'] != NULL && $coupon['user_grade_coll'] != "") ||
			($coupon['need_mail_verify'] == 1) || ($coupon['need_mobile_verify'] == 1)) {

			$user = IUser::getUserInfo($uid);
			if (false === $user) {
				self::$errCode = IUser::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get getUserInfo failed]' . getUserInfo::$errMsg;
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

    /**
     * 优惠券分摊只给网站侧实物购买流程使用
     * @param $uid
     * @param $couponCode
     * @param $destination
     * @param $payType
     * @param $orderItems
     * @param $products
     * @param int $wh_id
     * @param int $clientType
     * @param null $cpInfo
     * @return array|bool
     */
    public static function checkCouponForOrder($uid, $couponCode, $destination, $payType, $orderItems, $products, $packages, $wh_id=1, $clientType=0, $cpInfo = null)
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
        if (!isset($orderItems) || empty($orderItems) || !isset($products) || empty($products)) {
            self::$errCode = 910;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "商品信息不合法";
            return false;
        }
        if (!isset($products) || empty($products)) {
            self::$errCode = 911;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "商品信息不合法";
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
				self::$errMsg =  "该优惠券为易迅客户端专享,无法直接在网站端使用,请到ios或Android客户端使用";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为易迅wap端专享,无法直接在网站端使用,请至m.51buy.com使用";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "该优惠券为易迅手机专享,无法直接在网站端使用,请至对应平台使用";
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

		// 符合要求的商品，进行批价
		Logger::info("ICouponV2 checkCouponfoOrder" . ToolUtil::gbJsonEncode($orderItems));
		//调用新的拆单逻辑（后续重构优惠券时，不需要进行拆单，直接将金额分摊到商品上）
        /*
		$ret_packInfo = IShoppingProcess::setOrderDivide($orderItems, $wh_id, $destination);
		if(false === $ret_packInfo)
		{
			self::$errCode = 900;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "IShoppingProcess::setOrderDivide error";
			return false;
		}

		$productToPackID = array(); //记录每个商品对应的包裹id
		$packInfo = $ret_packInfo['packages'];
        */

		foreach($packages as $subOrderId => $subOrderInfo)
		{
			foreach($subOrderInfo['items'] as $productInfo)
			{
				$productToPackID[$productInfo['product_id']] = $subOrderId;
			}
		}


		foreach($orderItems as $it)
		{
			$subOrderKey = $productToPackID[$it['product_id']];
			if($it['package_id'] == 0 )
			{
				// 该商品的最终总价格
				$pPrice = $it['promotion_price'];
			}
			else
			{
				// 套餐商品总的最终总价格
				$pPrice = $it['promotion_price'] - $it['cash_back'] * $it['buy_count'];
			}
			@$subOrder[$subOrderKey]['orderAmt'] += $pPrice;
			@$subOrder[$subOrderKey]['pids'][] = $it['product_id'];
			$orderAmt += $pPrice;
		}


		if ($orderAmt < $coupon['sale_amt'])
		{
			self::$errCode = 907;
			//self::$errMsg = "符合优惠的购买商品的金额总和不满足使用要求";
			$orderAmtRMB = floatval($orderAmt / 100);
			$saleAmtRMB = floatval($coupon['sale_amt'] / 100);
			$diffAmtRMB = floatval($saleAmtRMB - $orderAmtRMB);
			self::$errMsg = "符合优惠条件的商品总额{$orderAmtRMB}元，使用该券总额需要达到{$saleAmtRMB}元，您的总额不满足使用要求，还需消费{$diffAmtRMB}元";
			return false;
		}

		//获取用户信息
		$user = array();
		if (($coupon['user_grade_coll'] != NULL && $coupon['user_grade_coll'] != "") ||
			($coupon['need_mail_verify'] == 1) || ($coupon['need_mobile_verify'] == 1)) {

			$user = IUser::getUserInfo($uid);
			if (false === $user) {
				self::$errCode = IUser::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get getUserInfo failed]' . getUserInfo::$errMsg;
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
        $retArray['coupon_name'] = $coupon['coupon_name'];
        $retArray['coupon_id'] = $coupon['coupon_id'];
		return  $retArray;
	}


}

