<?php
if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . "lib/ToolUtil.php");
require_once (PHPLIB_ROOT."api/appplatform/multprice4buyao_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/spsschedulepromotion_php5_stub.php");
require_once (PHPLIB_ROOT."api/appplatform/promotionrestrictao_php5_stub.php");
require_once(PHPLIB_ROOT . 'api/appplatform/spsrule4others_php5_stub.php');
require_once(PHPLIB_ROOT . 'api/appplatform/shoppingprocess/shoppingprocess.monitor.inc.php');

//服务调用超时
if (!defined('WEB_STUB_TIME_OUT')) {
    define('WEB_STUB_TIME_OUT',3);
}

/*
 * 节能补贴购物车在结果scene传2，普通传1
 */
Logger::init();
class IPromotionRuleV2
{
	public static $errMsg='';
	public static $errCode=0;	
	public static $promotionType = array(
		'PROMOTION_MULTPRICE' => 1,
		'PROMOTION_FULLDISCOUNT' => 2,
	);
	public static $BenfitTypeNew = array(
		'BENEFIT_TYPE_CASH'  => 1,   //立减
		'BENEFIT_TYPE_COUPON' => 2,   //送优惠券
		'BENEFIT_TYPE_DISCOUNT' => 3, //折扣
		'BENEFIT_TYPE_PRODUCT' => 4,  //送商品
		'BENEFIT_TYPE_POINT' => 5,   //积分
		'BENEFIT_TYPE_HUANGOU' => 6,  //换购商品
		
	);
	
	public static $RuleType = array(
	'RULE_TYPE_NULL' => 0, //无条件
	'RULE_TYPE_CASH_AMT'  => 1,  //满金额
	'RULE_TYPE_BUY_NUM' =>2, //满数量
	);

    public static $ERROR_RESTRICT = 109;    //促销规则不可用

	private static $RuleTypeName = array(
		0	=> '下单',
		1	=> '满{_cash_amt_}',
		2	=> '满{_buy_num_}件',
	);

	private static $BenfitTypeName = array(
		1	=> '立减{_cash_}',
		2	=> '立送优惠券',
		3	=> '立享{_discount_name_}',
		4	=> '立送商品',
		5	=> '立送{_point_}积分',
		6	=> '换购商品',
		
	);

	private static function _reqConstruct($items)
	{
		$spsItemListIn = array();
		foreach($items as $product)
		{
            $spsItem = array();

			$spsItem['itemId'] = $product['product_id'];
			$spsItem['itemId_u'] = 1;
			if(isset($product['chid']) && !empty($product['chid']))
			{
				$sourceScene = explode("@", $product['chid']);
				if(count($sourceScene) > 0)
				{   
					$sourceScene = array_unique($sourceScene);
                    foreach($sourceScene as &$ss)
                    {
                        $ss = intval($ss);
                    }

					$spsItem['actId'] = $sourceScene;
					$spsItem['actId_u'] = 1;
				}
			}
			//套餐商品使用套餐优惠后价格
			if($product['package_id'] != 0)
			{
				$spsItem['itemPrice'] = ($product['price'] - $product['pkg_cash_back']) * $product['buy_count'];
			}
            else if($product["match_num"] > 0)
            {
                $spsItem['itemPrice'] = $product['price'] *  $product['buy_count'] - ($product['match_cut']*$product['match_num']);
            }
			else
			{
				$spsItem['itemPrice'] = $product['price'] * $product['buy_count'];
			}
			
			$spsItem['itemPrice_u'] = 1;
			$spsItem['itemUnitPrice'] = $product['price'];
			$spsItem['itemUnitPrice_u'] = 1;
			$spsItem['itemNum'] = $product['buy_count'];
			$spsItem['itemNum_u'] = 1;
			$spsItem['pkgId'] = $product['package_id'];
			$spsItem['pkgId_u'] = 1;
			$spsItem['itemType'] = ($product['package_id'] != 0)? 1 : (($product['match_num'] >0)? 2:0);	//这里要注意前端需要处理套餐如果不处理这边会有问题
			$spsItem['itemType_u'] = 1;
			$spsItemListIn[] = $spsItem;
		}

		//$req->SpsItemListIn->setValue($spsItemListIn);
		return $spsItemListIn;
	}
	
