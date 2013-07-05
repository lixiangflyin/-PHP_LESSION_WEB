<?php
class ICouponFetcher
{
	public static $errCode = 0;
	public static $errMsg = '';
	//查看某个批次下的优惠券还有多少张可以领取
	//$couponBatchs: array  需要查看库存的优惠券批次数组 array(630,640,650)
	//返回值： array(0=>array(batch, num), 1=>array(batch, num));
	public static function getCouponStock($couponBatchs , $wh_id=1)
	{
		/*
		if (!is_array($couponBatchs) || count($couponBatchs) == 0) {
			return false;
		}
		$mssql = ToolUtil::getMSDBObj("ERP_$wh_id");
		if (false === $mssql) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return false;
		}
		global $_CouponStatus;
		$sql = "SELECT BatchNo, count(*) as stock FROM Coupon where Status = {$_CouponStatus['activated']} and UseCustomerSysNo IS NULL and BatchNo in(" . implode(',',$couponBatchs) . ") group by BatchNo";

		$batchNum = $mssql->getRows($sql);
		if (false === $batchNum) {
			self::$errCode = $mssql->errCode;
			self::$errMsg = $mssql->errMsg;
			
			return false;
		}
		return $batchNum;  */
	}
	
	//领取优惠券
	//uid : 用户id
	//batchno : 优惠券批次号
	//本期参与活动，可以领取的优惠券的配置，格式如下
	/*
		$ActCouponConf = array(
			batchno1 => array(
					'needEmailVerify' => 1,  //取值0，1(0：无需要验证，1：需要验证)
					'needTelVerify' => 0,    //取值0，1(0：无需要验证，1：需要验证)
					'isAliGoldUser' => 0,     //取值0，1(0：无需要验证，1：需要验证淘宝金账户)
					'userlevel' => array(0, 1, 2, 3),//领用用户的等级限制,空数组表示无限制
					'onlyNewUser' => 0, //限制仅新用户可以领
				),
			batchno2 => array(
					'needEmailVerify' => 1,  //取值0，1(0：无需要验证，1：需要验证)
					'needTelVerify' => 0,    //取值0，1(0：无需要验证，1：需要验证)
					'isAliGoldUser' => 1,     //取值0，1(0：无需要验证，1：需要验证淘宝金账户)
					'userlevel' => array(0, 1, 2, 3),   //领用用户的等级限制,空数组表示无限制
					'onlyNewUser' => 1, //限制仅新用户可以领
				),
		)
		
		$ActCouponConf 每个批次号配置项中均为可选项


		$batchnos = array(batchno1=>num1, batchno2=>num2)   //领取批次1，num1张，领取批次2，num2张
	*/
	public static function fetchCoupon($uid, $batchnos , $ActCouponConf)
	{
		if ($uid <= 0) {
			self::$errCode = -100;
			self::$errMsg = "uid($uid) is invalid";
			return false;
		}
		
		if (!is_array($ActCouponConf) || count($ActCouponConf) == 0) {
			self::$errCode = -101;
			self::$errMsg = "act coupon batch conf is invalid";
			return false;
		}
		$userInfo = array();

		foreach($batchnos as $batchno => $btNum)
		{
			if ((isset($ActCouponConf[$batchno]['onlyNewUser']) && $ActCouponConf[$batchno]['onlyNewUser'] == 1) || 
				(isset($ActCouponConf[$batchno]['isAliGoldUser']) && $ActCouponConf[$batchno]['isAliGoldUser'] == 1) || 
                (isset($ActCouponConf[$batchno]['needTelVerify']) && $ActCouponConf[$batchno]['needTelVerify'] == 1) || 
			    (isset($ActCouponConf[$batchno]['needEmailVerify']) && $ActCouponConf[$batchno]['needEmailVerify'] == 1)|| 
			    (isset($ActCouponConf[$batchno]['userlevel']) && count($ActCouponConf[$batchno]['userlevel']) > 0) 
			    ) 
			{
         			if(empty($userInfo))
				{
					$userInfo = IUsersTTC::get($uid, array(), array('email', 'mobile' , 'exp_point', 'status_bits', 'level'));
					if (false === $userInfo) {
						self::$errMsg = IUsersTTC::$errMsg;
						self::$errCode = IUsersTTC::$errCode;
						return false;
					}
					if (count($userInfo) == 0) {
						self::$errMsg = "no such user";
						self::$errCode = -102;
						return false;
					}
				}
				
				if ( (isset($ActCouponConf[$batchno]['onlyNewUser']) && $ActCouponConf[$batchno]['onlyNewUser'] == 1) )
				{
					// 新用户的积分可能是0和1
					if( $userInfo[0]['exp_point'] > 1)
					{
						return array('errCode'=>1, 'errMsg'=>'对不起，此优惠券只有新注册用户才能领取');
					}
				}
				
				
				if (isset($ActCouponConf[$batchno]['isAliGoldUser']) && $ActCouponConf[$batchno]['isAliGoldUser'] == 1) {  //验证淘宝金账户
					if (($userInfo[0]['status_bits'] & (1 << ALI_GOLDEN_USER)) == 0) {
						return array('errCode'=>10, 'errMsg'=>'对不起，此优惠券需要淘宝金账户用户才能领取');
					}
				}
				
				if (isset($ActCouponConf[$batchno]['userlevel']) && count($ActCouponConf[$batchno]['userlevel']) > 0) {
					global $_UserLevel;
					$ulevel = 0;
					foreach ($_UserLevel as $k => $ul)
					{
						if ($ul['startV'] <= $userInfo[0]['exp_point'] && $ul['endV'] >=  $userInfo[0]['exp_point']) {
							$ulevel = $k;
							break;
						}
					}
					if (!in_array($ulevel, $ActCouponConf[$batchno]['userlevel'])) {
						return array('errCode'=>11, 'errMsg'=>'对不起，您的帐号等级不符合领取该优惠券的条件');
					}
				}
				
				if (isset($ActCouponConf[$batchno]['needEmailVerify']) && $ActCouponConf[$batchno]['needEmailVerify'] == 1) {
					if ($userInfo[0]['email'] == '') {
						return array('errCode'=>2, 'errMsg'=>'对不起，领取该用优惠券需要邮箱验证');
					}
					$emailState = IEmailLoginTTC::get($userInfo[0]['email']);
					if (false === $emailState || count($emailState) == 0) {
						self::$errCode = IEmailLoginTTC::$errCode;
						self::$errMsg = IEmailLoginTTC::$errMsg;
						return false;
					}
					global $_EmailStat;
					if ($emailState[0]['uid'] != $uid || $emailState[0]['status'] != $_EmailStat['bound']) {
						return array('errCode'=>2, 'errMsg'=>'对不起，领取该用优惠券需要邮箱验证');
					}
				}
				if (isset($ActCouponConf[$batchno]['needTelVerify']) && $ActCouponConf[$batchno]['needTelVerify'] == 1) {
					if ($userInfo[0]['mobile'] == '') {
						return array('errCode'=>3, 'errMsg'=>'对不起，领取该用优惠券需要手机验证');
					}
					$mobileState = ITelLoginTTC::get($userInfo[0]['mobile'], array('uid'=>$uid));
					if (false === $mobileState ) {
						self::$errCode = ITelLoginTTC::$errCode;
						self::$errMsg = ITelLoginTTC::$errMsg;
						return false;
					}
					global $_MobileStat;
					if (count($mobileState) == 0 || $mobileState[0]['uid'] != $uid || $mobileState[0]['status'] != $_MobileStat['bound']) {
						return array('errCode'=>3, 'errMsg'=>'对不起，领取该用优惠券需要手机验证');
					}
				}
			}
		}
		
		
		$ret = IFreqLimit::check($uid, 3);  //检查是否受限
		if($ret > 0)
		{
			return array('errCode'=>15, 'errMsg'=>'您已经超过了可领取的次数');
		}
		
		//领取优惠券
		$coupons = ICoupon::fetchCoupons($uid, $batchnos, null, (isset($userInfo[0]['level'])? $userInfo[0]['level'] : -1));
		if(false === $coupons)
		{
			self::$errCode = ICoupon::$errCode;
			self::$errMsg = ICoupon::$errMsg;
			return false;
		}
		
		IFreqLimit::add($uid, 3);  //增加领用的次数，失败也不重要

		return $coupons;
	}
}

