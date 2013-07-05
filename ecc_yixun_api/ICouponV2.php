<?php
require_once(PHPLIB_ROOT . 'lib/DataReport.php');
require_once(PHPLIB_ROOT . 'api/inc/IMerchantsCouponIndexTTC.php');//����ȯ���ݴ���@daopingsun
require_once(PHPLIB_ROOT . 'api/inc/ICouponTTC.php');//����ȯ������ѯ�ȶ�@daopingsun
require_once(PHPLIB_ROOT . 'api/inc/IMerchantsCouponLogTTC.php');//�Ƶ�
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
		0 => "ȫվ",
		1 => "�Ϻ�",
		1001 => "�㶫",
		2001 => "����",
		3001 => "�人",
		4001 => "����",
		5001 => "����",
	);

	public static function checkCoupon($uid, $couponCode, $destination, $payType, $wh_id=1, $clientType=0, $cpInfo = null)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 903;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)���Ϸ�";
			return false;
		}

		if (!isset($couponCode) || strlen($couponCode) <= 0) {
			self::$errCode = 904;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "couponCode($couponCode)���Ϸ�";
			return false;
		}
		$couponCode = trim($couponCode);

		if (!isset($destination) || $destination <= 0) {
			self::$errCode = 900;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination)���Ϸ�";
			return false;
		}

		if (!isset($payType) || $payType <= 0) {
			self::$errCode = 905;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payType($payType)���Ϸ�";
			return false;
		}

		//��ȡ�Ż�ȯ����
		$coupon = ICouponTTC::get($couponCode);
		if (false === $coupon) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}
		if (0 == count($coupon)) {
			self::$errCode = 906;
			self::$errMsg = "���Ż�ȯ�ڵ�ǰվ�㲻���ڣ����������Ż�ȯ�����Ƿ�������������Ż�ȯ֧��ʹ�õ�վ�㡣";
			return false;
		}
		$coupon = $coupon[0];

		$now = time();

		if ($coupon['valid_time_from'] > $now) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ��δ��Ч";
			return false;
		}

		if ($coupon['valid_time_to'] < $now) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ�Ѿ�����";
			return false;
		}

		global $_CouponStatus;
		//�Ż�ȯ״̬���Ϸ�
		if ($coupon['status'] != $_CouponStatus['activated'] && $coupon['status'] != $_CouponStatus['partly_used']) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ�Ѿ�ʹ�û���δ����";
			return false;
		}

		//�Ż�ȯ�ܵ�ʹ�ô����Ѿ�����
		if ($coupon['max_use_degree'] <= $coupon['used_degree']) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ�Ѿ��ﵽ���ʹ�ô�����������ʹ��";
			return false;
		}

		if ($coupon['user_id'] > 0){
			if ($coupon['user_id'] != $uid) {
				IUserCouponIndexTTC::remove($uid, array('coupon_code'=>$couponCode));
				self::$errCode = 906;
				self::$errMsg =  "����Ȩʹ�ø��Ż�ȯ";
				return false;
			}
		}
		//�ֻ��Ż�ȯ�ж�start
		if ($coupon['flag'] != 0){
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) != M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ��Ѹ�ͻ���ר��,�޷�ֱ������վ��ʹ��,�뵽ios��Android�ͻ���ʹ��";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ��Ѹwap��ר��,�޷�ֱ������վ��ʹ��,����m.51buy.comʹ��";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ��Ѹ�ֻ�ר��,�޷�ֱ������վ��ʹ��,������Ӧƽ̨ʹ��";
				return false;
			}
			if ($clientType == 1 && ($coupon['flag']&M_BUY_ONLY) != M_BUY_ONLY) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ�ͻ���ר���˴��޷�ʹ��,������Ӧƽ̨ʹ��";
				return false;
			}
			if ($clientType == 2 && ($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪwap��ר���˴��޷�ʹ��,������Ӧƽ̨ʹ��";
				return false;
			}
		}
		//�ֻ��Ż�ȯ�ж�end


		if ($wh_id != $coupon['wh_id'] && $coupon['wh_id'] != SITE_ALL) {
			self::$errCode = 906;
			self::$errMsg =  "���Ż�ȯ����" . self::$WhId[$coupon['wh_id']] . "վʹ��";
			return false;
		}

		//����Ż�ȯʹ�õ���
		if ($coupon['area_coll'] != NULL && $coupon['area_coll'] != "" ) {
			$areas = explode(',', $coupon['area_coll']);

			global $_District;
			if (!in_array($destination,  $areas) &&
				!in_array($_District[$destination]['city_id'],  $areas) &&
				!in_array($_District[$destination]['province_id'],  $areas) ) {
				self::$errCode = 906;
				self::$errMsg =  "�����ڵ����������Ż�ȯ��ʹ������";
				return false;
			}
		}

		//����Ż�ȯʹ��֧�ֵ�֧����ʽ
		if ($coupon['pay_type'] != NULL && $coupon['pay_type'] != "" ) {
			$paytypes = explode(',', $coupon['pay_type']);
			if (!in_array($payType,  $paytypes)) {
				self::$errCode = 906;
				self::$errMsg =  "��ѡ���֧����ʽ�������Ż�ȯ��ʹ��Ҫ��";
				return false;
			}
		}
		//����Ż�ȯ�����Ƶ������ʹ�ô���
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
					self::$errMsg =  "���Ż�ȯ�Ѿ�ʹ�ù�" .$couUserInfo['used_times'] . "�Σ�������ʹ��,������Ϊ��" . $couUserInfo['order_ids'] ;
					return false;
				}
			}

		}

		//�����г��ؼ���Ʒ�󣬶����Ľ�� >= �Ż�ȯʹ����Ҫ����ͽ��
		if(!$cpInfo) {//��ȡ���ﳵ����Ʒ
			//$orderItems = IShoppingCart::get($uid);

			// TODO������֮ǰ��ȡ��Ʒ�б�ķ�ʽ
			// ��ȡ���߹��ﳵ����Ʒ�б�
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
		else { //��Լ��
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
				self::$errMsg = 'û���ҵ���Լ��Ϣ';
				return false;
			}
			$contractInfo = $contractInfo[0];
			$sp_id = $contractInfo['sp_id'];
			$card_product_id = $contractInfo['card_id'];
			$orderItems[] = array('product_id' => $card_product_id, 'buy_count' => 1);
			if($contractInfo['product_id'] != $contractInfo['card_id']) { //Ԥ�滰�� ���� ��������
				$orderItems[] = array('product_id' => $contractInfo['product_id'], 'buy_count' => 1);
			}
		}

		$product_ids = array();
		foreach ($orderItems as $item)
		{
			$product_ids[] = $item['product_id'];
		}
		//��ȡ��Ʒ�Ļ�����Ϣ
		$products = IProduct::getProductsInfo($product_ids, $wh_id, false, false, $destination);
		if (false === $products) {
			self::$errCode = IProductTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProductTTC failed]' . IProductTTC::$errMsg;
			return false;
		}
		if($cpInfo) {//����Ǻ�Լ����Ҫ��д���ļ۸�
			if($contractInfo['product_id'] != $contractInfo['card_id']) {
				if(($products[$contractInfo['product_id']]['flag'] & CP_YCHF) == CP_YCHF) {
					$service_type = 1;
				}
				else if(($products[$contractInfo['product_id']]['flag'] & CP_GJRW) == CP_GJRW) {
					$service_type = 2;
				}
				else {
					self::$errCode =  906;
					self::$errMsg = "��Ʒ{$contractInfo['product_id']}���Ƕ��ƻ�";
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
							self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " SIM��($card_product_id) {{$p_item['name']}} �������� �۸��ȡʧ��";
							return false;
						}
						$p_item['price'] = $packageInfo['predeposit_fee'] * 100;
					}
					else if($service_type == 1) {
						$p_item['price'] = 0;
					}
					else {
						self::$errCode = 906;
						self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " �Ƿ�sp_id:$sp_id";
						return false;
					}
				}
			}
		}
		global $_CouponType;

		//�����Ʒ���Ż�ȯ����Ҫ��ȡÿ����Ʒ��Ӧ�Ķ������࣬һ������
		if ($coupon['category_coll'] != "") {
			$c3ids = array();
			foreach ($products as $p)
			{
				$c3ids[] = $p['c3_ids'];
			}
			//��ȡ����id
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
			//��ȡһ��id
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
		//��Ҫ������ָ��Ʒ�Ƶ���Ʒ�۸񳬹��Ż�ȯ����۸�
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
			// �����ֿ�
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
			self::$errMsg = "�����ﳵ�е���Ʒ�����ڱ����Ż�ȯҪ�����Ʒ��Χ�ڣ����޸ĺ���";
			return false;
		}

		// ����Ҫ�����Ʒ����������


		Logger::info($orderItems);
		$ret = IPreOrderV2::getItemInfo($orderItems, $wh_id, $products);
		if (false === $ret) {
			self::$errMsg = IPreOrderV2::$errMsg;
			self::$errCode = IPreOrderV2::$errCode;
			return false;
		}

		$items = $ret['items'];


		// TODO �����µĴ�������
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
		 * TODO ����������۵���Ʒ���ܽ��
		foreach($orderItems as $item)
		{
			if (isset($products[$item['product_id']])) {
				$tmp = $products[$item['product_id']]['price'] * $item['buy_count'];
				@$subOrder[$products[$item['product_id']]['psystock']]['orderAmt'] += $tmp;
				@$subOrder[$products[$item['product_id']]['psystock']]['pids'][] = $item['product_id'];
				$orderAmt += $tmp;
			}
		}
		 *����Ϊ�����߼���
		 */

		foreach($orderItems as $it)
		{
			$subOrderKey = $it['psystock'];
			if($it['package_id'] == 0 )
			{
				// ����Ʒ�������ܼ۸�
				$pPrice = $it['promotion_price'];
			}
			else
			{
				// �ײ���Ʒ�ܵ������ܼ۸�
				$pPrice = $it['promotion_price'] - $it['cash_back'] * $it['buy_count'];
			}
			@$subOrder[$subOrderKey]['orderAmt'] += $pPrice;
			@$subOrder[$subOrderKey]['pids'][] = $it['product_id'];
			$orderAmt += $pPrice;
		}


		if ($orderAmt < $coupon['sale_amt'])
		{
			self::$errCode = 907;
			//self::$errMsg = "�����ŻݵĹ�����Ʒ�Ľ���ܺͲ�����ʹ��Ҫ��";
			$orderAmtRMB = floatval($orderAmt / 100);
			$saleAmtRMB = floatval($coupon['sale_amt'] / 100);
			$diffAmtRMB = floatval($saleAmtRMB - $orderAmtRMB);
			self::$errMsg = "�����Ż���������Ʒ�ܶ�{$orderAmtRMB}Ԫ��ʹ�ø�ȯ�ܶ���Ҫ�ﵽ{$saleAmtRMB}Ԫ�������ܶ����ʹ��Ҫ�󣬻�������{$diffAmtRMB}Ԫ";
			return false;
		}

		//��ȡ�û���Ϣ
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
				self::$errMsg =  "���Ļ�Ա�ȼ�����ʹ�õ�ǰ�Ż�ȯ";
				return false;
			}
		}
		if ($coupon['need_mail_verify'] == 1) {
			if (!isset($user['bindEmail']) || $user['bindEmail'] != 1) {
				self::$errCode = 908;
				self::$errMsg =  "���Ż�ȯ��Ҫ������֤";
				return false;
			}
		}
		if ($coupon['need_mobile_verify'] == 1) {
			if (!isset($user['bindMobile']) || $user['bindMobile'] != 1) {
				self::$errCode = 909;
				self::$errMsg =  "���Ż�ȯ��Ҫ�ֻ���֤";
				return false;
			}
		}

		//��̯�Ż�ȯ�������ӵ�
		//ixiuzeng�޸ģ��Ż�ȯ��̯��bug������һ����������Ż�ȯ���Żݽ�� > ��������Ҫ����ܽ��
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
		//����Ƿ�����Ż�ȯ @daopingsun 11:43 2012/9/6
		if(strpos($coupon['coupon_name'] , '�Ϻ������û�ר��') !== false ){ //����ȯ����߼�	���Ż�ȯ���ƴ��ڡ����š��������Ż�ȯû���ù����ѷ��͸����Ŷ�

			$mid = SHTEL_MID;
			$rs = IMerchantsCouponIndexTTC::get($mid,array('coupon_code' => $couponCode , 'is_used' => 0));
			if($rs !== false && count($rs)!= 0){
				$retArray['merchant'] =  1;//����ȯ���ӻش�ָʾ�ֶ�
			}else{
				//@added by EdisonTsai on 18:03 2012/11/23 for lock down invalid coupon
				self::$errCode  = 906;
				self::$errMsg	= '�Ż�ȯ�Ѿ�ʹ�û���δ����';
				return false;
				//��Ȼ�������š�����������ȯ���ǵ���ȯ�������ǵ���ȯ����û�з��͸����Ŷˣ�δ��Ч�����Ժ����
				//Ŀǰ���Ƶ���ȯֻ��ʹ��һ�Σ��������ù��ĵ���ȯ�����ϴ������check�������������else��
			}
		}
		/*********************************END************************************/
		$retArray['amt'] = $coupon['coupon_amt'];
		$retArray['batchno'] = $coupon['batchno'];
		$retArray['code'] = $couponCode;
		$retArray['type'] = $coupon['coupon_type'] <= 5? ($coupon['coupon_type'] == 2? 0:1) : $coupon['account_type'];  //�����Ż�ȯ�������̯��Pm
		$retArray['used_degree'] = $coupon['used_degree'];
		$retArray['max_use_degree'] = $coupon['max_use_degree'];
		$retArray['user_id'] = $coupon['user_id'];
		$retArray['wh_id'] = $coupon['wh_id'];
		$retArray['allow_use_time'] = $coupon['allow_use_time'];
		$retArray['subOrders'] = $subOrder;
		return  $retArray;
	}

    /**
     * �Ż�ȯ��ֻ̯����վ��ʵ�ﹺ������ʹ��
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
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "uid($uid)���Ϸ�";
			return false;
		}

		if (!isset($couponCode) || strlen($couponCode) <= 0) {
			self::$errCode = 904;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "couponCode($couponCode)���Ϸ�";
			return false;
		}
        if (!isset($orderItems) || empty($orderItems) || !isset($products) || empty($products)) {
            self::$errCode = 910;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "��Ʒ��Ϣ���Ϸ�";
            return false;
        }
        if (!isset($products) || empty($products)) {
            self::$errCode = 911;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "��Ʒ��Ϣ���Ϸ�";
            return false;
        }
		$couponCode = trim($couponCode);

		if (!isset($destination) || $destination <= 0) {
			self::$errCode = 900;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "destination($destination)���Ϸ�";
			return false;
		}

		if (!isset($payType) || $payType <= 0) {
			self::$errCode = 905;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "payType($payType)���Ϸ�";
			return false;
		}

		//��ȡ�Ż�ȯ����
		$coupon = ICouponTTC::get($couponCode);
		if (false === $coupon) {
			self::$errCode = ICouponTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get ICouponTTC failed]' . ICouponTTC::$errMsg;
			return false;
		}
		if (0 == count($coupon)) {
			self::$errCode = 906;
			self::$errMsg = "���Ż�ȯ�ڵ�ǰվ�㲻���ڣ����������Ż�ȯ�����Ƿ�������������Ż�ȯ֧��ʹ�õ�վ�㡣";
			return false;
		}
		$coupon = $coupon[0];

		$now = time();

		if ($coupon['valid_time_from'] > $now) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ��δ��Ч";
			return false;
		}

		if ($coupon['valid_time_to'] < $now) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ�Ѿ�����";
			return false;
		}

		global $_CouponStatus;
		//�Ż�ȯ״̬���Ϸ�
		if ($coupon['status'] != $_CouponStatus['activated'] && $coupon['status'] != $_CouponStatus['partly_used']) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ�Ѿ�ʹ�û���δ����";
			return false;
		}

		//�Ż�ȯ�ܵ�ʹ�ô����Ѿ�����
		if ($coupon['max_use_degree'] <= $coupon['used_degree']) {
			self::$errCode = 906;
			self::$errMsg =  "�Ż�ȯ�Ѿ��ﵽ���ʹ�ô�����������ʹ��";
			return false;
		}

		if ($coupon['user_id'] > 0){
			if ($coupon['user_id'] != $uid) {
				IUserCouponIndexTTC::remove($uid, array('coupon_code'=>$couponCode));
				self::$errCode = 906;
				self::$errMsg =  "����Ȩʹ�ø��Ż�ȯ";
				return false;
			}
		}
		//�ֻ��Ż�ȯ�ж�start
		if ($coupon['flag'] != 0){
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) != M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ��Ѹ�ͻ���ר��,�޷�ֱ������վ��ʹ��,�뵽ios��Android�ͻ���ʹ��";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ��Ѹwap��ר��,�޷�ֱ������վ��ʹ��,����m.51buy.comʹ��";
				return false;
			}
			if ($clientType == 0 && (($coupon['flag']&M_BUY_ONLY) == M_BUY_ONLY) && (($coupon['flag']&CLIENT_ONLY) == CLIENT_ONLY)) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ��Ѹ�ֻ�ר��,�޷�ֱ������վ��ʹ��,������Ӧƽ̨ʹ��";
				return false;
			}
			if ($clientType == 1 && ($coupon['flag']&M_BUY_ONLY) != M_BUY_ONLY) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪ�ͻ���ר���˴��޷�ʹ��,������Ӧƽ̨ʹ��";
				return false;
			}
			if ($clientType == 2 && ($coupon['flag']&CLIENT_ONLY) != CLIENT_ONLY) {
				self::$errCode = 906;
				self::$errMsg =  "���Ż�ȯΪwap��ר���˴��޷�ʹ��,������Ӧƽ̨ʹ��";
				return false;
			}
		}
		//�ֻ��Ż�ȯ�ж�end

		if ($wh_id != $coupon['wh_id'] && $coupon['wh_id'] != SITE_ALL) {
			self::$errCode = 906;
			self::$errMsg =  "���Ż�ȯ����" . self::$WhId[$coupon['wh_id']] . "վʹ��";
			return false;
		}

		//����Ż�ȯʹ�õ���
		if ($coupon['area_coll'] != NULL && $coupon['area_coll'] != "" ) {
			$areas = explode(',', $coupon['area_coll']);

			global $_District;
			if (!in_array($destination,  $areas) &&
				!in_array($_District[$destination]['city_id'],  $areas) &&
				!in_array($_District[$destination]['province_id'],  $areas) ) {
				self::$errCode = 906;
				self::$errMsg =  "�����ڵ����������Ż�ȯ��ʹ������";
				return false;
			}
		}

		//����Ż�ȯʹ��֧�ֵ�֧����ʽ
		if ($coupon['pay_type'] != NULL && $coupon['pay_type'] != "" ) {
			$paytypes = explode(',', $coupon['pay_type']);
			if (!in_array($payType,  $paytypes)) {
				self::$errCode = 906;
				self::$errMsg =  "��ѡ���֧����ʽ�������Ż�ȯ��ʹ��Ҫ��";
				return false;
			}
		}

		//����Ż�ȯ�����Ƶ������ʹ�ô���
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
					self::$errMsg =  "���Ż�ȯ�Ѿ�ʹ�ù�" .$couUserInfo['used_times'] . "�Σ�������ʹ��,������Ϊ��" . $couUserInfo['order_ids'] ;
					return false;
				}
			}
		}
		global $_CouponType;
		//�����Ʒ���Ż�ȯ����Ҫ��ȡÿ����Ʒ��Ӧ�Ķ������࣬һ������
		if ($coupon['category_coll'] != "") {
			$c3ids = array();
			foreach ($products as $p)
			{
				$c3ids[] = $p['c3_ids'];
			}
			//��ȡ����id
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
			//��ȡһ��id
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
		//��Ҫ������ָ��Ʒ�Ƶ���Ʒ�۸񳬹��Ż�ȯ����۸�
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
			// �����ֿ�
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
			self::$errMsg = "�����ﳵ�е���Ʒ�����ڱ����Ż�ȯҪ�����Ʒ��Χ�ڣ����޸ĺ���";
			return false;
		}

		// ����Ҫ�����Ʒ����������
		Logger::info("ICouponV2 checkCouponfoOrder" . ToolUtil::gbJsonEncode($orderItems));
		//�����µĲ��߼��������ع��Ż�ȯʱ������Ҫ���в𵥣�ֱ�ӽ�����̯����Ʒ�ϣ�
        /*
		$ret_packInfo = IShoppingProcess::setOrderDivide($orderItems, $wh_id, $destination);
		if(false === $ret_packInfo)
		{
			self::$errCode = 900;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "IShoppingProcess::setOrderDivide error";
			return false;
		}

		$productToPackID = array(); //��¼ÿ����Ʒ��Ӧ�İ���id
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
				// ����Ʒ�������ܼ۸�
				$pPrice = $it['promotion_price'];
			}
			else
			{
				// �ײ���Ʒ�ܵ������ܼ۸�
				$pPrice = $it['promotion_price'] - $it['cash_back'] * $it['buy_count'];
			}
			@$subOrder[$subOrderKey]['orderAmt'] += $pPrice;
			@$subOrder[$subOrderKey]['pids'][] = $it['product_id'];
			$orderAmt += $pPrice;
		}


		if ($orderAmt < $coupon['sale_amt'])
		{
			self::$errCode = 907;
			//self::$errMsg = "�����ŻݵĹ�����Ʒ�Ľ���ܺͲ�����ʹ��Ҫ��";
			$orderAmtRMB = floatval($orderAmt / 100);
			$saleAmtRMB = floatval($coupon['sale_amt'] / 100);
			$diffAmtRMB = floatval($saleAmtRMB - $orderAmtRMB);
			self::$errMsg = "�����Ż���������Ʒ�ܶ�{$orderAmtRMB}Ԫ��ʹ�ø�ȯ�ܶ���Ҫ�ﵽ{$saleAmtRMB}Ԫ�������ܶ����ʹ��Ҫ�󣬻�������{$diffAmtRMB}Ԫ";
			return false;
		}

		//��ȡ�û���Ϣ
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
				self::$errMsg =  "���Ļ�Ա�ȼ�����ʹ�õ�ǰ�Ż�ȯ";
				return false;
			}
		}
		if ($coupon['need_mail_verify'] == 1) {
			if (!isset($user['bindEmail']) || $user['bindEmail'] != 1) {
				self::$errCode = 908;
				self::$errMsg =  "���Ż�ȯ��Ҫ������֤";
				return false;
			}
		}
		if ($coupon['need_mobile_verify'] == 1) {
			if (!isset($user['bindMobile']) || $user['bindMobile'] != 1) {
				self::$errCode = 909;
				self::$errMsg =  "���Ż�ȯ��Ҫ�ֻ���֤";
				return false;
			}
		}

		//��̯�Ż�ȯ�������ӵ�
		//ixiuzeng�޸ģ��Ż�ȯ��̯��bug������һ����������Ż�ȯ���Żݽ�� > ��������Ҫ����ܽ��
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
		//����Ƿ�����Ż�ȯ @daopingsun 11:43 2012/9/6
		if(strpos($coupon['coupon_name'] , '�Ϻ������û�ר��') !== false ){ //����ȯ����߼�	���Ż�ȯ���ƴ��ڡ����š��������Ż�ȯû���ù����ѷ��͸����Ŷ�

			$mid = SHTEL_MID;
			$rs = IMerchantsCouponIndexTTC::get($mid,array('coupon_code' => $couponCode , 'is_used' => 0));
			if($rs !== false && count($rs)!= 0){
				$retArray['merchant'] =  1;//����ȯ���ӻش�ָʾ�ֶ�
			}else{
				//@added by EdisonTsai on 18:03 2012/11/23 for lock down invalid coupon
				self::$errCode  = 906;
				self::$errMsg	= '�Ż�ȯ�Ѿ�ʹ�û���δ����';
				return false;
				//��Ȼ�������š�����������ȯ���ǵ���ȯ�������ǵ���ȯ����û�з��͸����Ŷˣ�δ��Ч�����Ժ����
				//Ŀǰ���Ƶ���ȯֻ��ʹ��һ�Σ��������ù��ĵ���ȯ�����ϴ������check�������������else��
			}
		}
		/*********************************END************************************/
		$retArray['amt'] = $coupon['coupon_amt'];
		$retArray['batchno'] = $coupon['batchno'];
		$retArray['code'] = $couponCode;
		$retArray['type'] = $coupon['coupon_type'] <= 5? ($coupon['coupon_type'] == 2? 0:1) : $coupon['account_type'];  //�����Ż�ȯ�������̯��Pm
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