	/**
	 * 购物车获取促销规则新接口
	 * @param array $items 商品结构
	 * @param number $whId 分仓id
	 * @param number $type 购物车类型 1 普通购物车 2 节能补贴购物车
	 * @param number $uid
	 * @return array
	 */
	public static function getRuleForShoppingCart($items, $whId, $type=1, $uid=0, $scene = SCENE_SHOPPING_CART)
	{
        $uin = $uid;
        if (0 == $uid) {
            $uin = rand(0,1000);
        }
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['promotion']['succ']."|".$shoppingProcessItil[$scene]['promotion']['failed']."|".$shoppingProcessItil[$scene]['promotion']['timeout'];

        $strItems = ToolUtil::gbJsonEncode($items);
		Logger::info("getRuleForShoppingCart start:[items:{$strItems}][whid:{$whId}][type:{$type}][uid:{$uid}]");
		if (!is_array($items) || count($items) == 0 ) {
			return "";
		}
		//获取总价、总件数、总款数
		$totalClassNum = count($items);
		$totalNum = 0;
		foreach($items as $product)
		{
			$totalNum += $product['buy_count'];
		}	
		$uid = intval($uid);
        $spsItemListIn = self::_reqConstruct($items);

        $req = array(
            "uin"           => $uid,
            "source"        => __FILE__,
            "scene"         => $type,
            "itemClassNum"  => $totalClassNum,
            "itemNum"       => $totalNum,
            "whId"          => $whId,
            "spsItemListIn" => $spsItemListIn,

        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,    //操作者ID，一般填写用户QQ（对应setDwOperatorId）
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,
            'timeout'   => WEB_STUB_TIME_OUT,       //超时时间，以秒为单位，特殊情况下可以调大
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['promotion']['req']);
        $ret = WebStubCntl2::request('icson\promotion\ao\schedule\GetPromotionInfo', array("opt" => $opt, "req" => $req));
        if ($ret['code'] == -1)
        {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getRuleForShoppingCart invoke failed!]";
			Logger::err("GetPromotionInfoReq invoke return:[errCode:{$ret['code']}][items:{$strItems}][uid:{$uid}][whid:{$whId}]");
			return  false;
		}
        if($ret['data']['errCode'] != 0)
        {
            //多价计算错误6940多价错误
            self::$errCode = 102;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getRuleForShoppingCart mult price Error!]";
            Logger::err("GetPromotionInfoReq invoke return:[errCode:{$ret['data']['errCode']}][items:{$strItems}][uid:{$uid}][whid:{$whId}]");
            return  false;
        }

        //如果多价错误直接返回，其他错误不返回，促销规则置空
        if($ret['data']['result'] == 6940)
        {
            //多价计算错误6940多价错误
            self::$errCode = 103;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getRuleForShoppingCart mult price Error!]";
            Logger::err("GetPromotionInfoReq return Cal mult price Error![ret:{$ret}][result:{$ret['data']['result']}][items:{$strItems}][uid:{$uid}][whid:{$whId}]");
            return  false;
        }
        else
        {
            self::$errCode = 104;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getRuleForShoppingCart mult price Error!]";
        }
		//处理数据
		$spsItemListOut = $ret['data']['spsItemListOut'];
		reset($items);
		foreach($items as &$product)
		{
			foreach($spsItemListOut as $spsItem)
			{
				if($spsItem['itemId'] == $product["product_id"])
				{
					if($product["package_id"] != 0 )
					{
						if($spsItem['itemType'] != 1)
						{
							continue;
						}
					}
                    else if($product["match_num"] > 0)
                    {
                        if($spsItem['itemType'] != 2)
                        {
                            continue;
                        }
                    }
					else
					{
						if($spsItem['itemType'] != 0)
						{
							continue;
						}
					}

					//如果是套餐商品字段填充
					if($product["package_id"] != 0 || $product["match_num"] > 0)
					{
						$product["total_price_before"] = $product["price"]* $product["buy_count"];
						$product["total_price_after"] = $product["price"]* $product["buy_count"];
						$product["total_price_discount"] = 0;
						$product["price_before"] = $product["price"];
						$product["price"] = $product["price"];
						$product["discount_price"] = 0;
						$product["mult_price_discount"] = 0;
						$product["energy_save_discount"] = 0;
						$product["energy_save_name"] = "";
						$product["energy_save_desc"] = "";
						$product["discount_p_name"] = "";
						$product["discount_p_desc"] = "";
						$product["price_buy_limit_rule"] = "";
						//多价限购
						$product["price_buy_limit_flag"] = 0;
						$product["mult_limit_num"] = 0;
						$product["price_cost_ratio"] = 0;
						$product["price_scene_id"] = 0;
						$product["price_source_id"] = 0;
						$product["mult_price_op_type"] = 0;
						$product["mult_price_op_num"] = 0;
						$product["is_price_rule"] = 0;
						break;
					}
					else 
					{
						//批价路径:多价和促销批价
						$spsItemOpPathList = $spsItem['spsItemOpPathList'];
						//$product["op_path"] = array();
						//get的时候是否有必要记录多价的批价路径？
						//批价路径，多价信息
							
						foreach($spsItemOpPathList as $spsItemOpPath)
						{
							$opPath = array();
							$opPath["type"] = $spsItemOpPath['ruleType'];
							$opPath["before_price"] = $spsItemOpPath['beforePrice'];
							$opPath["after_price"] = $spsItemOpPath['afterPrice'];
							$opPath["rule_id"] = $spsItemOpPath['ruleId'];
							$product["op_path"][] = $opPath;
						}
						//多价
						$priceInfoList = $spsItem['priceInfoList'][0];
						$sourceId = $priceInfoList['priceSourceId'];
						$sceneId = $priceInfoList['priceSceneId'];
						$product["price_scene_id"] = $sceneId;				//多价场景id
						$product["price_source_id"] = $sourceId;			//多价来源id
						//分两种情况 如果是阶梯价格，则根据阶梯价格来判断
						$product["total_price_before"] = $priceInfoList['priceBeforeFavor'];    //该款商品的优惠前价格，有n件商品，则为n件总值
						$product["total_price_after"] = $priceInfoList['priceAfterFavor'];		//该款商品的优惠后价格，有n件商品，则为n件总值
						$product["total_price_discount"] = $priceInfoList['priceDiscount'];      //该款商品多价总的优惠
						$product["price_before"] = $priceInfoList['unitPriceBeforeFavor'];		//单个商品优惠前价格
						$product["price"] = $priceInfoList['unitPriceAfterFavor'];			   	//单个商品多价优惠后的价价格
						$product["discount_price"] = $priceInfoList['unitPriceDiscount'];  		//单个商品多价优惠
						$product["mult_price_discount"] = 0;//$priceInfoList->dwMultPriceDiscount;	//该款商品非节能补贴的优惠金额
						$product["energy_save_discount"] = $priceInfoList['energySaveDiscount'];//该款商品节能补贴的优惠金额
						$product["energy_save_name"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['energySaveName']);		//节能补贴优惠名称
						$product["energy_save_desc"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['energySaveDesc']);		//节能补贴优惠描述
						//$discountName = iconv("utf8", "gbk//IGNORE", $priceInfoList);
						$product["discount_p_name"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['priceName']);				//多价描述
						$product["discount_p_desc"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['priceDesc']);				//多价名称
						//多价限购
						$product["price_buy_limit_flag"] = $priceInfoList['priceBuyLimitFlag'];	//多价限购标志 0：不限购，1：被限购
						$product["mult_limit_num"] = $priceInfoList['priceBuyLimitNum'];		//限购情况下，最多可购买数量
						$product["mult_price_op_type"] =  isset($priceInfoList['priceOpType']) ? $priceInfoList['priceOpType'] : 0;                       //1定价，2减价，3折扣
						$product["mult_price_op_num"] = isset($priceInfoList['unitPriceOpNum']) ? intval($priceInfoList['unitPriceOpNum']) : "";	    //商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5
						$product["is_price_rule"] = 0;
						if(3 == $sourceId)
						{
							if(1 == $priceInfoList['priceOpType'])  //折扣
							{
								$product["discount_price"] = 0;
                                $product["mult_price_op_num"] /= 10;
								$product["discount_p_name"] = $product["mult_price_op_num"] . "折优惠";
								//节能补贴做特殊处理

                                if(!empty($product["energy_save_discount"]) && $product["energy_save_discount"] != 0)
								{
									//$product["price_before"] = $product["price"];
									$product["discount_price"] = 0;
								}

							}
							else if(2 == $priceInfoList['priceOpType'])		//下单立减
							{
                                $product["mult_price_op_num"] /= 100;
								$product["discount_p_name"] = "立减". $product["mult_price_op_num"] . "元";
								$product["discount_price"] = 0;
								$product["mult_price_discount"] = 0;
							}
							else
							{
								$product["discount_p_name"] = "";
								$product["discount_price"] = 0;
								$product["mult_price_discount"] = 0;
							}
								
						}
						else if(4 == $sourceId || 5 == $sourceId || 8 == $sourceId)   //场景 身份价格
						{
							$product["price_before"] = $product["price"];
							$product["total_price_before"] = $product["total_price_after"];
							$product["discount_price"] = 0;
							//$product["total_price_discount"] = 0;
							$product["mult_price_discount"] = 0;
						}
						else if(6 == $sourceId)   //阶梯价
						{
							/*
							 * 阶梯：1是第N件，2是满N件
							1steptype@2stepnum:3optype:95opnum
							*/
						
							$product["is_price_rule"] = 1;
							//Logger::info("is_price_rule  ===>".print_r($priceInfoList, true));
							$priceRule = explode("@", $priceInfoList['priceRule']);
							$priceRuleInfo = explode(":", $priceRule[1]);
                            $priceRuleInfo[2] = intval($priceRuleInfo[2]);
							$product["price_rule_type"] = $priceRule[0];
							$product["mult_price_rule_num"] = $priceRuleInfo[0];
							$product["price_op_ype"] =  $priceRuleInfo[1];
							$product["price_op_num"] = $priceRuleInfo[2];
							$product["need_num"] = $priceInfoList['needNum'];
							//阶梯价是显示易迅价的
							//$product["price_before"] = $product["price"];
							$product["total_price_before"] = $product["total_price_after"];
						
							$product["discount_price"] = 0;
							if(1 == $priceRule[0])
							{
								if(3 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "第{$priceRuleInfo[0]}件{$priceRuleInfo[2]}元";
								}
								else if(2 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "第{$priceRuleInfo[0]}件减{$priceRuleInfo[2]}元";
								}
								else if(1 == $product["price_op_ype"])
								{
                                    $priceRuleInfo[2] /= 10;
									$product["discount_p_name"] = "第{$priceRuleInfo[0]}件{$priceRuleInfo[2]}折";
								}
								else
								{
									$product["discount_p_name"] = "";
								}
							}
							else if(2 == $priceRule[0])
							{
						
								if(3 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "满{$priceRuleInfo[0]}件{$priceRuleInfo[2]}元";
								}
								else if(2 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "满{$priceRuleInfo[0]}件减{$priceRuleInfo[2]}元";
								}
								else if(1 == $product["price_op_ype"])
								{
                                    $priceRuleInfo[2] /= 10;
									$product["discount_p_name"] = "满{$priceRuleInfo[0]}件{$priceRuleInfo[2]}折";
								}
								else
								{
									$product["discount_p_name"] = "";
								}
							}
						}

						break;
					}
				}
			}
		}
		$rules = array();
		$rulesBuyMore = array();
        $rulesNoLogin = array();
		//规则信息列表  节能补贴这里屏蔽掉促销规则
        if($ret['data']['result'] != 0 && $ret['data']['result'] != 6490 || 2 == $type)
        {
            //促销有问题了，直接返回促销问题
            $promtionRule = array(
                "items" => $items,
                "rules" => $rules,
                "rules_buy_more" => $rulesBuyMore,
                "rules_if_login" => $rulesNoLogin
            );
            $strPromoRule = ToolUtil::gbJsonEncode($promtionRule);
            Logger::err("getRuleForShoppingCart Finish[promtionRule:{$strPromoRule}]");
            return $promtionRule;
        }
		$spsOpInfoListOut = $ret['data']['spsOpInfoListOut'];
		foreach($spsOpInfoListOut as $spsOpInfo)
		{
			if(2 != $spsOpInfo['opType'])
			{
				continue;
			}
            $buyMoreConditionValue = 0;
            $buyMoreDiscountValue = 0;
			$rule =  array();
			$rule["rule_id"] = $spsOpInfo['ruleId'];
			$rule["rule_sum_value"] = $spsOpInfo['ruleSumValue'];
			$rule["url"] = $spsOpInfo['url'];
			$rule["rule_type"] = $spsOpInfo['conditionType'];
			$rule["benefit_type"] = $spsOpInfo['discountType'];
			$rule["benefit_times"] = $spsOpInfo['stagePriceIndex'];
			if(1 == $spsOpInfo['useRuleState'])
			{
				$index = $spsOpInfo['stagePriceIndex'];
				if(0 == $spsOpInfo['stagePriceType'])
				{
					//自动梯度
					$conditionValue = $spsOpInfo['conditionValue'][0] * $index;

                    if(self::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $rule["benefit_type"])
                    {
                        $discountValue = $spsOpInfo['discountValue'][0];
                    }
                    else
                    {
                        $discountValue = $spsOpInfo['discountValue'][0] * $index;
                    }

					if($index < $spsOpInfo['autoStageMax'])
					{
						$buyMoreConditionValue = $spsOpInfo['conditionValue'][0] * ($index + 1);
                        if(self::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $rule["benefit_type"])
                        {
                            $buyMoreDiscountValue = $spsOpInfo['discountValue'][0];
                        }
                        else
                        {
                            $buyMoreDiscountValue = $spsOpInfo['discountValue'][0] * ($index + 1);
                        }
					}
				}
				else
				{
					//手动梯度
                    $conditionValue = $spsOpInfo['conditionValue'][$index - 1];
                    $discountValue = $spsOpInfo['discountValue'][$index - 1];
                    if(self::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $rule["benefit_type"])
                    {
                        $rule["benefit_times"] = 1;
                    }
					if($index < $spsOpInfo['autoStageMax'])
					{
						$buyMoreConditionValue =  $spsOpInfo['conditionValue'][$index];
						$buyMoreDiscountValue = $spsOpInfo['discountValue'][$index];
					}
				}
				$rule["condition"] = $conditionValue;
				$rule["benefits"] = $discountValue;
				$rule["desc"] = iconv("utf8", "gbk//IGNORE", $spsOpInfo['opInfo']);
				self::appendNameOfRule($rule);
				$rules[] = $rule;
				//判断是否存在梯度
				if(0 != $buyMoreConditionValue)
				{
					$rule["buy_more"] = $spsOpInfo['unfillDiffValue'];
					$rule["condition"] = $buyMoreConditionValue;
					$rule["benefits"] = $buyMoreDiscountValue;
					$rule["desc"] = iconv("utf8", "gbk//IGNORE", $spsOpInfo['opInfo']);
					self::appendNameOfRule($rule);
					$rulesBuyMore[] = $rule;
				}
			}
			else if(2 == $spsOpInfo['useRuleState']->dwUseRuleState)
			{
				$rule["buy_more"] = $spsOpInfo['unfillDiffValue'];
				$rule["condition"] = $spsOpInfo['conditionValue'][0];
				$rule["benefits"] = $spsOpInfo['discountValue'][0];
				$rule["desc"] = iconv("utf8", "gbk//IGNORE", $spsOpInfo['opInfo']);
				self::appendNameOfRule($rule);
				$rulesBuyMore[] = $rule;
			}
            else if(3 == $spsOpInfo['useRuleState'])
            {
                $rule["buy_more"] = 0;
                $rule["condition"] = $spsOpInfo['conditionValue'][0];
                $rule["benefits"] = $spsOpInfo['discountValue'][0];
                $rule["desc"] = iconv("utf8", "gbk//IGNORE", $spsOpInfo['opInfo']);
                self::appendNameOfRule($rule);
                $rulesNoLogin[] = $rule;
            }
		}

		$promtionRule = array(
				"items" => $items,
				"rules" => $rules,
				"rules_buy_more" => $rulesBuyMore,
				"rules_if_login" => $rulesNoLogin,
		);
		$strPromoRule = ToolUtil::gbJsonEncode($promtionRule);
		Logger::info("getRuleForShoppingCart Finish[promtionRule:{$strPromoRule}]");
		return $promtionRule;
	}

	/**
	 * 订单确认页、生成订单促销规则验证接口
	 * @param array $items
	 * @param number $whId
	 * @param number $uid
	 * @param number $ruleId
	 * @param number $type
	 * @return array
	 */

	public static function checkRuleForOrder($items, $whId, $uid, $ruleId=0, $type=1, $scene = SCENE_SHOPPING_PROCESS)
	{
		if (!is_array($items) || count($items) == 0 || ($type != 1 && $type != 2)) {
			self::$errCode = 105;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrder para Error!]";
			Logger::err("checkRuleForOrder para error!:[uid:{$uid}][whid:{$whId}][rule_id{$ruleId}][type[$type]]");
			return false;
		}
		$strItems = ToolUtil::gbJsonEncode($items);
		Logger::info("checkRuleForOrder start:[items:{$strItems}][whid:{$whId}][ruleid:{$ruleId}][type:{$type}][uid:{$uid}]");
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['promotion']['succ']."|".$shoppingProcessItil[$scene]['promotion']['failed']."|".$shoppingProcessItil[$scene]['promotion']['timeout'];

        $uid = intval($uid);
		//获取总价、总件数、总款数
		$totalClassNum = count($items);
		$totalNum = 0;
		foreach($items as $product)
		{
			$totalNum += $product['buy_count'];
		}
        $ruleIds = array();
        if(0 != $ruleId)
        {
            $ruleIds[] = intval($ruleId);
        }
        $spsItemListIn = self::_reqConstruct($items);
        $req = array(
            "uin"           => $uid,
            "source"        => __FILE__,
            "scene"         => $type,
            "itemClassNum"  => $totalClassNum,
            "itemNum"       => $totalNum,
            "whId"          => $whId,
            "rulelId"       => $ruleIds,
            "spsItemListIn" => $spsItemListIn,

        );
        $opt = array(
            'uin'       => $uid,
            'operator'  => $uid,    //操作者ID，一般填写用户QQ（对应setDwOperatorId）
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,
            'timeout'   => WEB_STUB_TIME_OUT,       //超时时间，以秒为单位，特殊情况下可以调大
        );

        ItilReport::itil_report($shoppingProcessItil[$scene]['promotion']['req']);
        $ret = WebStubCntl2::request('icson\promotion\ao\schedule\CheckPromotionInfo', array("opt" => $opt, "req" => $req));
		//返回6952促销规则有限制需要加
		if ($ret['code'] == -1)
        {

			self::$errCode = 106;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew invoke failed!]";
			Logger::err("checkRuleForOrder invoke return![errCode:{$ret['code']}][items:{$strItems}][whid:{$whId}][ruleid:{$ruleId}][type:{$type}][uid:{$uid}]");
			return  false;
		}
        else if($ret['code'] != 0)
        {

            self::$errCode = 107;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew invoke failed!]";
            Logger::err("checkRuleForOrder  return Error![errCode:{$ret['code']}][items:{$strItems}][whid:{$whId}][ruleid:{$ruleId}][type:{$type}][uid:{$uid}]");
            return  false;
        }
		/*
        if($ret['data']['errCode'] != 0 && $ret['data']['errCode'] != 6952)
		{

			self::$errCode = 108;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew promotion rule Error!][errCode:{$ret['code']['errCode']}]";
			Logger::err("checkRuleForOrder promotion rule Error![errCode:{$ret['code']['errCode']}][items:{$strItems}][whid:{$whId}][ruleid:{$ruleId}][type:{$type}][uid:{$uid}]");
			return  false;
		}
		*/
		if($ret['data']['errCode'] == 6952)
		{

			self::$errCode = self::$ERROR_RESTRICT;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew promotion rule restrict!][errCode:{$ret['code']}]";
			Logger::err("checkRuleForOrder promotion rule restrict![errCode:{$ret['data']['errCode']}][items:{$strItems}][whid:{$whId}][ruleid:{$ruleId}][type:{$type}][uid:{$uid}]");
			return  false;
		}

		if($totalClassNum != count($ret['data']['spsItemListOut']))
		{
			self::$errCode = 110;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew totalClassNum not equal mutl return num!]";
			$tmpCount = count($ret['data']['spsItemListOut']);
			Logger::err("checkRuleForOrderNew totalClassNum not equal mutl return num![totalClassNum:{$totalClassNum}][count:{$tmpCount}][whid:{$whId}][ruleid:{$ruleId}][type:{$type}][uid:{$uid}]");
			return  false;
		}
		
		//首先校验促销规则是否正确
		$spsOpInfoListOut = $ret['data']['spsOpInfoListOut'];
        $promotion = array();
		foreach($spsOpInfoListOut as $spsOpInfo)
		{
			if(2 != $spsOpInfo['opType'])
			{
				continue;
			}
            if(1 == $spsOpInfo['useRuleState'])
            {
                $promotion["rule_id"] = $spsOpInfo['ruleId'];
                $promotion["rule_sum_value"] = $spsOpInfo['ruleSumValue'];
                $promotion["url"] = $spsOpInfo['url'];
                $promotion["rule_type"] = $spsOpInfo['conditionType'];
                $promotion["benefit_type"] = $spsOpInfo['discountType'];
                $promotion["benefit_times"] = $spsOpInfo['stagePriceIndex'];
                $promotion["is_restrict"] = $ret['data']['errCode'] == 6952 ? 1 : 0;
                $promotion["stage_price_type"] = $spsOpInfo['stagePriceType'];

				$index = $spsOpInfo['stagePriceIndex'];
				if(0 == $spsOpInfo['stagePriceType'])
				{
					//自动梯度
                    $conditionValue = $spsOpInfo['conditionValue'][0] * $index;
                    if(self::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $promotion["benefit_type"])
                    {
                        $discountValue = $spsOpInfo['discountValue'][0];
                    }
                    else
                    {
                        $discountValue = $spsOpInfo['discountValue'][0] * $index;
                    }
				}
				else
				{
					//手动梯度
                    $conditionValue = $spsOpInfo['conditionValue'][$index-1];
                    if(self::$BenfitTypeNew['BENEFIT_TYPE_COUPON'] == $promotion["benefit_type"])
                    {
                        $promotion["benefit_times"] = 1;
                        $discountValue = $spsOpInfo['discountValue'][$index-1];
                    }
                    else
                    {
                        $discountValue = $spsOpInfo['discountValue'][$index-1];
                    }
				}
				$promotion["condition"] = $conditionValue;
				$promotion["benefits"] = $discountValue;
				$promotion["desc"] = iconv("utf8", "gbk//IGNORE", $spsOpInfo['opInfo']);
				//促销规则只能满足一条
			}
		}


		if($ruleId != 0)
		{
           if(isset($promotion["rule_id"]) && $promotion["rule_id"] != $ruleId)
           {
               $tmpCount = isset($spsOpInfoListOut) ? count($spsOpInfoListOut) : 0;
               $tmpRuleId = isset($promotion["rule_id"]) ? $promotion["rule_id"] : 0;

               self::$errCode = 111;
               self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[rule id error ][count promotion: {$tmpCount}][sps rule_id:{$tmpRuleId}][rule_id{$ruleId}]";
               Logger::err("checkRuleForOrder rule id error![count promotion :{$tmpCount}][sps rul_id:{$tmpRuleId}][whid:{$whId}][ruleid:{$ruleId}][type:{$type}][uid:{$uid}]");
               return false;
           }
           else if(empty($promotion))
           {
               $promotion = array();
           }
		}
		else
		{
			$promotion = array();
		}
		
		//处理数据
		$spsItemListOut = $ret['data']['spsItemListOut'];
		$promotionRuleInfo = array();
		reset($items);
		foreach($items as &$product)
		{
			foreach($spsItemListOut as $spsItem)
			{
				if($spsItem['itemId'] == $product["product_id"])
				{
					if($product["package_id"] != 0)
					{
						if($spsItem['itemType'] != 1)
						{
							continue;
						}
					}
                    else if($product["match_num"] > 0)
                    {
                        if($spsItem['itemType'] != 2)
                        {
                            continue;
                        }
                    }
					else
					{
						if($spsItem['itemType'] != 0)
						{
							continue;
						}
					}
					
					//如果商品有促销，但是促销规则，
					if($product["package_id"] > 0)
					{
						$product["promotion_price"] = $spsItem['itemPromotionPrice'] + ($product["pkg_cash_back"]*$product["buy_count"]); 				//商品满减促销后价格 n件
						$product["promotion_discount"] = $spsItem['itemPromotionDiscount'];			//商品满减促销优惠  n件
					}
                    else if($product["match_num"] > 0)
                    {
                        $product["promotion_price"] = $spsItem['itemPromotionPrice'] + ($product["match_cut"]*$product["match_num"]); 				//商品满减促销后价格 n件
                        $product["promotion_discount"] = $spsItem['itemPromotionDiscount'];			//商品满减促销优惠  n件
                    }
					else
					{
						$product["promotion_price"] = $spsItem['itemPromotionPrice'];				//商品满减促销后价格 n件
						$product["promotion_discount"] = $spsItem['itemPromotionDiscount'];			//商品满减促销优惠  n件
					}
                    /*
					$product["promotion_price"] = $spsItem['']->dwItemPromotionPrice;				//商品满减促销后价格 n件
					$product["promotion_discount"] = $spsItem['']->dwItemPromotionDiscount;			//商品满减促销优惠  n件
					*/
					//批价路径:多价和促销批价
					$spsItemOpPathList = $spsItem['spsItemOpPathList'];
					$product["op_path"] = array();
					foreach($spsItemOpPathList as $spsItemOpPath)
					{
						$opPath = array();
						$opPath["type"] = $spsItemOpPath['ruleType'];
						$opPath["before_price"] = $spsItemOpPath['beforePrice'];
						$opPath["after_price"] = $spsItemOpPath['afterPrice'];
						$opPath["rule_id"] = $spsItemOpPath['ruleId'];
						$opPath["rule_desc"] = iconv("utf8", "gbk//IGNORE", $spsItemOpPath['descInfo']);
						$opPath["rule_discount_info"] = $spsItemOpPath['discountInfo'];
						$opPath["rule_discount_type"] = $spsItemOpPath['discountType'];                    //1减金额，2券id，3折扣，4商品id，5积分，6折扣
						$opPath["rule_condition_Info"] = $spsItemOpPath['conditionInfo'];
						$opPath["rule_condition_type"] = $spsItemOpPath['conditionType'];
						$opPath["rule_condition_index"] = $spsItemOpPath['conditionIndex'];
						$opPath["rule_condition_info"] = $spsItemOpPath['conditionInfo'];
						$opPath["rule_condition_type"] = $spsItemOpPath['conditionType'];
						$opPath["rule_condition_index"] = $spsItemOpPath['conditionIndex'];
						$opPath["rule_cost_type"] = $spsItemOpPath['priceCoster'];
						if(1 == $opPath["type"])
						{
							$product["op_path"]["op_path_mult"][] = $opPath;
						}
						else if(2 == $opPath["type"])
						{
							$promotionRuleInfo[$opPath["rule_id"]]["pids"][] = $product["product_id"];
							$promotionRuleInfo[$opPath["rule_id"]]["account_type"] = $spsItemOpPath['priceCoster'];
							$product["op_path"]["op_path_full_discount"][] = $opPath;
						}
					}
					//多价
					if($product["package_id"] > 0 || $product["match_num"] > 0)
					{
						$product["total_price_before"] = $product["price"]* $product["buy_count"];
						$product["total_price_after"] = $product["price"]* $product["buy_count"];
						$product["total_price_discount"] = 0;
						$product["price_before"] = $product["price"];
						$product["price"] = $product["price"];
						$product["discount_price"] = 0;
						$product["mult_price_discount"] = 0;
						$product["energy_save_discount"] = 0;
						$product["energy_save_name"] = "";
						$product["energy_save_desc"] = "";
						$product["discount_p_name"] = "";
						$product["discount_p_desc"] = "";
						$product["price_buy_limit_rule"] = "";
						//多价限购
						$product["price_buy_limit_flag"] = 0;
						$product["mult_limit_num"] = 0;
						$product["price_cost_ratio"] = 0;
						$product["price_scene_id"] = 0;
						$product["price_source_id"] = 0;
						$product["mult_price_op_type"] = 0;
						$product["mult_price_op_num"] = 0;
						$product["is_price_rule"] = 0;
						$product["price_start_time"] = 0;
						$product["price_end_time"] = 0;
						break;
					}
					else
					{
						$priceInfoList = $spsItem['priceInfoList'][0];
						$product["total_price_before"] = $priceInfoList['priceBeforeFavor'];    //该款商品的优惠前价格，有n件商品，则为n件总值
						$product["total_price_after"] = $priceInfoList['priceAfterFavor'];		//该款商品多价的优惠后价格，有n件商品，则为n件总值
						$product["total_price_discount"] = $priceInfoList['priceDiscount'];      //该款商品多价总的优惠
						$product["price_before"] = $priceInfoList['unitPriceBeforeFavor'];		//单个商品优惠前价格
						$product["price"] = $priceInfoList['unitPriceAfterFavor'];			   	//单个商品多价优惠后的价价格
						$product["discount_price"] = $priceInfoList['unitPriceDiscount'];  		//单个商品多价优惠
						$product["mult_price_discount"] = $priceInfoList['multPriceDiscount'];	//该款商品非节能补贴的优惠金额
						$product["energy_save_discount"] = $priceInfoList['energySaveDiscount'];//该款商品节能补贴的优惠金额
                        $product["promotion_price"] = 2 == $type ? $priceInfoList['priceAfterFavor'] : $product["promotion_price"];
                        $product["energy_save_name"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['energySaveDesc']);
						$product["energy_save_desc"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['energySaveName']);
						$product["discount_p_name"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['priceName']);
						$product["discount_p_desc"] = iconv("utf8", "gbk//IGNORE", $priceInfoList['priceDesc']);
						$product["price_buy_limit_rule"] = $priceInfoList['priceBuyLimitRule'];
						//多价限购
						$product["price_buy_limit_flag"] = $priceInfoList['priceBuyLimitFlag'];
						$product["mult_limit_num"] = $priceInfoList['priceBuyLimitNum'];
						$product["price_cost_ratio"] = $priceInfoList['priceCoster'];
						$product["price_scene_id"] = $priceInfoList['priceSceneId'];
						$product["price_source_id"] = $priceInfoList['priceSourceId'];
                        $sourceId = $priceInfoList['priceSourceId'];
                        $sceneId = $priceInfoList['priceSceneId'];
						$product["mult_price_op_type"] =  isset($priceInfoList['priceOpType']) ?$priceInfoList['priceOpType'] : 0;                       //1定价，2减价，3折扣
						$product["mult_price_op_num"] = intval($priceInfoList['unitPriceOpNum']);	    //商品促销多价的操作金额，不考虑商品数量，如98折传 98，减10元传 10，定价为5元传 5
						$product["is_price_rule"] = 0;
							
						if(3 == $sourceId)
						{
							if(3 == $priceInfoList['priceOpType'])  //折扣
							{
                                $product["mult_price_op_num"] /= 10;
								$product["discount_p_name"] = $product["mult_price_op_num"] . "折优惠";
							}
							else if(2 == $priceInfoList['priceOpType'])		//下单立减
							{
                                $product["mult_price_op_num"] /= 100;
								$product["discount_p_name"] = "立减{$product["mult_price_op_num"]}元";
							}
							else
							{
								$product["discount_p_name"] = "";
							}
								
						}
						else if(5 == $sourceId || 4 == $sourceId || 8 == $sourceId)   //场景 身份价格
						{
						
						}
						else if(6 == $sourceId)   //阶梯价
						{
							/*
							 * 阶梯：1是第N件，2是满N件
							1steptype@2stepnum:3optype:95opnum
							*/
							$product["is_price_rule"] = 1;
							$priceRule = explode("@", $priceInfoList['priceRule']);
                            $priceRuleInfo = explode(":", $priceRule[1]);
                            $priceRuleInfo[2] = intval($priceRuleInfo[2]);
							$priceRuleInfo = explode(":", $priceRule[1]);
							$product["price_rule_type"] = $priceRule[0];
							$product["mult_price_rule_num"] = $priceRuleInfo[0];
							$product["price_op_ype"] =  $priceRuleInfo[1];
							$product["mult_price_op_num"] = $priceRuleInfo[2];
							$product["need_num"] = $priceInfoList['needNum'];
                            if($product['buy_count'] < $product["mult_price_op_num"])
                            {
                                $product["price_scene_id"] = 2;				//梯度规则不满足 使用易迅场景id 批价记录
                                $product["price_source_id"] = 2;			//
                            }
							//阶梯价是显示易迅价的
							$product["price_before"] = $product["price"];
							$product["discount_price"] = 0;
							if(1 == $priceRule[0])
							{
								if(1 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "第{$priceRuleInfo[0]}件{$priceRuleInfo[2]}元";
								}
								else if(2 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "第{$priceRuleInfo[0]}件减{$priceRuleInfo[2]}元";
								}
								else if(3 == $product["price_op_ype"])
								{
                                    $priceRuleInfo[2] /= 10;
									$product["discount_p_name"] = "第{$priceRuleInfo[0]}件{$priceRuleInfo[2]}折";
								}
								else
								{
									$product["discount_p_name"] = "";
								}
							}
							else if(2 == $priceRule[0])
							{
									
								if(1 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "满{$priceRuleInfo[0]}件{$priceRuleInfo[2]}元";
								}
								else if(2 == $product["price_op_ype"])
								{
									$priceRuleInfo[2] /= 100;
									$product["discount_p_name"] = "满{$priceRuleInfo[0]}件减{$priceRuleInfo[2]}元";
								}
								else if(3 == $product["price_op_ype"])
								{
                                    $priceRuleInfo[2] /= 10;
									$product["discount_p_name"] = "满{$priceRuleInfo[0]}件{$priceRuleInfo[2]}折";
								}
								else
								{
									$product["discount_p_name"] = "";
								}
							}
						}
						$product["price_start_time"] = $priceInfoList['priceStartTime'];
						$product["price_end_time"] = $priceInfoList['priceEndTime'];
						break;
					}
				}
			}
		}
		if($ruleId != 0  && isset($promotion["rule_id"]) && $ruleId == $promotion["rule_id"])
		{
			$promotion["pids"] = $promotionRuleInfo[$ruleId]["pids"];
			$promotion["account_type"] = $promotionRuleInfo[$ruleId]["account_type"];
		}
		$restrictParamList = $ret['data']['restrictParamList'];
		$restrictOut = array();
		//促销规则的限制
		foreach($restrictParamList as $restrict)
		{
			$restrictParam = array();
			$restrictParam["bussiness_id"] = $restrict['bussinessId'];
			$restrictParam["edm_1"] = $restrict['edm1'];
			$restrictParam["edm_2"] = $restrict['edm2'];
			$restrictParam["edm_3"] = $restrict['edm3'];
			$restrictParam["num"] = $restrict['num'];
			$restrictParam["is_restrict"] = $restrict['isRestrict'];
			$restrictParam["sur_plus"] = $restrict['surplus'];
			$restrictParam["threshold"] = $restrict['threshold'];
			$restrictParam["deduct_time"] = $restrict['dwDeductTime'];
			$restrictParam["desc"] = $restrict['desc'];

			$restrictOut[] = $restrictParam;
		}
		//这里对促销校验
		$promtionRule = array(
				"items" => $items,
				"promotion" => $promotion,
				"restrict" => $restrictOut			//做扣减使用，前端没有用
		);
		$strPromoRule = ToolUtil::gbJsonEncode($promtionRule);
		Logger::info("checkRuleForOrder Finish[promtionRule:{$strPromoRule}]");
		return $promtionRule;
	}

	/**
	 * 获取商品的多价信息
	 * @param array $items
	 * @param number $whId
	 * @param number $type
	 * @param number $uid
	 * @return boolean|unknown
	 */
	public static function checkItmeMultPriceRestrict($items, $whId, $type=1, $uid=0)
    {
        $uin = $uid;
        if (0 == $uid) {
            $uin = rand(0,1000);
        }
		$strItems = ToolUtil::gbJsonEncode($items);
		Logger::info("checkItmeMultPriceRestrict start:[items:{$strItems}][whid:{$whId}][type:{$type}][uid:{$uid}]");
		if (!is_array($items) || count($items) == 0 ) {
			self::$errCode = 112;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkItmeMultPriceRestrict para Error!]";
			Logger::err("checkItmeMultPriceRestrict para error![strItems{$strItems}][whid:{$whId}][type:{$type}][uid:{$uid}]");
			return false;
		}
        global $shoppingProcessOtherItil;
        $itilId = $shoppingProcessOtherItil['cartMultPrice']['succ']."|".$shoppingProcessOtherItil['cartMultPrice']['failed']."|".$shoppingProcessOtherItil['cartMultPrice']['timeout'];
        $uid = intval($uid);
        $spsItemListIn = array();
        foreach($items as $product)
        {
            if($product['package_id'] > 0)
            {
                continue;
            }
            $spsItem = array();
            $spsItem['itemId'] = $product['product_id'];
            $spsItem['itemId_u'] = 1;
            $spsItem['metaId'] = $product['c3_ids'];
            $spsItem['metaId_u'] = 1;
            $spsItem['itemWareHouseid'] = $product['psystock'];
            $spsItem['itemWareHouseid_u'] = 1;
            if(isset($product['chid']) && !empty($product['chid']))
            {
                $sourceScene = explode("@", $product['chid']);
                if(count($sourceScene) > 0)
                {
                    $sourceScene = array_unique($sourceScene);
                    foreach($sourceScene as &$ss)
                    {
                        $ss = intval($ss);
                    }
                    $spsItem['actId'] = $sourceScene;
                    $spsItem['actId_u'] = 1;
                }
            }
            $spsItem['itemPrice'] = $product['price'] * $product['buy_count'];
            $spsItem['itemPrice_u'] = 1;
            $spsItem['itemUnitPrice'] = $product['price'];
            $spsItem['itemUnitPrice_u'] = 1;
            $spsItem['itemNum'] = $product['buy_count'];
            $spsItem['itemNum_u'] = 1;
            $spsItem['pkgId'] = $product['package_id'];
            $spsItem['pkgId_u'] = 1;
            $spsItem['itemType'] = ($product['package_id'] != 0)? 1 : (($product['match_num'] >0)? 2:0);	//这里要注意前端需要处理套餐如果不处理这边会有问题
            $spsItem['itemType_u'] = 1;
            $spsItemListIn[$product['product_id']] = $spsItem;
        }

        $req = array(
            "machineKey"          => ToolUtil::getClientIP(),
            "source"              => __FILE__,
            "sceneId"             => $type,
            "uin"                 => $uid,
            "whId"                => $whId,
            "regionId"            => 0,
            "channelId"           => "",
            "itemPriceInfoListIn" => $spsItemListIn,
        );
        $opt = array(
            'uin'       => $uin,
            'operator'  => $uin,    //操作者ID，一般填写用户QQ（对应setDwOperatorId）
            'caller'    => "yx_shoppingprocess_cart",
            'itil'      => $itilId,
            'timeout'   => WEB_STUB_TIME_OUT,       //超时时间，以秒为单位，特殊情况下可以调大
        );
        $ret = WebStubCntl2::request('icson\multprice\ao\multprice4buy\CalcMultPrice', array("opt" => $opt, "req" => $req));
		//Logger::info("checkItmeMultPriceRestrict invoke return:[ret:{$ret}][errCode:{$resp->errCode}]");
		if ($ret['code'] == -1)
        {
            ItilReport::itil_report($shoppingProcessOtherItil['cartMultPrice']['req']);
			self::$errCode = 113;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkItmeMultPriceRestrict invoke failed!]";
			Logger::err("checkItmeMultPriceRestrict invoke failed![errCode:{$ret['code']}][strItems{$strItems}][whid:{$whId}][type:{$type}][uid:{$uid}]");
			return  false;
		}
        if ($ret['code'] != 0)
        {
            self::$errCode = 114;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew invoke failed!]";
            Logger::err("checkItmeMultPriceRestrict  return Error![result:{$ret['code']}][strItems{$strItems}][whid:{$whId}][strItems{$strItems}][type:{$type}][uid:{$uid}]");
            return  false;
        }

		//Logger::info("resp==>".print_r( $resp->restrictParamList, true));
		//处理数据
		$restrictParamInfo = $ret['data']['restrictParamList'];
		foreach($items as &$product)
		{
			$product["mult_limit"] = 0;
			$product["mult_limit_num"] = 0;
			if($product['package_id'] == 0)
			{
				//普通商品
				foreach($restrictParamInfo as $restrict)
				{
					$productId = explode("+", $restrict['edm3']);
					$productId = $productId[0];
					if($productId == $product["product_id"])
					{
						//商品结构上添加限购信息
						$product["mult_limit"] = $restrict['isRestrict'];
						$product["mult_limit_num"] = $restrict['surplus'];
						break;
					}
				}
			}
		}
		$strItems = ToolUtil::gbJsonEncode($items);
		Logger::info("checkItmeMultPriceRestrict Finish[strItems:{$strItems}]");
		return $items;
	}

	public static function dealPromotionRestrict($restricts, $uid, $scene = SCENE_SHOPPING_ORDER)
	{
		if (!is_array($restricts) || count($restricts) == 0 ) {
			return "";
		}
		$strRestrict = ToolUtil::gbJsonEncode($restricts);
		Logger::info("dealPromotionRestrict Start[restricts:{$strRestrict}][uid:{$uid}]");
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['promotionLimitDeal']['succ']."|".$shoppingProcessItil[$scene]['promotionLimitDeal']['failed']."|".$shoppingProcessItil[$scene]['promotionLimitDeal']['timeout'];

        $uid = intval($uid);
        $restrictParamListIn = array();
        foreach($restricts as $restrict)
        {
            $restrictParam = array();
            $restrictParam['bussinessId']   = $restrict['bussiness_id'];
            $restrictParam['edm1']          = $restrict['edm_1'];
            $restrictParam['edm2']          = $restrict['edm_2'];
            $restrictParam['edm3']          = $restrict['edm_3'];
            $restrictParam['num']           =$restrict['num'];
            $restrictParam['dwDeductTime']  = $restrict['deduct_time'];
            $restrictParamListIn[] = $restrictParam;
        }
        $req = array(
            "machineKey"          => '0',
            "source"              => __FILE__,
            "sceneId"             => 0,
            "uin"                 => $uid,
            "restrictParamListIn" => $restrictParamListIn,

        );
        $opt = array(
            'uin'       => $uid,
            'operator'  => $uid,    //操作者ID，一般填写用户QQ（对应setDwOperatorId）
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,
            'timeout'   => WEB_STUB_TIME_OUT,       //超时时间，以秒为单位，特殊情况下可以调大
        );

        ItilReport::itil_report($shoppingProcessItil[$scene]['promotionLimitDeal']['req']);
        $ret = WebStubCntl2::request('icson\promotionrestrict\ao\promotionrestrict\GetDealBatchPromotionRestrict', array("opt" => $opt, "req" => $req));
		if ($ret['code'] == -1) {
			self::$errCode = 115;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[dealPromotionRestrict invoke failed!]";
			Logger::err("dealPromotionRestrict invoke failed![errCode:{$ret['code']}][strRestrict{$strRestrict}][uid:{$uid}]");
			return  false;
		}
        else if($ret['code'] != 0)
        {
            self::$errCode = 116;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew invoke failed!]";
            Logger::err("checkItmeMultPriceRestrict  return Error![result:{$ret['code']}][strRestrict{$strRestrict}][uid:{$uid}]");
            return  false;
        }

		$restrictParamListOut = $ret['data']['restrictParamListOut'];
		$restrictOut = array();
		foreach($restrictParamListOut as $restrict)
		{
			$restrictParam = array();
			$restrictParam["bussiness_id"] = $restrict['bussinessId'];
			$restrictParam["edm_1"] = $restrict['edm1'];
			$restrictParam["edm_2"] = $restrict['edm2'];
			$restrictParam["edm_3"] = $restrict['edm3'];
			$restrictParam["num"] = $restrict['num'];
			$restrictParam["deduct_time"] = $restrict['dwDeductTime'];
			$restrictOut[] = $restrictParam;
		}
		
		$strRestrictOut = ToolUtil::gbJsonEncode($restrictOut);
		Logger::info("dealPromotionRestrict Finish[strRestrictOut:{$strRestrictOut}]");
		return array('restrict' => $restrictOut);
	}
	
	public static function rollbackPromotionRestrict($restricts, $uid, $scene = SCENE_SHOPPING_ORDER)
	{
		if (!is_array($restricts) || count($restricts) == 0 ) {
			return "";
		}

		$strRestrict = ToolUtil::gbJsonEncode($restricts);
		Logger::info("rollbackPromotionRestrict Start[restricts:{$restricts}][uid:{$uid}]");
        global $shoppingProcessItil;
        $itilId = $shoppingProcessItil[$scene]['promotionLimitRollback']['succ']."|".$shoppingProcessItil[$scene]['promotionLimitRollback']['failed']."|".$shoppingProcessItil[$scene]['promotionLimitRollback']['timeout'];

        $uid = intval($uid);
        $restrictParamListIn = array();
        foreach($restricts as $restrict)
        {
            $restrictParam = array();
            $restrictParam['bussinessId']   = $restrict['bussiness_id'];
            $restrictParam['edm1']          = $restrict['edm_1'];
            $restrictParam['edm2']          = $restrict['edm_2'];
            $restrictParam['edm3']          = $restrict['edm_3'];
            $restrictParam['num']           =$restrict['num'];
            $restrictParam['dwDeductTime']  = $restrict['deduct_time'];
            $restrictParamListIn[] = $restrictParam;
        }
        $req = array(
            "machineKey"          => '0',
            "source"              => __FILE__,
            "sceneId"             => 0,
            "uin"                 => $uid,
            "restrictParamListIn" => $restrictParamListIn,
        );
        $opt = array(
            'uin'       => $uid,
            'operator'  => $uid,    //操作者ID，一般填写用户QQ（对应setDwOperatorId）
            'caller'    => "yx_shoppingprocess_" . $scene,
            'itil'      => $itilId,
            'timeout'   => WEB_STUB_TIME_OUT,       //超时时间，以秒为单位，特殊情况下可以调大
        );
        ItilReport::itil_report($shoppingProcessItil[$scene]['promotionLimitRollback']['req']);
        $ret = WebStubCntl2::request('icson\promotionrestrict\ao\promotionrestrict\RollbackDealBatchPromotionRestrict', array("opt" => $opt, "req" => $req));
		if ($ret['code'] == -1) {
			self::$errCode = 117;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[rollbackPromotionRestrict invoke failed!]";
			Logger::err("rollbackPromotionRestrict invoke failed![errCode:{$ret['code']}][strRestrict{$strRestrict}][uid:{$uid}]");
			return  false;
		}
        else if($ret['code'] != 0)
        {
            self::$errCode = 118;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[checkRuleForOrderNew invoke failed!]";
            Logger::err("rollbackPromotionRestrict  return Error![errCode:{$ret['code']}][strRestrict{$strRestrict}][uid:{$uid}]");
            return  false;
        }

		return true;
	}
	
	/**
	 * 促销规则名称构造
	 * @param array $ruleInfo
	 */
	public static function appendNameOfRule(&$ruleInfo){
		if(!empty($ruleInfo) && !empty($ruleInfo['rule_type']) && !empty($ruleInfo['benefit_type'])
		&& isset(self::$RuleTypeName[$ruleInfo['rule_type']]) && isset(self::$BenfitTypeName[$ruleInfo['benefit_type']]))
		{
	
			$ruleTypeName = self::$RuleTypeName[$ruleInfo['rule_type']];
			if($ruleInfo['rule_type'] == self::$RuleType["RULE_TYPE_CASH_AMT"])
			{
				$amt = $ruleInfo['condition']/100;
				//if($amt <= 10) $amt .= '元';
				$amt .= '元';
				$ruleTypeName = str_replace("{_cash_amt_}", $amt, $ruleTypeName);
			}
			else if($ruleInfo['rule_type'] == self::$RuleType["RULE_TYPE_BUY_NUM"])
			{
				$ruleTypeName = str_replace("{_buy_num_}", $ruleInfo['condition'], $ruleTypeName);
			}
	
			$benfitTypeName = self::$BenfitTypeName[$ruleInfo['benefit_type']];
			if($ruleInfo['benefit_type'] == 5)
			{
				$benfitTypeName = str_replace("{_point_}", $ruleInfo['benefits'], $benfitTypeName);
			} else if($ruleInfo['benefit_type'] == 1)
			{
				//$cash = sprintf("%d", $ruleInfo['benefits']/100);
				//if($cash <= 10) $cash .= '元';
				$cash = $ruleInfo['benefits']/100;
				$cash .= '元';
				$benfitTypeName = str_replace("{_cash_}", $cash, $benfitTypeName);
			}
			else if($ruleInfo['benefit_type'] == 3)
			{
				$discountName = '';
				if($ruleInfo['benefits'] % 10 == 0)
				{
					$discountName = $ruleInfo['benefits'] / 10;
				} else {
					$discountName = $ruleInfo['benefits'];
				}
				$discountName .= '折';
				$benfitTypeName = str_replace("{_discount_name_}", $discountName, $benfitTypeName);
			}
			else if($ruleInfo['benefit_type'] == 2)
			{
				$discountName = '';
				
				$benfitTypeName = $benfitTypeName;//str_replace("{_discount_name_}", $discountName, $benfitTypeName);
			}
	
			$ruleInfo['name'] = $ruleTypeName . $benfitTypeName;
		}
	}
    /**
     * 同步脚本使用
     */
    public static function getPromtionRuleInfo($ruleId){
        $req = array(
            "uin"    => 0,
            "source" => __FILE__,
            "scene"  => 0,
            "ruleId" => intval($ruleId),
        );
        $uid = rand(0,1000);
        $opt = array(
            'uin'       => $uid,
            'operator'  => $uid,    //操作者ID，一般填写用户QQ（对应setDwOperatorId）
            'timeout'   => WEB_STUB_TIME_OUT,       //超时时间，以秒为单位，特殊情况下可以调大
        );

        $ret = WebStubCntl2::request('icson\promotion\ao\detail\GetRuleForGuanguan', array("opt" => $opt, "req" => $req));
        if ($ret['code'] != 0)
        {
            return  false;
        }
        else{
            $ruleInfo = array();
            if(isset($ret['data']['opinfo']))
            {
                $ruleInfo['comment'] = $ret['data']['opinfo'];
                $ruleInfo['rule_desc'] = $ret['data']['desc'];
            }
            return $ruleInfo;
        }
    }
}
