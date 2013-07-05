<?php
if(!defined("PHPLIB_ROOT")) {
    define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once (PHPLIB_ROOT . 'api/appplatform/skuorderao_php5_stub.php');
require_once (PHPLIB_ROOT . 'api/appplatform/deal51buyao_php5_stub.php');
//require_once (PHPLIB_ROOT . 'api/appplatform/usericsonao_php5_stub.php');
require_once (PHPLIB_ROOT . 'inc/uniorder.inc.php');
require_once (PHPLIB_ROOT . 'inc/customphone.inc.php');
require_once(PHPLIB_ROOT . 'api/appplatform/promotionrestrictao_php5_stub.php');
require_once(PHPLIB_ROOT . 'api/appplatform/spsschedulepromotion_php5_stub.php');
//require_once(PHPLIB_ROOT . 'api/appplatform/inventoryviewao_php5_stub.php');

class ICustomPhone
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	private static function _getTTCInfo($ttcname,$key,$line,$filter=array(),$need=array())
	{
		$ttc = new $ttcname;
		$item = $ttc->get($key, $filter, $need);
		if( false === $item )
		{
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . $line . "[{$ttcname} get failed:]";
			return false;
		}
		return $item;
	}
	
	private static function _getTTCInfos($ttcname,$keys,$line,$filter=array(),$need=array())
	{
		$ttc = new $ttcname;
		$items = $ttc->gets($keys, $filter, $need);
		if( false === $items )
		{
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . $line . "[{$ttcname} get failed:]";
			return false;
		}

		return $items;
	}
	
	private static function _getDBInt($id,$prefix,&$mysql,&$index,$line)
	{
		$index = ToolUtil::getUserDBTableIndex($id);
		$mysql = ToolUtil::getDBObj($prefix,$index['db']);
		if (!$mysql)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: $line _getDB Error".ToolUtil::$errMsg;
			return false;
		}
		return true;

	}

	private static function _getDBStr($str,$prefix,&$mysql,&$index,$line)
	{
		$hash = ToolUtil::TTCStr2Hash($str);
		$index = ToolUtil::getUserDBTableIndex($hash);
		$mysql = ToolUtil::getDBObj($prefix,$index['db']);

		if (!$mysql)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: $line _getDB Error".ToolUtil::$errMsg;
			return false;
		}
		return true;

	}
	
	private static function _getDB($dbname,&$mysql,$line)
	{
		$mysql = ToolUtil::getDBObj($dbname);
		if (!$mysql)
		{
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: $line _getDB Error".ToolUtil::$errMsg;
			return false;
		}
		return true;
	}
	
	public static function _getDB_s($dbname,&$mysql,$line)
	{
		$mysql = ToolUtil::getDBObj($dbname);
		if (!$mysql)
		{
			self::$errCode = self::$errCode;
			self::$errMsg = basename(__FILE__,'php') . " | Line: $line _getDB Error".self::$errMsg;
			return false;
		}
		return true;
	}
	
	private static function _update($prefix,&$mysql,&$index,&$data,$condition,$line)
	{
		$uRet = $mysql->update($prefix.$index['table'], $data, $condition);
		if (false === $uRet)
		{
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line \n_update info to mysql faild:". $mysql->errMsg;
			$mysql->execSql("rollback");
			return false;

		}
		return true;
	}
	
	public static function _select_s(&$mysql,$sql,$line)
	{
		$uRet = $mysql->getRows($sql);
		if (false === $uRet)
		{
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line _select info to mysql faild:". $mysql->errMsg;
			return false;
		}

		return $uRet;
	}
	
	public static function _update_s($tbname,&$mysql,$data,$condition,$line)
	{
		$uRet = $mysql->update($tbname, $data, $condition);
		//Logger::err($mysql->getUpdateString($tbname, $data, $condition));
		if (false === $uRet)
		{
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line \n_update info to mysql faild:". $mysql->errMsg;
			$mysql->execSql("rollback");
			return false;

		}
		return true;
	}
	
	private static function _remove_s($uid,$tbname,&$mysql,$condition,$line)
	{
		$uRet = $mysql->remove($tbname, $condition);
		if (false === $uRet)
		{
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line _remove ($uid) info to mysql faild:". $mysql->errMsg;
			$mysql->execSql("rollback");
			return false;
		}
		return true;
	}

	public static function _insert_s($tbname,&$mysql,&$data,$line)
	{
		$uRet = $mysql->insert($tbname, $data);
		if (false === $uRet)
		{
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line _insert info to mysql faild:". $mysql->errMsg;
			$mysql->execSql("rollback");
			return false;
		}
		return true;
	}
	
	private static function _purgeData4Str($ttcname,$str)
	{
		if(!empty($str))
			IAsyTask::purgeTTCData($ttcname, $str);
	}

	private static function _purgeData4Int($ttcname,$num)
	{
		IAsyTask::purgeTTCData($ttcname, $num);
	}
	
	
	private static function _transaction($mysql,$cmd,$line)
	{
		if (false === $mysql->execSql($cmd))
		{
			self::$errCode = $mysql->errMsg;
			self::$errMsg = basename(__FILE__,"php") . " | Line: $line $cmd Transaction Error".$mysql->errMsg;
			return false;
		}
		return true;
	}
        
        private static function _getWgUidByIcsonUid($uid)
        {
            $result = \WebStubCntl2::request('b2b2c\user\ao\GetWgUidByIcsonUid', array(
                'opt' => array(
                    'uin' => $uid,
                    'operator' => $uid,
                ),
                'req' => array(
                    'source' => __FILE__,
                    'sceneId' => 0, //场景id，保留，默认填0即可
                    'machineKey' => isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : '',
                    'icsonUid' => $uid, //易迅用户id，目前仅支持32位
                    'inReserve' => ''
                )
            ));
            if ($result === false)
            {
                Logger::err("_GetWgUidByIcsonUid failed, WebStubCntl2::request request error, uid:{$uid}");
                return false;
            }
            else 
            {
                if ($result['code'] != 0)
                {
                    Logger::err("_GetWgUidByIcsonUid failed, code:{$result['code']}, msg:{$result['msg']}, uid:{$uid}");
                    return false;
                }
                else
                {
                    Logger::info("_GetWgUidByIcsonUid success, wgid:{$result['data']['wgUid']}, uid:{$uid}");
                    return $result['data']['wgUid'];
                }
             }
        }
        
	//库存双写 S zaleli
	private function _parameterHash($fixupInfoPo)
	{
		$paraHash  = $fixupInfoPo['productSysno'] . "|";
		$paraHash .= $fixupInfoPo['stockSysno'] . "|";
		$paraHash .= $fixupInfoPo['orderToken'] . "|";
		$paraHash .= $fixupInfoPo['orderSequence'] . "|";
		$paraHash .= $fixupInfoPo['orderSysno'] . "|";
		$paraHash .= $fixupInfoPo['userNo'] . "|";
		$paraHash .= "0|";
		$paraHash .= $fixupInfoPo['orderDecreasedNum'] . "|";
		$paraHash .= "0|0|0|0|";

		return $paraHash;
	}
	private function _parameterFactory($uid, $modifyType, $inventroyData)
	{
		$fixupInfoPo = array();
		$fixupInfoPo['productSysno'] = $inventroyData['product_id'];
		$fixupInfoPo['stockSysno'] = $inventroyData['sys_stock'];
		$fixupInfoPo['orderToken'] = $inventroyData['order_id'];
		$fixupInfoPo['orderSequence'] = $inventroyData['order_creat_time'];
		$fixupInfoPo['orderSysno'] = $inventroyData['order_id'];
		$fixupInfoPo['userNo'] = $uid;
		$fixupInfoPo['platform'] = 1;
		$fixupInfoPo['orderDecreasedNum'] = $inventroyData['buy_count'];
		$fixupInfoPo['orderSource'] = 7;
		$fixupInfoPo['orderType'] = $inventroyData['order_type'];
		$fixupInfoPo['fixupHash'] = self::_parameterHash($fixupInfoPo);

		$event4AppPo = array();
		$event4AppPo['eventId'] = $inventroyData['order_id'];
		$event4AppPo['eventType'] = 1;
		$event4AppPo['eventSourceId'] = 1;
		$event4AppPo['eventModifyType'] = $modifyType;
		$event4AppPo['eventCreateTime'] = $inventroyData['order_creat_time'];
		$event4AppPo['eventExcuteTime'] = time();
		$event4AppPo['operatorId'] = $uid;
		$event4AppPo['operatorClientIp'] = ToolUtil::getClientIP();
		return array(
			'fixupInfoPo' => $fixupInfoPo,
			'event4AppPo' => $event4AppPo,
		);
	}
	//锁库存
	private function _setLockInventory($inventroyAllDatas,$uid)
	{
		Logger::info("_setLockInventory Start! inventroyAllDatas:".ToolUtil::gbJsonEncode($inventroyAllDatas)." uid:".$uid);
		$uid = intval($uid);
		if ($uid == 0)
		{
			//打印日志，告警
			Logger::err("uid==0");
			return false;
		}
		foreach ($inventroyAllDatas as $inventroyData)
		{
			$inputPara = self::_parameterFactory($uid, 1, $inventroyData);
			$result = WebStubCntl2::request('b2b2c\skuorder\ao\LockProduct',
				array( 
					'opt'=>array(
						'uin' => $uid,//使用Mod+L5方式设置路由，一般填写用户QQ（对应setDwUin）
						'operator' => $uid,//操作者ID，一般填写用户QQ（对应setDwOperatorId）
						'caller' => 'customphone',//调用方名字，用于模调(对应setCallerName)
						'timeout' => 1,//超时时间，以秒为单位，特殊情况下可以调大
					),
					'req'=>array(
						'machineKey' => __FILE__,
						'source' => __FILE__,
						'sceneId' => 10011,//合约机调用场景
						'optionId' => 0,
						'lockType' => 0,//非活动库存锁定填0
						'fixupInfoPo' => $inputPara['fixupInfoPo'],//锁定请求
						'eventPo' => $inputPara['event4AppPo'],//事务单
						'inReserve' => ''
					)
				)
			);
			if ($result['code']!=0 || $result['data']['result']!=0)
			{
				//打印日志，告警
				Logger::err("LockProduct Request Err,code:".$result['code']." errmsg:".$result['msg']." result:".$result['data']['result']);
				exd_Attr_API2(635069, 1);
				return false;
			}
		}
		Logger::info("_setLockInventory Finish! uid:".$uid);
		return true;
	}
	//解锁库存
	private function _setUnLockInventory($inventroyAllDatas,$uid)
	{
		Logger::info("_setUnLockInventory Start! inventroyAllDatas:".ToolUtil::gbJsonEncode($inventroyAllDatas)." uid:".$uid);
		$uid = intval($uid);
		if ($uid == 0)
		{
			//打印日志，告警
			Logger::err("uid==0");
			return false;
		}
		foreach ($inventroyAllDatas as $inventroyData)
		{
			$inputPara = self::_parameterFactory($uid, 2, $inventroyData);
			$result = WebStubCntl2::request('b2b2c\skuorder\ao\UnlockProduct',
				array( 
					'opt'=>array(
						'uin' => $uid,//使用Mod+L5方式设置路由，一般填写用户QQ（对应setDwUin）
						'operator' => $uid,//操作者ID，一般填写用户QQ（对应setDwOperatorId）
						'caller' => 'customphone',//调用方名字，用于模调(对应setCallerName)
						'timeout' => 1,//超时时间，以秒为单位，特殊情况下可以调大
					),
					'req'=>array(
						'machineKey' => __FILE__,
						'source' => __FILE__,
						'sceneId' => 10011,//合约机调用场景
						'optionId' => 0,
						'fixupInfoPo' => $inputPara['fixupInfoPo'],//锁定请求
						'eventPo' => $inputPara['event4AppPo'],//事务单
						'inReserve' => ''
					)
				)
			);
			if ($result['code']!=0 || $result['data']['result']!=0)
			{
				//打印日志，告警
				exd_Attr_API2(635070, 1);
				Logger::err("UnlockProduct Request Err,code:".$result['code']." errmsg:".$result['msg']." result:".$result['data']['result']);
				return false;
			}
		}
		Logger::info("_setUnLockInventory Finish! uid:".$uid);
		return true;
	}
	//库存双写 E zaleli
	//接入促销2.0 S zaleli
		/**
		 * 订单确认页、生成订单促销规则验证接口
		 * @param array $item
		 * @param number $whId
		 * @param number $uid
		 * @param number $ruleId
		 * @param number $type
		 * @return array
		 */
	private function _checkRuleForOrder($item, $whId, $chId, $uid, $ruleId, $type=1)
	{
		Logger::info("_checkRuleForOrder start. item:".ToolUtil::gbJsonEncode($item)." whId:".$whId." chId:".$chId." uid:".$uid." ruleId:".$ruleId." type:".$type);
		$uid = intval($uid);
		if ($uid == 0)
		{
			//打印日志，告警
			Logger::err("_checkRuleForOrder err! uid:".$uid);
			return false;
		}
		$arrSpsItemListIn = array();
		$spsItem['itemId'] = $item['pid'];
		if($chId >0){
			$arrActId = array();
			$arrActId[] = $chId;
			$spsItem['actId'] = $arrActId;
		}
		$spsItem['itemNum'] = 1;//合约机默认只有一件
		$spsItem['pkgId'] = 0;//非套餐商品
		$spsItem['itemType'] = 0;//普通商品
		$arrSpsItemListIn[] = $spsItem;
		$result = WebStubCntl2::request('icson\promotion\ao\schedule\CheckPromotionInfo',
			array( 
				'opt'=>array(
					'uin' => $uid,//使用Mod+L5方式设置路由，一般填写用户QQ（对应setDwUin）
					'operator' => $uid,//操作者ID，一般填写用户QQ（对应setDwOperatorId）
					'caller' => 'customphone',//调用方名字，用于模调(对应setCallerName)
					'timeout' => 1,//超时时间，以秒为单位，特殊情况下可以调大
				),
				'req'=>array(
					'uin' => $uid,
					'source' => __FILE__,
					'scene' => 1,//普通购物车类型
					'itemClassNum' => 1,//合约机默认只有一款
					'itemNum' => 1,//合约机默认只有一件
					'whId' => $whId,//分站ID
					'regionId' => 0,
					'channelId' => '',
					'rulelId' => array(),//规则ID一期为空，不批满减
					'spsItemListIn' => $arrSpsItemListIn,
					'inReserve' => '',
					'extent' => array()
				)
			)
		);
		if ($result['code']!=0 || $result['data']['result']!=0)
		{
			//打印日志，告警
			exd_Attr_API2(635068, 1);
			Logger::err("CheckPromotionInfo error, code:" . $result['code'] . " result:" . $result['data']['result'] . " msg:".$result['msg']);
			return false;
		}
		if (count($result['data']['spsItemListOut']) != 1)
		{
			//打印日志，告警
			exd_Attr_API2(635068, 1);
			Logger::err("_checkRuleForOrder err! spsItemListOut size:".count($result['data']['spsItemListOut']));
			return false;
		}
		$promotion = array();
		$priceInfo = array();
		//获取多价信息
		foreach($result['data']['spsItemListOut'] as $spsItem)
		{
			$priceInfo['itemId'] = $spsItem['itemId'];
			if (count($spsItem['priceInfoList']) != 1)
			{
				//打印日志，告警
				exd_Attr_API2(635068, 1);
				Logger::err("_checkRuleForOrder err! priceInfoList size:".count($spsItem['priceInfoList']));
				return false;
			}
			$priceInfo['priceAfterFavor'] = $spsItem['priceInfoList'][0]['priceAfterFavor'];
			$priceInfo['is_restrict'] = $spsItem['priceInfoList'][0]['priceBuyLimitFlag'];
			$priceInfo['priceBeforeFavor'] = $spsItem['priceInfoList'][0]['priceBeforeFavor'];
			$priceInfo['priceDiscount'] = $spsItem['priceInfoList'][0]['priceDiscount'];
			$priceInfo['priceOpType'] = $spsItem['priceInfoList'][0]['priceOpType'];
			$priceInfo['unitPriceOpNum'] = $spsItem['priceInfoList'][0]['unitPriceOpNum'];
			$priceInfo['priceSceneId'] = $spsItem['priceInfoList'][0]['priceSceneId'];
			$priceInfo['priceSourceId'] = $spsItem['priceInfoList'][0]['priceSourceId'];
		}
		//返回多价信息
		$promotion['item'] = $priceInfo;
		//返回限购信息，用于扣减生效次数与回退生效次数
		$promotion['restrict'] = $result['data']['restrictParamList'];
		Logger::info("_checkRuleForOrder finish. promotion:".ToolUtil::gbJsonEncode($promotion)." whId:".$whId." chId:".$chId." uid:".$uid." ruleId:".$ruleId." type:".$type);
		return $promotion;
	}
	//为product_base_info增加多价信息
	private function _setMultPriceInfo($product_base_info,$whId,$chId,$uid,$mainPid)
	{
		Logger::info("_setMultPriceInfo start. whId:".$whId." chId:".$chId." uid:".$uid);
		if (false === $product_base_info)
		{
			return $product_base_info;
		}
		if (!is_array($product_base_info))
		{
			return $product_base_info;
		}
		foreach ($product_base_info as $pid=>$product)
		{
			if ($pid != $mainPid)
			{
				//非主商品不访问多价
				$product_base_info[$pid]['is_restrict'] = 0;
				$product_base_info[$pid]['restrict'] = "";
				$multprice = array();
				$multprice['priceBeforeFavor'] = 0;
				$multprice['priceAfterFavor'] = 0;
				$multprice['priceDiscount'] = 0;
				$multprice['priceOpType'] = 0;
				$multprice['unitPriceOpNum'] = 0;
				$multprice['priceSceneId'] = 0;
				$multprice['priceSourceId'] = 0;
				$product_base_info[$pid]['multprice'] = $multprice;
				continue;
			}
			$item['pid'] = $pid;
			$promotion = self::_checkRuleForOrder($item, $whId, $chId, $uid, 0);
			if (false === $promotion)
			{
				return false;
			}
			$product_base_info[$pid]['show_price'] = $promotion['item']['priceAfterFavor'];
			$product_base_info[$pid]['is_restrict'] = $promotion['item']['is_restrict'];
			$product_base_info[$pid]['restrict'] = $promotion['restrict'];
			$multprice = array();
			$multprice['priceBeforeFavor'] = $promotion['item']['priceBeforeFavor'];
			$multprice['priceAfterFavor'] = $promotion['item']['priceAfterFavor'];
			$multprice['priceDiscount'] = $promotion['item']['priceDiscount'];
			$multprice['priceOpType'] = $promotion['item']['priceOpType'];
			$multprice['unitPriceOpNum'] = $promotion['item']['unitPriceOpNum'];
			$multprice['priceSceneId'] = $promotion['item']['priceSceneId'];
			$multprice['priceSourceId'] = $promotion['item']['priceSourceId'];
			$product_base_info[$pid]['multprice'] = $multprice;
		}
		Logger::info("_setMultPriceInfo finish. whId:".$whId." chId:".$chId." uid:".$uid);
		return $product_base_info;
	}
	//扣减规则生效次数
	private function _dealPromotionRestrict($restricts, $uid,&$isRestrict)
	{
		$isRestrict = 0;
		if (!is_array($restricts) || count($restricts) == 0 ) {
			exd_Attr_API2(635066, 1);
			return false;
		}
		$strRestrict = ToolUtil::gbJsonEncode($restricts);
		Logger::info("dealPromotionRestrict Start[restricts:{$strRestrict}][uid:{$uid}]");
		$uid = intval($uid);
		$restrictParamListIn = array();
		foreach($restricts as $restrict)
		{
			$restrictParam = array();
			$restrictParam['bussinessId'] = $restrict['bussinessId'];
			$restrictParam['edm1'] = $restrict['edm1'];
			$restrictParam['edm2'] = $restrict['edm2'];
			$restrictParam['edm3'] = $restrict['edm3'];
			$restrictParam['num'] =$restrict['num'];
			$restrictParam['dwDeductTime'] = $restrict['dwDeductTime'];
			$restrictParamListIn[] = $restrictParam;
		}
		$result = WebStubCntl2::request('icson\promotionrestrict\ao\promotionrestrict\GetDealBatchPromotionRestrict',
			array( 
				'opt'=>array(
					'uin' => $uid,//使用Mod+L5方式设置路由，一般填写用户QQ（对应setDwUin）
					'operator' => $uid,//操作者ID，一般填写用户QQ（对应setDwOperatorId）
					'caller' => 'customphone',//调用方名字，用于模调(对应setCallerName)
					'timeout' => 1,//超时时间，以秒为单位，特殊情况下可以调大
				),
				'req'=>array(
					'machineKey' => __FILE__,
					'source' => __FILE__,
					'sceneId' => 0,
					'uin' => $uid,
					'restrictParamListIn' => $restrictParamListIn
				)
			)
		);
		if ($result['code']!=0 || $result['data']['result']!=0)
		{
			if ($result['data']['result'] == 6952)
			{
				$isRestrict = 1;
			}
			//打印日志，告警
			exd_Attr_API2(635066, 1);
			Logger::err("GetDealBatchPromotionRestrict error, code:" . $result['code'] . " result:" . $result['data']['result'] . " msg:".$result['msg']);
			return false;
		}
		Logger::info("_dealPromotionRestrict SUCCESS.restrictParamListOut:".ToolUtil::gbJsonEncode($result['data']['restrictParamListOut'])." isRestrict:".$isRestrict." uid:".$uid);
		return $result['data']['restrictParamListOut'];
	}
	//回退规则生效次数
	private function _rollbackPromotionRestrict($restricts, $uid)
	{
		if (!is_array($restricts) || count($restricts) == 0 ) {
			exd_Attr_API2(635067, 1);
			return false;
		}
		$strRestrict = ToolUtil::gbJsonEncode($restricts);
		Logger::info("rollbackPromotionRestrict Start[restricts:{$restricts}][uid:{$uid}]");
		$uid = intval($uid);
		$restrictParamListIn = array();
		foreach($restricts as $restrict)
		{
			$restrictParam = array();
			$restrictParam['bussinessId'] = $restrict['bussinessId'];
			$restrictParam['edm1'] = $restrict['edm1'];
			$restrictParam['edm2'] = $restrict['edm2'];
			$restrictParam['edm3'] = $restrict['edm3'];
			$restrictParam['num'] =$restrict['num'];
			$restrictParam['dwDeductTime'] = $restrict['dwDeductTime'];
			$restrictParamListIn[] = $restrictParam;
		}
		$result = WebStubCntl2::request('icson\promotionrestrict\ao\promotionrestrict\RollbackDealBatchPromotionRestrict',
			array( 
				'opt'=>array(
					'uin' => $uid,//使用Mod+L5方式设置路由，一般填写用户QQ（对应setDwUin）
					'operator' => $uid,//操作者ID，一般填写用户QQ（对应setDwOperatorId）
					'caller' => 'customphone',//调用方名字，用于模调(对应setCallerName)
					'timeout' => 1,//超时时间，以秒为单位，特殊情况下可以调大
				),
				'req'=>array(
					'machineKey' => __FILE__,
					'source' => __FILE__,
					'sceneId' => 0,
					'uin' => $uid,
					'restrictParamListIn' => $restrictParamListIn
				)
			)
		);
		if ($result['code']!=0 || $result['data']['result']!=0)
		{
			//打印日志，告警
			exd_Attr_API2(635067, 1);
			Logger::err("RollbackDealBatchPromotionRestrict error, code:" . $result['code'] . " result:" . $result['data']['result'] . " msg:".$result['msg']);
			return false;
		}
		Logger::info("_rollbackPromotionRestrict SUCCESS.restrictParamListOut:".ToolUtil::gbJsonEncode($result['data']['restrictParamListOut'])." uid:".$uid);
		return $result['data']['restrictParamListOut'];
	}
	//批量扣减促销2.0生效次数
	private function _batchDealPromotionRestrict($product_base_info, $uid, &$isRestrict)
	{
		$arrLockPromotionRestrict = array();
		if (false === $product_base_info)
		{
			return $arrLockPromotionRestrict;
		}
		if (!is_array($product_base_info))
		{
			return $arrLockPromotionRestrict;
		}
		foreach($product_base_info as $product)
		{
			$restrict = $product['restrict'];
			if (!is_array($restrict) || count($restrict) == 0 ) {
				continue;
			}
			$lockRestrict = self::_dealPromotionRestrict($restrict, $uid,$isRestrict);
			if ($lockRestrict)
			{
				//记录需要回退的生效次数数组
				$arrLockPromotionRestrict[] = $lockRestrict;
			}
			else if ( false === $lockRestrict )
			{
				//打印错误日志
				Logger::err("_batchDealPromotionRestrict err restrict:".ToolUtil::gbJsonEncode($restrict)." uid:".$uid);
				return false;
			}
		}
		return $arrLockPromotionRestrict;
	}
	//批量回退促销2.0生效次数
	private function _batchRollbackPromotionRestrict($arrLockPromotionRestrict, $uid)
	{
		Logger::info("_batchRollbackPromotionRestrict start! arrLockPromotionRestrict:".ToolUtil::gbJsonEncode($arrLockPromotionRestrict)." uid:".$uid);
		foreach($arrLockPromotionRestrict as $lockRestrict)
		{
			$rollbackRestrict = self::_rollbackPromotionRestrict($lockRestrict, $uid);
			if (false === $rollbackRestrict)
			{
				//打印错误日志
				Logger::err("_rollbackPromotionRestrict error lockRestrict:".ToolUtil::gbJsonEncode($lockRestrict)." uid:".$uid);
			}
		}
		Logger::info("_batchRollbackPromotionRestrict finish! uid:".$uid);
		return ;
	}
	//接入促销2.0 E zaleli
	//接入统一库存 S zaleli
	//根据仓ID读OMS库存
	/*
	private function _getInventeoryInfoByStockId($productIdList,$stockId,$uid)
	{
		Logger::info("_getInventeoryInfoByStockId Start! productIdList:".ToolUtil::gbJsonEncode($productIdList)." stockId:".$stockId." uid:".$uid);
		if (!is_array($productIdList))
		{
			Logger::err("_getInventeoryInfoByStockId Err,productIdList:".ToolUtil::gbJsonEncode($productIdList)." stockId:".$stockId." uid:".$uid);
			return false;
		}
		$inventoryMulFilterAdminPo = array();
		$inventoryMulFilterAdminPo['productSysno'] = $productIdList;
		$inventoryMulFilterAdminPo['stockSysno'] = $stockId;
		$result = WebStubCntl2::request('oms\inventoryview\ao\MultiGetInventory',
			array( 
				'opt'=>array(
					'uin' => $uid,//使用Mod+L5方式设置路由，一般填写用户QQ（对应setDwUin）
					'operator' => $uid,//操作者ID，一般填写用户QQ（对应setDwOperatorId）
					'caller' => 'customphone',//调用方名字，用于模调(对应setCallerName)
					'timeout' => 1,//超时时间，以秒为单位，特殊情况下可以调大
				),
				'req'=>array(
					'machineKey' => 'customphone',
					'source' => __FILE__,
					'sceneId' => 0,
					'option' => 0,
					'inventoryMulFilterAdminPo' => $inventoryMulFilterAdminPo,
					'inLocalkey' => '',
					'inStrReserve' => ''
				)
			)
		);
		if ($result['code']!=0 || $result['data']['result']!=0)
		{
			//打印日志，告警
			Logger::err("MultiGetInventory Request Err,code:".$result['code']." errmsg:".$result['msg']." result:".$result['data']['result']);
			return false;
		}
		$inventeoryInfoList = array();
		foreach($productIdList as $productId)
		{
			if (isset($result['data']['inventoyRecordPo'][$productId]))
			{
				$inventeoryInfoList[$productId] = array();
				foreach($result['data']['inventoyRecordPo'][$productId] as $inventoyRecord)
				{
					$productInventoyRecord['productSysno'] = $inventoyRecord['productSysno'];
					$productInventoyRecord['stockSysno'] = $inventoyRecord['stockSysno'];
					$productInventoyRecord['platformSysno'] = $inventoyRecord['platformSysno'];
					$productInventoyRecord['availableQty'] = $inventoyRecord['wmsRecordPo']['availableQty'];
					$productInventoyRecord['virtualQty'] = $inventoyRecord['wmsRecordPo']['virtualQty'];
					$inventeoryInfoList[$productId][] = $productInventoyRecord;
				}
			}
		}
		Logger::info("_getInventeoryInfoByStockId Finish! inventeoryInfoList:".ToolUtil::gbJsonEncode($inventeoryInfoList)."uid:".$uid);
		return $inventeoryInfoList;
	}
	*/
	//接入统一库存 E zaleli
	/* 	
		@desc 根据运营商列表获得他们的归属地，去除重复的，用于当用户选择的选项
		@param splist :  运营商列表
		@param  : 
		@param  Locations : array()
	*/
	public static function getLocations(&$splist, &$locations)
	{
		$locations = array("上海" => array("上海"));
		return true;
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			$msg = "getLocations Error, line".ToolUtil::$errMsg."\n";
			// echo ($msg);
			return false;
		}
		
		$condition = " where ";
		foreach($splist as $sp)
		{
			
		}
		
		$sql = "select * from t_cp_service_provider";
		$spinfo = self::_select_s($mysql, $sql,__LINE__);
		if($spinfo === false)
			return false;
			
		$locations = array();
		foreach($spinfo as $it)
		{
			if( !array_key_exists($it['province'],$locations) )
			{
				$locations[$it['province']] = array();
				$locations[$it['province']][] = $it['city'];
			}
			else
			{
				if( !in_array($it['city'],$locations[$it['province']]) )
					$locations[$it['province']][] = $it['city'];
			}
		}
	
		return true;
	}		
	
	/* 	
		@desc 按运营商和号段获得号码列表
		@param  seg : 号段 
		@param  numlist:  返回的号码列表
		@param  sp: 运营商id
	*/
	public static function getSegs($sp_id, $c_id, $card_id, &$seglist)
	{
		if( false === self::_getDB_s("cp_information",$mysql,__LINE__ ) )
		{
			exd_Attr_API2(634515, 1);
			return false;
		}
			
		global $_CP_Num_Status;
                $sql = "";
                if(0 === $card_id)
                {
                    $sql = "select * from t_cp_num where sp_id=".$sp_id." and location_cid =" . $c_id . " and status=".$_CP_Num_Status['Normal'] . " and card_id=$card_id";
                }
                else
                {
                    $sql = "select * from t_cp_num where sp_id=".$sp_id." and location_cid =" . $c_id . " and status=".$_CP_Num_Status['Normal'] . " and card_id=$card_id";
                }
		$ret = self::_select_s($mysql,$sql,__LINE__);
		if($ret === false)
		{
			exd_Attr_API2(634515, 1);
			return false;
		}
		
		foreach($ret as $it)
		{
			if( !in_array($it['num_seg'],$seglist) )
			{
				$seglist[$it['num_seg']] = $it['num_seg'];
			}			
		}
		
		return true;
	}
	
	/* 	
		@desc 按运营商和号段获得号码列表
		@param  seg : 号段 
		@param  numlist:  返回的号码列表
		@param  sp: 运营商id
	*/
	public static function getNums(&$numlist, $condition="")
	{
		if ( $condition != "" )
			$condition = " where ".$condition;
			
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
        	exd_Attr_API2(634515, 1);
			$msg = "getLocations Error, line".ToolUtil::$errMsg."\n";
			// echo ($msg);
			return false;
		}
		
		$sql = "select * from t_cp_num".$condition;
		
		$numinfo = self::_select_s($mysql, $sql,__LINE__);
		if($numinfo === false)
		{
			exd_Attr_API2(634515, 1);
			return false;
		}

		foreach($numinfo as $it)
		{
			$numlist[] = array('num' => $it['num'], 'card_id' => $it['card_id']);
		}
		return true;		
	}
	
	/* 	
		@desc 按运营商和号段获得号码列表
		@param  seg : 号段 
		@param  numlist:  返回的号码列表
		@param  sp: 运营商id
	*/
	public static function getNum($num, $cid)
	{
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			return false;
		}
		
		$sql = "select * from t_cp_num where num=".$num." and card_id=$cid";
		
		$numinfo = self::_select_s($mysql, $sql,__LINE__);
		if($numinfo === false || count($numinfo) == 0)
			return false;
		
		return $numinfo[0];	
	}
	
	/* 	
		@desc 按运营商和号段获得号码列表
		@param  seg : 号段 
		@param  numlist:  返回的号码列表
		@param  sp: 运营商id
	*/
	public static function getNum_single($num)
	{
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			return false;
		}
		
		$sql = "select * from t_cp_num where num=".$num;
		
		$numinfo = self::_select_s($mysql, $sql,__LINE__);
		if($numinfo === false || count($numinfo) == 0)
			return false;
		
		return $numinfo[0];	
	}
	
	/* 	
		@desc 解锁号码
	*/
	public static function unlockNum($num)
	{
		// 把锁定(Locked)的号码设置为正常状态(Normal)
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			exd_Attr_API2(634516, 1);
			self::$errMsg = "_getDB_s Error, line".$mysql->errMsg."\n";
			return false;
		}
		global $_CP_Num_Status;
		$now = time();
		$data = array( 
			'status' => $_CP_Num_Status['Normal'], 
			'contractkey' => '',
			'updatetime' => $now 
		);
		$condition = "num=".$num." and status=".$_CP_Num_Status['Locked'];
		if(false === self::_update_s("t_cp_num",$mysql, $data, $condition,__LINE__))
		{	
			exd_Attr_API2(634516, 1);
			self::$errMsg = $mysql->errMsg;
			return false;
		}
		return true;
	}
	
	/* 	
		@desc 归还号码
	*/
	public static function returnNum($num)
	{
		// 把不可卖(NA)的号码设置为正常状态(Normal)
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			self::$errMsg = "_getDB_s Error, line".$mysql->errMsg."\n";
			return false;
		}
		global $_CP_Num_Status;
		$now = time();
		$data = array( 
			'status' => $_CP_Num_Status['Normal'], 
			'contractkey' => '',
			'updatetime' => $now 
		);
		$condition = "num=".$num." and status=".$_CP_Num_Status['NA'];
		if(false === self::_update_s("t_cp_num",$mysql, $data, $condition, __LINE__))
		{	
			self::$errMsg = $mysql->errMsg;
			return false;
		}
		return true;
	}
	
		
	/* 	
		@desc 锁定号码		
		@param newNum : 要锁定的新号码	
		@param oldNum : 要解锁的老号码
	*/
	public static function lockNum($newNum,$oldNum = -1)
	{
		// 老号码和新号码相同直接跳过
		if( $oldNum == $newNum )
		{
			return true;
		}
		
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			exd_Attr_API2(634516, 1);
			self::$errMsg = "unlockNum Error, line".ToolUtil::$errMsg."\n";
			return false;
		}
		
		if( false === $mysql -> execSql("begin"))
		{
			exd_Attr_API2(634516, 1);
			self::$errMsg = ToolUtil::$errMsg;
			self::_transaction( $mysql, "rollback", __LINE__ );
			return false;
		}		
		
		global $_CP_Num_Status;	
		
		// 锁定之前先检查新号码的状态，是否已经先被别人锁定
		$sql = "select * from t_cp_num where num=".$newNum." and status=".$_CP_Num_Status['Normal'] ;
		$numInfo = self::_select_s($mysql, $sql, __LINE__);
		if($numInfo === false)
		{
			exd_Attr_API2(634515, 1);
			self::$errMsg = ToolUtil::$errMsg;
			return false;
		}
		
		if( count($numInfo) == 0 )
		{
			self::$errMsg = "新号码已经被锁定或被购买";
			return false;
		}
		
		$now = time();
		// 锁定新号码
		$data = array( 	
			'status' => $_CP_Num_Status['Locked'], 
			'contractkey' => $_COOKIE['contract_key'],
			'updatetime' => $now  
		);
		$condition = "num=".$newNum." and status=".$_CP_Num_Status['Normal'];
		if(false === self::_update_s("t_cp_num",$mysql, $data, $condition,__LINE__))
		{	
			exd_Attr_API2(634516, 1);
			self::$errMsg = ToolUtil::$errMsg;
			self::_transaction( $mysql, "rollback", __LINE__ );
			return false;
		}
		
		// 如果update操作没有影响任何一行，返回错误
		if( 0 == $mysql->getAffectedRows() )
		{
			exd_Attr_API2(634516, 1);
			self::$errMsg = "新号码已经被锁定或被购买";
			self::_transaction( $mysql, "rollback", __LINE__ );
			return false;
		}
		
		
		// 解锁老号码
		$data = array( 
			'status' => $_CP_Num_Status['Normal'], 
			'contractkey' => '',
			'updatetime' => $now 
		);
		$condition = "num=".$oldNum." and status=".$_CP_Num_Status['Locked'];
		//$condition = "num=".$oldNum;
		if(false === self::_update_s("t_cp_num",$mysql, $data, $condition,__LINE__))
		{
			exd_Attr_API2(634516, 1);
			self::$errMsg = ToolUtil::$errMsg;
			self::_transaction( $mysql, "rollback", __LINE__ );
			return false;
		}

		
		
		self::_transaction( $mysql, "commit", __LINE__ );		
		return true;
	}	
	
	/* 	
		@desc 获得套餐信息
		@param  : 
		@param  : 
		@param  : 
	*/
	public static function getPackage(&$packageinfo,$package_id=-1)
	{
		
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			$msg = "getLocations Error, line".ToolUtil::$errMsg."\n";
			// echo ($msg);
			return false;
		}
		if( $package_id == -1)
			$sql = "select * from t_cp_package";
		else	
			$sql = "select * from t_cp_package where package_id=".$package_id;

		$sql .= " order by monthly_fee,package_name";
		
		$ret = self::_select_s($mysql, $sql, __LINE__);
		if($ret === false)
		{
			self::$errMsg = ToolUtil::$errMsg;
			return false;
		}
		$packageinfo = array();
		foreach($ret as $pack)
		{
			$packageinfo[$pack['package_id']] = $pack;
		}

		return true;
	}


	/* 	
		@desc 获得资费信息
		@param  : 
		@param  : 
		@param  : 
	*/
	public static function getFee(&$feeinfo,$product_id,$service_type,$package_id=-1)
	{
		
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			$msg = "getLocations Error, line".ToolUtil::$errMsg."\n";
			return false;
		}
		if( $package_id == -1)
			$sql = "select * from t_cp_package where product_id=$product_id and service_type=$service_type";
		else	
			$sql = "select * from t_cp_package where product_id=$product_id and service_type=$service_type and package_id=".$package_id;

		$packageinfo = self::_select_s($mysql, $sql, __LINE__);
		if($packageinfo === false)
			return false;
		return true;
	}		
	
	public static function getSpIdByProduct($pid)
	{
		// 先根据商品获得返利资费，一个商品只支持一个运营商，借此来知道该商品是联通还是电信定制机
		$ret = self::_getDB_s("cp_information",$mysql,__LINE__);
		if( false === $ret )
		{
			self::$errMsg = "getSpIdByProduct Error, line".$mysql->errMsg;
			return false;
		}
		
		$sql = "select 
				t_cp_package.package_id, 
				t_cp_package.package_name, 
				t_cp_package.sp_id,
				t_cp_fee.product_id 
			from t_cp_package,t_cp_fee 
			where t_cp_package.package_id=t_cp_fee.package_id
			and t_cp_fee.product_id=".$pid;
		//Logger::err( $sql);
		$feeinfo = self::_select_s($mysql, $sql, __LINE__);
		if($feeinfo === false)
		{
			return false;
		}
		
		if( count($feeinfo) == 0)
		{
			self::$errMsg = "该商品没有套餐和返利资费";
			return false;
		}
			
		// 返回所有支持的运营商
		$sp_ids = array();
	
		foreach($feeinfo as $it)
		{
			// 如果不存在，则加入
			if( !in_array( $it['sp_id'], $sp_ids ))
			{
				$sp_ids[] = $it['sp_id'];
			}
		}
		
		return $sp_ids;
	}
	
	public static function checkReceiverAddr($addr, $wh_id)
	{	
		return true;
	}
	
	public static function getUrl($pid,$step,$chid=0)
	{
		if( $pid == 0 )
			return "http://buy.51buy.com/".$step.".html";
		return "http://buy.51buy.com/".$step."-".$pid.".html?chid=" . $chid;
	}
	
	public static function checkShippingType($shiptype, $wh_id)
	{
		if (($wh_id == 1 && $shiptype == 1) || 
			($wh_id == 1001 && $shiptype == 22) ||
			($wh_id == 2001 && $shiptype == 44) ||
			($wh_id == 30011 && $shiptype == 1) ) {
			return true;
		}
		return array('errCode'=>10, 'errMsg'=>"您选择的商品只支持使用易迅快递，请重新选择！");
	}
	
	public static function checkInvoice(&$newOrder)
	{
		$newOrder['isVat'] = isset($newOrder['isVat']) ? $newOrder['isVat'] : 1;
		if(0 == $newOrder['isVat']) //如果不需要开发票，则不用验证发票
		{
			return true;
		}
		
		//Logger::err(var_export($newOrder,true));
		if (!isset($newOrder['invoiceType']) ||
		   ($newOrder['invoiceType'] != INVOICE_TYPE_RETAIL_COMPANY &&
		    $newOrder['invoiceType'] != INVOICE_TYPE_RETAIL_PERSONAL &&
		    $newOrder['invoiceType'] != INVOICE_TYPE_VAT &&
		   	$newOrder['invoiceType'] != INVOICE_TYPE_VAT_NORMAL &&
		   	$newOrder['invoiceType'] != INVOICE_TYPE_CP_UNICOM &&
		   	$newOrder['invoiceType'] != INVOICE_TYPE_CP_TELCOM &&
		   	$newOrder['invoiceType'] != INVOICE_TYPE_CP_MOBILE )) {
			self::$errCode = -2009;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceType is invalid";
			return false;
		}
		//Logger::err("invoiceType");
		if (!isset($newOrder['invoiceTitle']) || $newOrder['invoiceTitle'] == '' || strlen($newOrder['invoiceTitle']) > MAX_TITLE_LEN) {
			self::$errCode = -2010;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoice invoiceTitle is invalid";
			return false;
		}
		//Logger::err("invoiceTitle");
		if (!isset($newOrder['invoiceId']) || $newOrder['invoiceId'] <= 0 ) {
			self::$errCode = -2017;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " invoiceId is invalid";
			return false;
		}
		//Logger::err("invoiceId");
		//商业零售发票
		if ($newOrder['invoiceType'] == INVOICE_TYPE_VAT) {
			if (!isset($newOrder['invoiceCompanyName']) || $newOrder['invoiceCompanyName'] == '' || strlen($newOrder['invoiceCompanyName']) > MAX_COMPANY_LEN) {
				self::$errCode = -2011;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyName  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceCompanyAddr']) || $newOrder['invoiceCompanyAddr'] == '' || strlen($newOrder['invoiceCompanyAddr']) > MAX_ADDR_LEN) {
				self::$errCode = -2012;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyAddr  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceCompanyTel']) || $newOrder['invoiceCompanyTel'] == '' || strlen($newOrder['invoiceCompanyTel']) > MAX_PHONE_LEN) {
				self::$errCode = -2013;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceCompanyTel  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceTaxno']) || $newOrder['invoiceTaxno'] == '' || strlen($newOrder['invoiceTaxno']) > MAX_TAXNO_LEN) {
				self::$errCode = -2014;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceTaxno  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceBankNo']) || $newOrder['invoiceBankNo'] == '' || strlen($newOrder['invoiceBankNo']) > MAX_BANK_NO_LEN) {
				self::$errCode = -2015;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankNo  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceBankName']) || $newOrder['invoiceBankName'] == '' || strlen($newOrder['invoiceBankName']) > MAX_BANK_NAME_LEN) {
				self::$errCode = -2016;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "invoiceBankName  is invalid";
				return false;
			}
			if (!isset($newOrder['invoiceContent'])) {
				$newOrder['invoiceNote'] = '';
			}
		}		
		//Logger::err("return true");
		return true;
	}
	/* 	
		@desc 用户下单购买定制机
		@param  : 
		@param  : 
		@param  : 
	*/
	public static function order(&$newOrder, $wh_id, $checkAddr = true,$chid = 0)
	{
		//参数收货地址
		if ($checkAddr && false === ICustomPhone::checkReceiverAddr($newOrder['receiveAddrId'], $wh_id))
		{
			return array('errCode' => 100, 'errMsg' => "收获地址不正确");
		}
		//Logger::err("检查地址");	
		//检查运送方式
		if (false === ICustomPhone::checkShippingType($newOrder['shipType'], $wh_id)) 
		{
			self::$errCode = IOrder::$errCode;
			self::$errMsg = IOrder::$errMsg;
			return array('errCode' => 101, 'errMsg' => "配送方式不正确");
		}
		//Logger::err("检查运送方式");
		//检查支付方式
		if (false === IOrder::checkPayType($newOrder, $wh_id)) 
		{
			self::$errCode = IOrder::$errCode;
			self::$errMsg = IOrder::$errMsg;
			return array('errCode' => 102, 'errMsg' => "支付方式不正确");
		}
		//Logger::err("检查发票");
		//检查发票
		if (false === ICustomPhone::checkInvoice($newOrder)) 
		{
			self::$errCode = ICustomPhone::$errCode;
			self::$errMsg = ICustomPhone::$errMsg;
			return array('errCode' => 103, 'errMsg' => "发票内容不正确");
		}
		//Logger::err("检查合约内容");
		return self::_checkcontract($newOrder, $wh_id,$chid);
	}
	
	public static function _check_ttc_data_integrity(&$ttc_contract_info)
	{
		return true;
	}
	
	/*
		$newOrder = array(
		'uid' => 1244446,
		'payType' => 1,
		'aid' =>42365374,
		'comment' => '空的',
		'invoiceBankName' => '',
		'invoiceBankNo' => '',
		'invoiceCompanyAddr' => '',
		'invoiceCompanyName' => '',
		'invoiceCompanyTel' => '',
		'invoiceContent' => '商品明细',
		'invoiceId' =>	271792,
		'invoiceTaxno' => '',
		'invoiceTitle' => '个人',
		'invoiceType' =>	1,
		'receiveAddrDetail' =>"上海宝山",
		'receiveAddrId'	=> 3333,
		'receiver' => '姚兵',
		'receiverMobile' =>'13689564785',
		'receiverTel' =>'',
		'shippingPrice' =>	0,
		'shipType'=>1,
		'sign_by_other'=>1,
		'zipCode' =>'',
		'visitkey' => '2011test',
		'ls' => '',
		'edm' => '',
		'product_id' => 1111,   //手机商品id
		'gift'=>array(158777,38925,173807), //手机商品的赠品ids
		'num' => xxxx, //用户所选号码		
		'Price' =>	619900,
		
		//其他合约信息
	);
	*/
	
	private function _checkcontract(&$newOrder, $wh_id = 1,$chid = 0)
	{
	    global $_PAY_MODE, $_CP_Item_Id ,$UNPSellerAccount51Buy_E ,$UNPDealItemType_E ,$UNPDealBusiness_E ,$UNPDealRecvMask_E;
		if (!isset($newOrder['contract_key']) ) {
			//return array('errno'=>-1, 'errMsg'=>"vkey Error");
			return false;
		}
		$ttc_contract_info = ICpContractTTC::get($newOrder['contract_key']);
		if( false === $ttc_contract_info )
		{
			exd_Attr_API2(634514, 1);
			//return array('errno' => -1, 'errMsg' => 'ttc query failed in order');
			return false;
		}		
		
		$ttc_contract_info = $ttc_contract_info[0];
		if( false === self::_check_ttc_data_integrity($ttc_contract_info) )
		{
			return false;
		}
		
		$sp_id = $ttc_contract_info['sp_id'];
		$CardID = $ttc_contract_info['card_id'];
		
		if (isset($newOrder['comment']) && strlen($newOrder['comment']) > 800) {
			return array('errCode'=>11, 'errMsg'=>"您填写的订单备注过长，请返回修改！");
		}	
		
		$uid = $newOrder['uid'];
		
		$userInfo = IUser::getUserInfo($uid);
		if ($userInfo === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = "获取用户信息错误";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:获取用户信息错误：" . IUser::$errMsg;
			return false;
		}
		global $_USER_TYPE;
		if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			return array('errCode'=> 15, 'errMsg'=> "您属于分销用户，不能使用优惠券。");
		}
		//优惠券检测
		if( !isset( $_COOKIE['contract_key'] )  || FALSE === strpos($_COOKIE['contract_key'], '-')) {//用户手动清除或者cookie格式不对
			self::$errCode = 1;
			self::$errMsg = '临时合约信息cookie获取失败';
			return array('errCode' => 2, 'errMsg' => '无法获取合约信息');
		}
		$cpInfo = array('contract_key' => $_COOKIE['contract_key']);
		$couponInfo = array('amt'=> 0, 'code'=> '', 'type'=> 0);
		if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") {
			$couponInfo = ICoupon::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'], $wh_id, 0, $cpInfo);
			if (false === $couponInfo) {
				exd_Attr_API2(634521, 1);
				self::$errCode = ICoupon::$errCode;
				self::$errMsg = ICoupon::$errMsg;
				return array('errCode' => '16', 'errMsg' => '优惠券无法使用');
			}
			
		    //接入统一订单 add by donadzhang start
			$coupon  = ICouponTTC::get($newOrder['couponCode']);
			if (false === $coupon) 
			{
				$coupon  = array('coupon_id'=> 0, 'coupon_name'=> '');
				Logger::info("ICouponTTC::get error! code : " .ICouponTTC::$errCode .", errMsg : ".ICouponTTC::$errMsg);
			}
			else
			{
				if(count($coupon) == 0)
				{
					$coupon  = array('coupon_id'=> 0, 'coupon_name'=> '');
					Logger::info("There is no this coupon,coupon_code :" . $newOrder['couponCode']);
				}
				else
				{
					$coupon = $coupon[0];
					$coupon['coupon_name'] = iconv('GBK', 'UTF-8', $coupon['coupon_name']);
				}
			}
			//接入统一订单 add by donadzhang end
		}
		
		// 主商品加赠品
		$productids = array();
		// 纯赠品
		$orderGifts = array();
		if($newOrder['gift'] != "")
		{
			$productids = explode(",",$newOrder['gift']);
			$orderGifts = explode(",",$newOrder['gift']);
		}
		// 
		if( $newOrder['product_id'] != $CardID )
		{
			//记录手机
			array_push($productids, $newOrder['product_id']);
			$shoppingProduct[$newOrder['product_id']]['buy_num'] = 1; //记录每个商品的购买数量
			$shoppingProduct[$newOrder['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
			$shoppingProduct[$newOrder['product_id']]['product_id'] = $newOrder['product_id'];
		
			//拉取合约手机的赠品信息
			/*
			$gifts = IGiftNewTTC::get($newOrder['product_id'], array('status'=> GIFT_STATUS_OK,'wh_id'=>$wh_id));
			if (false === $gifts) {
				self::$errCode = IGiftNewTTC::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IGiftNewTTC failed]' . IGiftNewTTC::$errMsg;
				return false;
			}
			*/
			$baseInfo = IProduct::getBaseInfo($newOrder['product_id'], $wh_id, true);
			if (false === $baseInfo) {
				exd_Attr_API2(634513, 1);
				self::$errCode = IProduct::$errCode;
				self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
				return false;
			}
			
			if( ($baseInfo['flag'] & CP_YCHF ) == CP_YCHF )
			{
				$service_type = 1;
			}
			else if( ($baseInfo['flag'] & CP_GJRW ) == CP_GJRW )
			{
				$service_type = 2;
			}
			else
			{
				// 一般不执行
				$service_type = 0;
			}
		}
		else
		{
			$service_type = 4;
		}
		
		
		if($service_type == 0)
		{
			Logger::err("购买方式出错");
			return array('errCode' => 17, 'errMsg' => '购买方式不正确');
		}
		
		//记录sim卡
		array_push($productids, $CardID);
		$shoppingProduct[$CardID]['buy_num'] = 1; //记录每个商品的购买数量
		$shoppingProduct[$CardID]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
		$shoppingProduct[$CardID]['product_id'] = $CardID;
		
		Logger::info("检查备注");
		//检查商品状态信息是否合法
		$product_base_info = IProduct::getProductsInfo($productids, $wh_id, true, true);
		//接入促销2.0 S zaleli
		$ch_id = isset($newOrder['chid']) ? intval($newOrder['chid']) : 0;
		$product_base_info = self::_setMultPriceInfo($product_base_info,$wh_id,$ch_id,$uid,$newOrder['product_id']);
		//如果被限购返回下单失败
		foreach($product_base_info as $product)
		{
			if (isset($product['is_restrict']) && ($product['is_restrict'] == 1))
			{
				$url = "";
				//限购提示
				if ($wh_id == 1)
				{
					$url = "http://event.51buy.com/event/80868722.html";
				}
				else if ($wh_id == 1001)
				{
					$url = "http://event.51buy.com/event/80316703.html";
				}
				else
				{
					$url = "http://search.51buy.com/1781--------.html";
				}
				Logger::err("price limit buy. product_base_info:".ToolUtil::gbJsonEncode($product_base_info)." wh_id:".$wh_id." ch_id:".$ch_id." uid:".$uid);			
				return array('errCode'=>6952, 'errMsg'=>"抱歉，下单失败。享受此活动价的商品已售完！即将为您跳转到更多优惠合约机", 'url'=>$url);
			}
		}
		//批量扣减生效次数
		$isRestrict = 0;
		$arrLockPromotionRestrict = self::_batchDealPromotionRestrict($product_base_info, $uid,$isRestrict);
		if (false ===  $arrLockPromotionRestrict)
		{
			$url = "";
			//限购提示
			if ($wh_id == 1)
			{
				$url = "http://event.51buy.com/event/80868722.html";
			}
			else if ($wh_id == 1001)
			{
				$url = "http://event.51buy.com/event/80316703.html";
			}
			else
			{
				$url = "http://search.51buy.com/1781--------.html";
			}
			Logger::err("_batchDealPromotionRestrict err. isRestrict:".$isRestrict." uid:".$uid);
			if ($isRestrict == 1)
			{
				return array('errCode'=>6952, 'errMsg'=>"抱歉，下单失败。享受此活动价的商品已售完！即将为您跳转到更多优惠合约机", 'url'=>$url);
			}
			else
			{
				return array('errCode'=>6952, 'errMsg'=>"抱歉，下单失败。即将为您跳转到更多优惠合约机", 'url'=>$url);
			}
		}
		//接入促销2.0 E zaleli
		if (false === $product_base_info) {
			exd_Attr_API2(634513, 1);
			self::$errCode = IProduct::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
			return false;
		}	
		
		// 获取套餐摘要
		if($service_type == 4)
			$packageInfo = self::getPackageOneFee(0, $newOrder['package_id'], $wh_id);
		else
			$packageInfo = self::getPackageOneFee($newOrder['product_id'], $newOrder['package_id'], $wh_id);
        if(FALSE === $packageInfo)
    	{
    	    Logger::err("getPackageOneFee error");	
            return false;
    	}
    	//获取手机套餐名
    	$phonePackageInfo = array();
    	$ret = self::getPackage($phonePackageInfo, $packageInfo['package_id']);
    	if (!$phonePackageInfo) {
             Logger::err("getPackage error");	
    	    return false;
    	}
    	$phonePackageInfo = current($phonePackageInfo);
		$packBrief = $phonePackageInfo['package_name']; 	

		Logger::info(var_export($productids,true));
		foreach ($productids as $pid)
		{
			$exist = false;
			if ($pid == $newOrder['product_id'] && $service_type != 4) 
			{  
				//手机本身				
				if (!isset($product_base_info[$pid]) || $product_base_info[$pid]['status'] != PRODUCT_STATUS_NORMAL) {
					Logger::err("定制机" . $product_base_info[$pid]['name'] . "暂不销售");
					return  array('errCode'=>-1, 'errMsg'=>"商品" . $product_base_info[$pid]['name'] . "暂不销售");
				}
			}
			else if ( $CardID == $pid)
			{
				// SIM卡
				if (!isset($product_base_info[$pid])) {
					Logger::err("SIM卡{$pid}" . $product_base_info[$pid]['name'] . "暂不销售");
					return  array('errCode'=>-1, 'errMsg'=>"商品{$pid}" . $product_base_info[$pid]['name'] . "暂不销售");
				}
				// 需要修改卡的价格，选号入网和购机入网的价格为预存话费的价格
				//选号入网的sim卡价格，等于$packageInfo['order_fee']
				if (4 == $service_type) {
					$card_price = 0;
					$package_price = $product_base_info[$pid]['show_price'];
				}
				//购机入网的sim卡价格，等$packageInfo['predeposit_fee']
				else if (2 == $service_type) {
				    if (!isset($packageInfo['predeposit_fee'])) {
				        Logger::err("SIM卡{$pid}" . $product_base_info[$pid]['name'] . "购机入网 价格获取失败");
					    return  array('errCode'=>-1, 'errMsg'=>"商品{$pid}" . $product_base_info[$pid]['name'] . "暂不销售");
				    }
                                    Logger::info('predeposit_fee : '.$packageInfo['predeposit_fee']);
				    $product_base_info[$pid]['show_price'] = $packageInfo['predeposit_fee'] * 100;
					$card_price = 0;
					$package_price = $packageInfo['predeposit_fee'] * 100;
				}
				else
				{
					// 预存
					$product_base_info[$pid]['show_price'] = 0;
					$card_price = 0;
					$package_price = 0;					
				}			
			}
			else //赠品
			{
				//Logger::err("赠品");
				if (!isset($product_base_info[$pid]) || $product_base_info[$pid]['status'] == PRODUCT_STATUS_NORMAL) {
					Logger::err("赠品" . $product_base_info[$pid]['name'] . "暂不销售");
					return  array('errCode'=>-1, 'errMsg'=>"赠品" . $product_base_info[$pid]['name'] . "信息已经变化，请刷新页面");
				}
				$product_base_info[$pid]['show_price'] = 0;				
				
				$shoppingProduct[$pid]['buy_num'] = 1;
				$shoppingProduct[$pid]['product_id'] = $pid;
				if ($product_base_info[$pid]['type'] == 1) {
					$shoppingProduct[$pid]['type'] = SHOPPING_CART_PRODUCT_TYPE_ZUJIAN;
				}
				else 
				{
					$shoppingProduct[$pid]['type'] = SHOPPING_CART_PRODUCT_TYPE_GIFT;
				}				
			}
		}
		
		Logger::info("检查商品状态信息是否合法");			
	
		//开始检查库存
		$msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
		if (false === $msSQL) {
			exd_Attr_API2(634522, 1);
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . ToolUtil::$errMsg;
			return false;
		}		
		if($service_type == 4)
		{
			// 选号入网，$newOrder['product_id']是0，分仓用卡的
			$psyStock = $product_base_info[$CardID]['psystock'];//$psyStock = 1;			
		}
		else
		{
			// 预存 或 购机，$newOrder['product_id']为手机id，分仓用手机
			$psyStock = $product_base_info[$newOrder['product_id']]['psystock'];
		}
		//$sql = "select SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productids) . ")";
		$sql = "select SysNo, ProductSysNo, StockSysNo, AvailableQty, VirtualQty, OrderQty from Inventory_Stock where ProductSysNo in (" . implode(",", $productids) . ") and StockSysNo=$psyStock";
		$productStocks = $msSQL->getRows($sql);
		if (false === $productStocks) {
			exd_Attr_API2(634522, 1);
			self::$errCode = $msSQL->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . $msSQL->errMsg;
			return false;
		}
		Logger::info("检查库存SQL语句：".$sql);	
		//接入统一库存 S zaleli
		global $_UIN_READ_INVENTORY_4_CUSTOMPHONE;
		if ($_UIN_READ_INVENTORY_4_CUSTOMPHONE['flag'] == true)
		{
			/*
			$inventeoryInfoList = self::_getInventeoryInfoByStockId($productids,$psyStock,$uid);
			if (false === $inventeoryInfoList)
			{
				Logger::err("_getInventeoryInfoByStockId err");
			}
			$inventeoryProductStocks =  array();
			foreach ($productStocks as $pstock)
			{
				if (isset($inventeoryInfoList[$pstock['ProductSysNo']]))
				{
					foreach($inventeoryInfoList[$pstock['ProductSysNo']] as $productInventoyRecord)
					{
						$pstock['AvailableQty'] = $productInventoyRecord['availableQty'];
						$pstock['VirtualQty'] = $productInventoyRecord['virtualQty'];
						$inventeoryProductStocks[] = $pstock;
					}
				}
			}
			$productStocks = $inventeoryProductStocks;
			*/
		}
		//接入统一库存 E zaleli
		$giftLackOfStock = array();
		$lackGiftAndIgnore = false;
		foreach ($shoppingProduct as $pid => $sp)
		{
			$exist = false;
			foreach ($productStocks as $pstock)
			{
				if ($sp['product_id'] == $pstock['ProductSysNo']) {
					$exist = true;
					if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT)  //赠品
					{
						if ($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_num']) {
							$ret = IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
							if( false === $ret )
							{
								exd_Attr_API2(634522, 1);
								Logger::err("IInventoryStockTTC::update failed, errMsg:".IInventoryStockTTC::$errMsg);
							}
							if (!isset($newOrder['ingoreLackOfGift'])) {   //如果第一次提交订单
								$giftLackOfStock[$sp['product_id']] = $pstock['AvailableQty']  + $pstock['VirtualQty'];
							}else if ($newOrder['ingoreLackOfGift'] == 1) {  //用户接受缺少礼品
								$shoppingProduct[$pid]['buy_num'] = $pstock['AvailableQty']  + $pstock['VirtualQty'];
								if ($shoppingProduct[$pid]['buy_num'] <= 0) {
									unset($shoppingProduct[$pid]);
								}
								$lackGiftAndIgnore = true;
							}else   //用户不接受，则拒绝下单
							{
								return  array('errCode'=>-13, 'errMsg'=>'赠品'.$product_base_info[$sp['product_id']]['name']."库存不足");
							}
						}
					}else if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
						if ($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_num']) {
							return  array('errCode'=>-15, 'errMsg'=>'组件'.$product_base_info[$sp['product_id']]['name']."库存不足,请联系客服");
						}
					}else//主商品
					{
						if (($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_num'])) {
								return  array('errCode'=>-15, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."库存不足");
						}
					}
					$shoppingProduct[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
					$shoppingProduct[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
					break;
				}
			}
			if (false === $exist) {
				return  array('errCode'=>-16, 'errMsg'=>'商品'.$product_base_info[$sp['product_id']]['name']."暂不销售".$sp['product_id']);
			}
		}
		Logger::info("giftLackOfStock");	
		if (count($giftLackOfStock) != 0) {
			$errMsg = "购物车中赠品:";
			foreach ($giftLackOfStock as $key=>$num)
			{
				$errMsg .= $product_base_info[$key]['name'] . "库存不足,";//仅剩下" . $num ."件,";
			}
			$errMsg .= "是否继续下单?";
			return array('errCode'=>-100, 'errMsg'=>$errMsg);
		}
		Logger::info("检查库存");
		// 添加提示
		if($lackGiftAndIgnore){
			$newOrder['comment'] .= "\n系统自动备注：用户已接受缺货赠品库存不足。";
		}
		//// 在订单库中写入合约机订单的信息
		
		// 获得应支付的现金		,  这里价格计算是不是有更复杂的需要考虑?
		$cash = 0;
		$orderPrice = 0;
		foreach($product_base_info as $it)
		{
			$cash += $it['show_price'];
			$orderPrice += $it['show_price'];
		}
		
		
		//校验价格
		
		if (bccomp($cash, $newOrder['Price'], 0) != 0) {
			self::$errCode = -2030;
			self::$errMsg="计算的订单价格与前台订单价格不一致.{$cash}, {$newOrder['Price']}";
			return array('errCode'=>-16, 'errMsg'=> self::$errMsg);
		}
		Logger::info("订单价格与前台订单一致:".$cash." == ".$newOrder['Price']);
		
		if ($couponInfo['amt'] > 0) {
			$cash -= $couponInfo['amt'];
		}
		//分摊优惠券到商品
		/*
		if ($couponInfo['amt'] > 0) {
			$cash -= $couponInfo['amt'];
			foreach ($couponInfo['subOrders'] as $subKey=> $so) {
				$remain = $so['coupon_amt'];
				foreach ($so['pids'] as $pid) {
					@$couponInfo['subOrders'][$subKey]['apport'][$pid] = 10 * bcdiv($so['coupon_amt'] * 1 * $product_base_info[$pid]['price'], 10 * $so['orderAmt'], 0);
					$remain -= $couponInfo['subOrders'][$subKey]['apport'][$pid];
				}
				if ($remain > 0) {
					$couponInfo['subOrders'][$subKey]['apport'][$pid] += $remain;
				}
			}
		}		
		*/
		// 生成订单号
		$newOrderId = IIdGenerator::getNewId('so_sequence', 1);
		if (false === $newOrderId || $newOrderId <= 0) {
			exd_Attr_API2(634523, 1);
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		Logger::info("生成订单号$newOrderId");
		//生成订单商品序列号, 手机卡作为一个特殊商品
		$itemStartID = IIdGenerator::getNewId('so_item_sequence', count($shoppingProduct));  
		if (false === $itemStartID || $itemStartID <= 0) {
			exd_Attr_API2(634523, 1);
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		Logger::info("生成订单商品序列号");
		//获取订单发票id
		//$invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence' ,$orderNum);
		$invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence' ,1);
		if (false === $invoice_id) {
			exd_Attr_API2(634523, 1);
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		Logger::info("获取订单发票id");
		// 获得订单数据库
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid,'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);			
		if (false === $orderDb) {
			exd_Attr_API2(634524, 1);
			self::$errCode = -2032 . "  " . $orderDb->errCode;
			self::$errMsg='开启ICSON_ORDER_CORE事务失败'  . $orderDb->errMsg;
			Logger::err(var_export($db_tab_index,true));
			Logger::err("getMSDBObj failed");
			return  false;
		}
                
                //add by donadzhang 接入统一订单   start
		$orderPoList = array("orderInfoList" => array());
		//add by donadzhang 接入统一订单   end
		
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			exd_Attr_API2(634524, 1);
			self::$errCode = -2032 . "  " . $orderDb->errCode;
			self::$errMsg='开启ICSON_ORDER_CORE事务失败'  . $orderDb->errMsg;
			Logger::err("orderDb begin transaction failed");
			return  false;
		}
		
		$ret = $msSQL->execSql($sql);
		if (false === $ret) {
			exd_Attr_API2(634524, 1);
			self::$errCode = -2032 . "  " . $msSQL->errCode;
			self::$errMsg='开启ICSON_ORDER_CORE事务失败'  . $msSQL->errMsg;
			Logger::err("msSQL begin transaction failed");
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql("rollback");
			return  false;
		}
		Logger::info("获得订单数据库");
		$now = time();

		$newOrderCharId = sprintf("%s%09d", "1", $newOrderId % 1000000000);
		// 生成订单信息
		global $_OrderState;
		
		$subIndex = $psyStock;
		
		$orderMain = array();
		$orderMain['order_char_id'] =$newOrderCharId;
		$orderMain['order_id'] = $newOrderId;
		$orderMain['status'] = $_OrderState['Origin']['value'];
		$orderMain['flag'] = ORDER_CP;
		$orderMain['uid'] = $newOrder['uid'];
		$orderMain['hw_id'] = $wh_id;
		$orderMain['order_date'] = $now;
		$orderMain['source'] = 0;
		$orderMain['type'] = 0;
		$orderMain['shipping_cost'] = $newOrder['shippingPrice'];
		$orderMain['premium_cost'] = 0;
		$orderMain['shipping_type'] = $newOrder['shipType'];
		$orderMain['pay_time'] = 0;
		$orderMain['pay_type'] = $newOrder['payType'];
		$orderMain['prcd_cost'] = 0;
		$orderMain['order_cost'] = $orderPrice + $newOrder['shippingPrice'];
		$orderMain['price_cut'] = 0;
		$orderMain['coupon_type'] = $couponInfo['type'];
		$orderMain['coupon_code'] = $couponInfo['code'];
		$orderMain['coupon_amt'] = $couponInfo['amt'];
		$orderMain['point'] = 0;
		$orderMain['point_pay'] = 0;
		$orderMain['cash'] = $cash;
		$orderMain['receiver'] = $newOrder['receiver'];
		$orderMain['receiver_tel'] = $newOrder['receiverTel'];
		$orderMain['receiver_mobile'] = $newOrder['receiverMobile'];
		$orderMain['receiver_zip'] = $newOrder['zipCode'];
		$orderMain['receiver_addr_id'] = $newOrder['receiveAddrId'];
		$orderMain['receiver_addr'] = $newOrder['receiveAddrDetail'];
		$orderMain['expect_dly_date'] = strtotime($newOrder['suborders'][$subIndex]["expectDate"]);
		$orderMain['expect_dly_time_span'] = $newOrder['suborders'][$subIndex]["expectSpan"];
		$orderMain['comment'] = $newOrder['comment'];
		$orderMain['update_time'] = $now;
		$orderMain['isPayed'] = 0;
		$orderMain['out_time'] = 0;
		$orderMain['sign_by_other'] = $newOrder['sign_by_other'];
		$orderMain['installment_bank'] = 0;
		$orderMain['installment_num'] = 0;
		$orderMain['cash_per_month'] = 0;
		$orderMain['rate'] = 0;
		$orderMain['back_rate'] = 0;
		$orderMain['cpsinfo'] = isset($newOrder['cpsinfo'])? $newOrder['cpsinfo'] : '';
		$orderMain['visitkey'] = $newOrder['visitkey'];
		$orderMain['ls'] = isset($newOrder['ls'])? $newOrder['ls'] : '';
		$orderMain['pOrderId'] = "";
		$orderMain['subOrderNum'] = 0;
		$orderMain['stockNo'] = $psyStock;
		$orderMain['synflag'] = 1;
		$orderMain['is_vat'] = $newOrder['isVat'];
		$orderMain['shop_guide_id'] = 0;
		$orderMain['shop_guide_name'] = '';
		$orderMain['shop_guide_cost'] = 0;
		$orderMain['shop_id'] = 0;
		@$orderMain['customer_ip'] = ToolUtil::getClientIP();
                Logger::info(var_export($orderMain,true));
                //add by donadzhang 接入统一订单   start
		$orderPo = array();
		$orderPo['dealId']           = '';//可为空
		$orderPo['dealId64']         = 0; //可为空
		$orderPo['bdealId']          = 0; //可为空
		$orderPo['businessDealId']   = $newOrderId;
		$orderPo['buyerAccount']     = '';
		$orderPo['buyerNickName']    = '';
		$orderPo['buyerNick']        = '';
		$orderPo['sellerId']         = $UNPSellerAccount51Buy_E['sellerId'];
		$orderPo['sellerTitle']      = iconv('GBK', 'UTF-8', $UNPSellerAccount51Buy_E['sellerTitle']);
		$orderPo['sellerNick']       = iconv('GBK', 'UTF-8', $UNPSellerAccount51Buy_E['sellerNick']);
		$orderPo['businessId']       = 2;
		$orderPo['dealType']         = 2;
		$orderPo['dealSource']       = 1;
		$orderPo['dealPayType']      = 0;//确认过，暂时不填写
		
		//在线支付和线下支付（邮局汇款vs银行电汇）初始状态为：UNP_DEAL_STATE_WAIT_PAY（未付款待审核）；
		$dealState = $UNPDealState_E['UNP_DEAL_STATE_WAIT_PAY'];
		//货到付款初始状态为：UNP_DEAL_STATE_WAIT_CHECK（待审核）；
	    //0元订单处理逻辑：初始状态UNP_DEAL_STATE_WAIT_CHECK（待审核）
		if ($orderPo['dealPayType'] === $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_COD'] || $cash === 0)
		{
			$dealState = $UNPDealState_E['UNP_DEAL_STATE_WAIT_CHECK'];
		}
		$orderPo['dealState']        = $dealState; 
		
		$orderPo['dealProperty']     = 0;
		$orderPo['dealProperty1']    = 0;
		$orderPo['dealProperty2']    = self::getDealProperty2(ORDER_CP,$newOrder['separateInvoice']);
		$orderPo['dealProperty3']    = 0;
		$orderPo['dealProperty4']    = 0;
		
		$orderPo['itemSkuidList']    = '';
		$orderPo['itemTitleList']    = '';
		
		//参考普通购物流程填写的，需要确认下是否正确
		$orderPo['dealTotalFee']     = $cash;
		$orderPo['dealPayment']      = $cash;     //目前没有运费，如果有运费需要重新设置
		$orderPo['dealDownPayment']  = 0;
		$orderPo['dealDiscountTotal'] = 0;  //合约机现在没有任何促销活动
		if(isset($couponInfo['amt']) && $couponInfo['amt'] > 0)
			$orderPo['dealDiscountTotal'] = $couponInfo['amt'];
		$orderPo['dealItemTotalFee']  = $cash;
		
		//谁支付邮费，1：卖家；2：买家
		$orderPo['dealWhoPayShippingFee']  = 2;
		$orderPo['dealShippingFee']        = $newOrder['shippingPrice'];
		
		//谁承担COD手续费，1：卖家承担；2：买家；3：平台承担
		$orderPo['dealWhoPayCodFee']       = 1;
		$orderPo['dealCodFee']             = 0;
		
		//谁支付保险费，1：卖家赠送；2：买家；3：平台承担
		$orderPo['dealWhoPayInsuranceFee'] = 0;
		$orderPo['dealInsuranceFee']       = 0;  //对应premium_cost字段
		$orderPo['dealSysAdjustFee']       = 0;
		
		//合约机不使用积分下单,下单也不赠送积分
		$orderPo['payScore']               = 0;
		$orderPo['obtainScore']            = 0;
		
		//订单生成时间
		$orderPo['dealGenTime']            = $now;
		
		//订单发货地描述,下来确认是否填写正确(确认过了，不需要填写)
		$orderPo['sendFromDesc']           = '';
		
		//下单时间戳,目前填写订单创建时间
		$orderPo['dealSeq']                = $now;
		
		//下单md5（seq+recvregionid+skulist） ------------------------后面再填
		$orderPo['dealMd5']                = '';
		
		
		$orderPo['dealIp']                 = iconv('GBK', 'UTF-8', $orderMain['customer_ip']);
		
		//填cpsinfo，透传的，具体意义下来确认
		$orderPo['dealRefer']              = $orderMain['cpsinfo'];
		$orderPo['dealVisitKey']           = $orderMain['visitkey'];
		$orderPo['promotionDesc']          = '';
		
		//用户相关
		$orderPo['recvName']               = iconv('GBK', 'UTF-8', $newOrder['receiver']);
		$orderPo['recvRegionCode']         = 0; //前期不填
		$orderPo['recvRegionCodeExt']      = $newOrder['receiveAddrId'];
		$orderPo['recvAddress']            = iconv('GBK', 'UTF-8', $newOrder['receiveAddrDetail']);
		$orderPo['recvPostCode']           = $newOrder['zipCode'];
		$orderPo['recvPhone']              = $newOrder['receiverTel'];
		$orderPo['recvMobile']             = $newOrder['receiverMobile'];
		$orderPo['expectRecvTime']         = $orderMain['expect_dly_date'];
		$orderPo['expectRecvTimeSpan']     = $orderMain['expect_dly_time_span'];
		$orderPo['recvRemark']             = iconv('GBK', 'UTF-8', $newOrder['comment']);
		if($newOrder['sign_by_other'] == 1)
                     $orderPo['recvMask']  = $UNPDealRecvMask_E[1];
		else 
			$orderPo['recvMask']   = $UNPDealRecvMask_E[0];
		
		//物流相关
		$orderPo['expressType']            = 0;
		$orderPo['expressCompanyID']       = '';
		$orderPo['expressCompanyName']     = '';
		
		$orderPo['cftDealId']              = '';
		$orderPo['lastUpdateTime']         = 0;
		
		//订单商品映射
		$orderPo['tradeInfoList']          = array('tradeInfoList' => array());    //-----------------------------------------------------------下面在填
		
		//payInfoList,actionLogInfoList,dealExtInfoMap不用填
		/*
		$orderPo['payInfoList'] = ayyay();
		$orderPo['actionLogInfoList'] = ayyay();
		$orderPo['dealExtInfoMap'] = ayyay();
	    */
		
		$orderPo['bdealCode']              = '';//不知道是干什么的，下来确认下（确认过了，不填）
		$orderPo['businessBdealId']        = $newOrderId;   //暂时填订单id
		$orderPo['siteId']                 = $wh_id;
		$orderPo['dealCouponFee']          = $couponInfo['amt'];
		$orderPo['cashScore']              = 0;
		$orderPo['promotionScore']         = 0;
		$orderPo['dealDigest']             = '';
		
		//分期付款信息（暂时没有）
		$orderPo['payInstallmentBank']     = '';
		$orderPo['payInstallmentNum']      = 0;
		$orderPo['payInstallmentPayment']  = 0;
		
		//易迅订单扩展信息
		$orderPo['icsonShippingType']      = $newOrder['shipType'];
		$orderPo['icsonPayType']           = $newOrder['payType'];
		$orderPo['icsonAccount']           = $newOrder['uid'];
		$orderPo['icsonMasterLs']          = $orderMain['ls'];
		$orderPo['icsonRate']              = '';
		$orderPo['icsonBankRate']          = '';
		$orderPo['icsonShopId']            = '';
		$orderPo['icsonShopGuideId']       = '';
		$orderPo['icsonShopGuideCost']     = 0;
		$orderPo['icsonShopGuideName']     = '';
		$orderPo['icsonSubsidyType']       = 0;
		$orderPo['icsonSubsidyName']       = '';
		$orderPo['icsonSubsidyIdCard']     = '';
		$orderPo['icsonCSOrderOperatorId'] = '';
		$orderPo['icsonCSOrderOperatorName'] = '';
		$orderPo['icsonDealFlag']          = ORDER_CP;
		$orderPo['icsonStockNo']           = $psyStock;
		$orderPo['payChannel']             = 0;  //暂时不填
		$orderPo['payServiceFee']          = 0;
		$orderPo['icsonDealCashBack']      = 0;
		$orderPo['payInstallmentFee']      = 0;

		//订单维度活动列表
		$orderPo['dealActiveInfoList']     = array('tradeActiveInfoList' => array());
		if(isset($newOrder['couponCode']) && $newOrder['couponCode'] != "")
		{
			$tradeActivePo                     = array();
			$tradeActivePo['activeNo']         = isset($coupon['coupon_id']) ? $coupon['coupon_id'] : 0;
			$tradeActivePo['activeType']       = 5;
			$tradeActivePo['activeRuleId']     = $tradeActivePo['activeNo'];
			$tradeActivePo['activeDesc']       = isset($coupon['coupon_name']) ? $coupon['coupon_name'] : '';
			$tradeActivePo['adjustFee']        = 0;
			$tradeActivePo['favorFee']         = $couponInfo['amt'];
			$tradeActivePo['activeParam1']     = $couponInfo['type'];
			$tradeActivePo['activeParam2']     = 1;
			$tradeActivePo['activeParam6']     = $couponInfo['type'];
			$tradeActivePo['activeParam7']     = $couponInfo['code'];
			$tradeActivePo['activeParam8']     = $tradeActivePo['activeDesc'];
			$orderPo['dealActiveInfoList']['tradeActiveInfoList'][] = $tradeActivePo;
		}
		
		//add by donadzhang 接入统一订单   end 
		
		// 插入订单数据库
		$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $orderMain);
		if( false === $ret )
		{
			exd_Attr_API2(634524, 1);
			self::$errCode = -2033;
			self::$errMsg = '执行insert订单语句失败, line:'. __LINE__ . ',errMsg:' . $orderDb->errMsg;
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql("rollback");
			self::_transaction( $msSQL, "rollback", __LINE__ );
			return false;
		}
		Logger::info("插入订单数据库");
		
		//库存双写 S zaleli
		$orderCreatTime = $now;
		$lockedInventory = array();//记录已锁库存信息
		//库存双写 E zaleli
		
		//扣库存 插入订单和商品的映射表
		$now = time();
		$SubKeyId = $psyStock;
		$timeNow = date('Y-m-d H:i:s', $now);
                $uniProductIds = array();
		foreach ($shoppingProduct as $sp)
		{		
			//扣分仓
			$sql = "update Inventory_Stock set AvailableQty = AvailableQty - {$sp['buy_num']},  OrderQty = OrderQty + {$sp['buy_num']}, rowModifydate='{$timeNow}' where  StockSysNo=$SubKeyId AND  ProductSysNo={$sp['product_id']}";
			$ret = $msSQL->execSql($sql);			
			if (false === $ret || 1 != $msSQL->getAffectedRows()) 
			{	
				exd_Attr_API2(634525, 1);
				Logger::info($sql);	
				self::$errCode = -2047;
				self::$errMsg="扣减ms sql分仓库存失败({$sp['product_id'] })"  . $msSQL->errMsg;
				//接入促销2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//接入促销2.0 E zaleli
				$orderDb->execSql("rollback");
				$msSQL->execSql("rollback");
				return false;
			}
			$uniProductIds[] = $sp['product_id'];
			//库存双写 S zaleli
			$inventroyAllDatas = array();
			$inventroyData = array();
			$inventroyData['product_id'] = $sp['product_id'];
			$inventroyData['sys_stock'] = $SubKeyId;
			$inventroyData['order_id'] = $newOrderId;
			$inventroyData['order_creat_time'] = $orderCreatTime;
			$inventroyData['buy_count'] = $sp['buy_num'];
			if ($product_base_info[$sp['product_id']]['sale_model'] < 1)
			{
				$inventroyData['order_type'] = 1;
			}
			else
			{
				$inventroyData['order_type'] = $product_base_info[$sp['product_id']]['sale_model'];
			}
			$inventroyAllDatas[] = $inventroyData;
			$inventoryRet = self::_setLockInventory($inventroyAllDatas,$uid);
			if (false === $inventoryRet)
			{
				//打印错误日志
				Logger::err("_setLockInventory Err. inventroyAllDatas:".ToolUtil::gbJsonEncode($inventroyAllDatas)." uid:".$uid);	
			}
			else
			{
				$lockedInventory[] = $inventroyData;//记录已锁库存信息
				Logger::info("lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//库存双写 E zaleli
			// 记库存变化流水
			// AvailableQty
			$buy_num_negative = -1 * $sp['buy_num'];
			$sql = "insert into Inventory_Flow values({$SubKeyId}, {$sp['product_id']}, 1, '{$newOrderId}', 2, {$buy_num_negative},'{$timeNow}', '{$timeNow}',7)";
			$ret = $msSQL->execSql($sql);
			if ( false === $ret )
			{
				exd_Attr_API2(634526, 1);
				Logger::info($sql);	
				self::$errCode = -2048;
				self::$errMsg = "记录 AvailableQty 变化流水失败, line:". __LINE__ .",errMsg".$msSQL->errMsg;
				//接入促销2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//接入促销2.0 E zaleli
				$orderDb->execSql("rollback");
				//库存双写 S zaleli
				//解锁库存
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//打印错误日志
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//库存双写 E zaleli
				$msSQL->execSql("rollback");
				return false;
			}
			
			// OrderQty			
			$sql = "insert into Inventory_Flow values({$SubKeyId}, {$sp['product_id']}, 1, '{$newOrderId}', 4, {$sp['buy_num']},'{$timeNow}', '{$timeNow}',7)";
			$ret = $msSQL->execSql($sql);
			if ( false === $ret )
			{
				exd_Attr_API2(634527, 1);
				Logger::info($sql);	
				self::$errCode = -2049;
				self::$errMsg = "记录 OrderQty 变化流水失败, line:". __LINE__ .",errMsg".$msSQL->errMsg;
				//接入促销2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//接入促销2.0 E zaleli
				$orderDb->execSql("rollback");
				//库存双写 S zaleli
				//解锁库存
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//打印错误日志
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//库存双写 E zaleli
				$msSQL->execSql("rollback");
				return false;
			}
			
			$product_base_info[$sp['product_id']]['point_type'] = isset($product_base_info[$sp['product_id']]['point_type'])? $product_base_info[$sp['product_id']]['point_type'] : 0;
			$product_base_info[$sp['product_id']]['point'] = isset($product_base_info[$sp['product_id']]['point'])? $product_base_info[$sp['product_id']]['point'] : 0;
			$product_base_info[$sp['product_id']]['cost_price'] = isset($product_base_info[$sp['product_id']]['cost_price'])? $product_base_info[$sp['product_id']]['cost_price'] : 0;
			$product_base_info[$sp['product_id']]['show_price'] = isset($product_base_info[$sp['product_id']]['show_price'])? $product_base_info[$sp['product_id']]['show_price'] : 0;
			
			$newOrderItems = array(
				'item_id' => $itemStartID++,
				'order_char_id' => $newOrderCharId,
				'wh_id' => $wh_id,
				'product_id' => $sp['product_id'],
				'product_char_id' => $product_base_info[$sp['product_id']]['product_char_id'],
				'uid' => $newOrder['uid'],
				'name' => $product_base_info[$sp['product_id']]['name'],
				'flag' => $product_base_info[$sp['product_id']]['flag'],
				'type' => $product_base_info[$sp['product_id']]['type'],
				'type2' => $product_base_info[$sp['product_id']]['type2'],
				'weight' => $product_base_info[$sp['product_id']]['weight'],
				'buy_num' => $sp['buy_num'],
				'points' => $product_base_info[$sp['product_id']]['point'] * $sp['buy_num'],
				'points_pay' => 0,
				'point_type' => $product_base_info[$sp['product_id']]['point_type'],
				'discount' => 0,
				'price' => ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_NORMAL)? $product_base_info[$sp['product_id']]['show_price']:0,
				'cash_back' => 0,
				'cost' => $product_base_info[$sp['product_id']]['cost_price'],
				'warranty' =>($sp['product_id'] == $CardID ? $packBrief: $product_base_info[$sp['product_id']]['warranty']),
				'expect_num' => 0,
				'create_time' => $now,
				'product_type' => $sp['type'],
				'use_virtual_stock' => 0,
				'main_product_id' => ($sp['type'] != SHOPPING_CART_PRODUCT_TYPE_NORMAL) ? $newOrder['product_id'] : 0,
				'updatetime' => $now,
				'edm_code' =>'',
				'apportToPm'=> $couponInfo['type'] == 1 ? $couponInfo['amt'] : 0,
				'apportToMkt' => 0,
				'shop_guide_cost' => 0 // 原则上，分销导购订单不能走到定制机这块
			);
			
			$newOrder['order_items'][] = $newOrderItems; //需要将order_item 传出该函数
			$ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}" , $newOrderItems);
			if (false === $ret) {
				exd_Attr_API2(634532, 1);
				self::$errCode = -2039;
				self::$errMsg='执行sql语句失败' . $orderDb->errMsg;
				//接入促销2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//接入促销2.0 E zaleli
				$orderDb->execSql("rollback");
				//库存双写 S zaleli
				//解锁库存
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//打印错误日志
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//库存双写 E zaleli
				self::_transaction( $msSQL, "rollback", __LINE__ );
				return  false;
			}
                        //add by donadzhang 接入统一订单   start 
			$orderTradePo = array();
			$orderTradePo['dealId']                 =  '';
			$orderTradePo['dealId64']               = 0;
			$orderTradePo['bdealId']                = 0;
			//$orderTradePo['tradeId']                = 0;
			$orderTradePo['buyerId']                = '';
			$orderTradePo['buyerNickName']          = '';
			$orderTradePo['sellerId']               = $UNPSellerAccount51Buy_E['sellerId'];
			$orderTradePo['sellerTitle']            = iconv('GBK', 'UTF-8', $UNPSellerAccount51Buy_E['sellerTitle']);
			$orderTradePo['businessId']             = 2;
			$orderTradePo['tradeType']              = 2;
			$orderTradePo['tradeSource']            = 1;
			$orderTradePo['tradePayType']           = 0;                 //需要关注
			$orderTradePo['shippingfeeTemplateId']  = ''; 
			$orderTradePo['shippingfeeDesc']        = ''; 
			$orderTradePo['itemShippingfee']        = 0; 
			switch((int)$newOrderItems['product_type']) 
			{
				case 0 :
					$itemType = $UNPDealItemType_E['UNP_DEAL_ITEM_TYPE_NORMAL'];
					break;
				case 1 :
					$itemType = $UNPDealItemType_E['UNP_DEAL_ITEM_TYPE_ASSEMBLY'];
					break;
				case 2 :
					$itemType = $UNPDealItemType_E['UNP_DEAL_ITEM_TYPE_GIFT_FOLLOW'];
					break;
			}
			$orderTradePo['itemType']               = $itemType;
			$orderTradePo['itemClassId']            = 0;//统一商品接入再填写
			$orderTradePo['itemTitle']              = iconv('GBK', 'UTF-8', $newOrderItems['name']);
			$orderTradePo['itemAttrCode']           = 0;//统一商品接入再填写
			$orderTradePo['itemAttr']               = 0;//统一商品接入再填写
			$orderTradePo['itemSkuId']              = 0;//统一商品接入再填写
			$orderTradePo['itemSpuId']              = 0;//统一商品接入再填写
			$orderTradePo['itemStockId']            = 0;//统一商品接入再填写
			$orderTradePo['itemStoreHouseId']       = 0;//统一商品接入再填写
			$orderTradePo['itemLogo']               = 0;//统一商品接入再填写
			$orderTradePo['itemSnapVersion']        = 0;//统一商品接入再填写
			$orderTradePo['itemResetTime']          = 0;//统一商品接入再填写
			$orderTradePo['itemId']                 = $newOrderItems['product_id'];
			$orderTradePo['itemLocalStockCode']     = '';
			$orderTradePo['itemBarCode']            = '';
			$orderTradePo['itemPhyisicalStorage']   = $psyStock;
			$orderTradePo['itemWeight']             = $newOrderItems['weight'];
			$orderTradePo['itemVolume']             = 0; //暂不设置
			$orderTradePo['mainItemId']             = $newOrderItems['main_product_id'];
			$orderTradePo['itemAccessoryDesc']      = '';
			$orderTradePo['itemCostPrice']          = $newOrderItems['cost'];
			$orderTradePo['itemOriginPrice']        = 0;
			$orderTradePo['activeInfoList']         = array('tradeActiveInfoList' => array());   //接入促销2.0后再来填
			$orderTradePo['itemB2CMarket']          = 0;
			$orderTradePo['itemB2CPM']              = 0;
			$orderTradePo['tradeDiscountTotal']     = 0;
			$orderTradePo['itemSoldPrice']          = $newOrderItems['price'];
			$orderTradePo['buyPrice']               = $orderTradePo['itemSoldPrice'];
			$orderTradePo['buyNum']                 = $newOrderItems['buy_num'];
			$orderTradePo['tradePayment']           = $orderTradePo['buyPrice']*$orderTradePo['buyNum'];
			//接入促销2.0 S zaleli
			if($newOrder['product_id'] == $sp['product_id'])
			{
				if (
					$product_base_info[$sp['product_id']]['multprice']['priceSceneId'] >= 3 &&
					$product_base_info[$sp['product_id']]['multprice']['priceSourceId'] >= 3
				)
				{
					$tradeActivePo                      = array();
					$tradeActivePo['activeType']        = 1;
					$tradeActivePo['preActiveFee']      = $product_base_info[$sp['product_id']]['multprice']['priceBeforeFavor'];
					$tradeActivePo['adjustFee']         = $product_base_info[$sp['product_id']]['multprice']['priceDiscount'];
					$tradeActivePo['favorFee']          = 0;
					$tradeActivePo['activeParam2']      = $product_base_info[$sp['product_id']]['multprice']['priceOpType'];
					$tradeActivePo['activeParam3']      = $product_base_info[$sp['product_id']]['multprice']['unitPriceOpNum'];
					$tradeActivePo['activeParam5']      = $product_base_info[$sp['product_id']]['multprice']['priceSceneId'];
					$tradeActivePo['activeParam6']      = $product_base_info[$sp['product_id']]['multprice']['priceSourceId'];
					$orderTradePo['activeInfoList']['tradeActiveInfoList'][] = $tradeActivePo;
				}
			}
			//接入促销2.0 E zaleli
			if($newOrder['product_id'] == $sp['product_id'])
			{
				//$orderTradePo['itemSoldPrice'] = $newOrderItems['price'] - $couponInfo['amt'];
				//if($orderTradePo['itemSoldPrice'] < 0) $orderTradePo['itemSoldPrice'] = 0;
				
				$orderTradePo['itemB2CPM']              = $couponInfo['type'] == 1 ? $couponInfo['amt'] : 0;
				$orderTradePo['itemB2CMarket']          = $couponInfo['amt'];
				
				//填入商品维度活动列表
				if(isset($newOrder['couponCode']) && $newOrder['couponCode'] != "")
				{
					$tradeActivePo                      = array();
					$tradeActivePo['activeNo']          = isset($coupon['coupon_id']) ? $coupon['coupon_id'] : 0;
					$tradeActivePo['activeType']        = 5;
					$tradeActivePo['activeRuleId']      = $tradeActivePo['activeNo'];
					$tradeActivePo['activeDesc']        = isset($coupon['coupon_name']) ? $coupon['coupon_name'] : '';
					$tradeActivePo['preActiveFee']      = $newOrderItems['price'];
					$tradeActivePo['adjustFee']         = 0;
					$tradeActivePo['favorFee']          = $couponInfo['amt'];
					$tradeActivePo['activeParam1']      = $couponInfo['type'];
					$tradeActivePo['activeParam2']      = 1;
					$tradeActivePo['activeParam5']      = $orderTradePo['itemB2CPM'];
					$tradeActivePo['activeParam6']      = $orderTradePo['itemB2CMarket'];
					$tradeActivePo['activeParam7']      = $couponInfo['code'];
					$tradeActivePo['activeParam8']      = $tradeActivePo['activeDesc'];
					$orderTradePo['activeInfoList']['tradeActiveInfoList'][] = $tradeActivePo;
					$orderTradePo['tradeDiscountTotal'] = $couponInfo['amt'];
					$orderTradePo['tradePayment']       = $orderTradePo['tradePayment'] - $couponInfo['amt'];
					if($orderTradePo['tradePayment'] < 0)
					{
							Logger::err('error');
					}
				}
				
			}
			//else $orderTradePo['itemSoldPrice']     = $newOrderItems['price'];
			$orderTradePo['itemUseVirtualStock']    = 0;
			$orderTradePo['tradeTotalFee']          = $orderTradePo['tradePayment']; //下单时tradeTotalFee = tradePayment
			$orderTradePo['tradeAdjustFee']         = 0; //下单不填
			$orderTradePo['tradePaipaiHongbaoUsed'] = 0; //不填
			$orderTradePo['payScore']               = 0;
			$orderTradePo['tradeGenTime']           = $now;
			$orderTradePo['tradeOpSerialNo']        = 0;
			$orderTradePo['obtainScore']            = $newOrderItems['points'];
			$orderTradePo['tradeState']             = 0;
			//这个等下下来确认怎么填
			$orderTradePo['tradeProperty']          = 0;
			$orderTradePo['tradeProperty1']         = 0;
			$orderTradePo['tradeProperty2']         = self::getTradeProperty2($newOrderItems['flag']);
			$orderTradePo['tradeProperty3']         = self::getTradeProperty3($newOrderItems['type']);
			$orderTradePo['tradeProperty4']         = 0;
			
			$orderTradePo['itemTimeoutFlag']        = 0;
			$orderTradePo['lastUpdateTime']         = 0;
			$orderTradePo['dealExtInfoMap']         = array();
			//$orderTradePo['tradeSellerSendTime']    = 0;
                        if($sp['product_id'] == $CardID)  $orderTradePo['warranty'] = '';
                        else  $orderTradePo['warranty'] = iconv('GBK', 'UTF-8', $newOrderItems['warranty']);
			$orderTradePo['productId']              = $newOrderItems['product_id'];
			$orderTradePo['itemLocalCode']          = $newOrderItems['product_char_id'];
			
			//易迅扩展信息
			$orderTradePo['icsonEdmCode']           = '';
			$orderTradePo['icsonOTag']              = '';
			$orderTradePo['icsonTradeShopGuideCost'] = '';
			$orderTradePo['icsonTradeFlag']         = $newOrderItems['flag'];
			$orderTradePo['icsonPointType']         = $newOrderItems['point_type'];
			$orderTradePo['icsonPackageIds']        = '';
			$orderTradePo['icsonTradeCashBack']     = 0;
			$orderPo['tradeInfoList']['tradeInfoList'][] = $orderTradePo;
			//add by donadzhang 接入统一订单   end 
		}
		
		if(0 == $newOrder['isVat'])//如果不需要开发票，那么其他字段为空
		{
			$newOrder['invoiceType'] = '';
			$newOrder['invoiceTitle'] = '';
			$newOrder['invoiceContent'] = '';
			$newOrder['invoiceCompanyName'] = '';
			$newOrder['invoiceCompanyAddr'] = '';
			$newOrder['invoiceCompanyTel'] = '';
			$newOrder['invoiceTaxno'] = '';
			$newOrder['invoiceBankNo'] = '';
			$newOrder['invoiceBankName'] = '';
		}
		
		//Logger::err("插入商品订单表");
		// 插入发票信息
		$newInv = array(
			'user_invoice_id'=> $newOrder['invoiceId'],
			'order_char_id'=> $newOrderCharId,
			'uid'=> $newOrder['uid'],
			'type'=> $newOrder['invoiceType'],
			'title'=> $newOrder['invoiceTitle'],
			'name'=> $newOrder['invoiceCompanyName'],
			'addr'=> $newOrder['invoiceCompanyAddr'],
			'phone'=> $newOrder['invoiceCompanyTel'],
			'taxno'=> $newOrder['invoiceTaxno'],
			'bankno'=> $newOrder['invoiceBankNo'],
			'bankname'=> $newOrder['invoiceBankName'],
			'content'=> $newOrder['invoiceContent'],
			'updatetime'=> time(),
			'wh_id' => $wh_id,
			'auto_id'=> $invoice_id,
		);
		
		$ret = $orderDb->insert("t_order_invoice_{$db_tab_index['table']}", $newInv);
		if (false === $ret) {
			exd_Attr_API2(634528, 1);
			self::$errCode = -2050;
			self::$errMsg = '执行insert发票表, line:'. __LINE__ . ',errMsg:' . $orderDb->errMsg;
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql("rollback");
			//库存双写 S zaleli
			//解锁库存
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//打印错误日志
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//库存双写 E zaleli
			self::_transaction( $msSQL, "rollback", __LINE__ );
			return false;
		}
                //add by donadzhang 接入统一订单   start
		//发票信息
		if($newOrder['isVat'] == 0)
                    $orderPo['invoiceType'] = 0;
		else
                    $orderPo['invoiceType'] = self::getInvoiceType($newOrder['invoiceType']);
		$orderPo['invoiceHead'] = iconv('GBK', 'UTF-8', $newOrder['invoiceTitle']);
		$orderPo['invoiceContent'] = iconv('GBK', 'UTF-8', $newOrder['invoiceContent']);
		$orderPo['icsonInvoiceCompanyName']     = iconv('GBK', 'UTF-8', $newOrder['invoiceCompanyName']);
		$orderPo['icsonInvoiceCompanyAddr']     = iconv('GBK', 'UTF-8', $newOrder['invoiceCompanyAddr']);
		$orderPo['icsonInvoiceCompanyPhone']    = $newOrder['invoiceCompanyTel'];
		$orderPo['icsonInvoiceCompanyTaxNo']    = $newOrder['invoiceTaxno'];
		$orderPo['icsonInvoiceCompanyBankNo']   = $newOrder['invoiceBankNo'];
		$orderPo['icsonInvoiceCompanyBankName'] = iconv('GBK', 'UTF-8', $newOrder['invoiceBankName']);
		
		//货票分离
		$orderPo['icsonInvoiceRecvName']        = '';
		$orderPo['icsonInvoiceRecvAddr']        = '';
		$orderPo['icsonInvoiceRecvRegionId']    = '';
		$orderPo['icsonInvoiceRecvMobile']      = '';
		$orderPo['icsonInvoiceRecvTel']         = '';
		$orderPo['icsonInvoiceRecvZip']         = '';
		$orderPo['icsonInvoiceShipType']        = 0;
		$orderPo['icsonInvoiceShipFee']         = 0;
		if(isset($newOrder['separateInvoice']) && $newOrder['separateInvoice'] == 1)
		{
			$orderPo['icsonInvoiceRecvName']      = iconv('GBK', 'UTF-8', $newOrder['invoiceReceiver']);
			$orderPo['icsonInvoiceRecvAddr']      = iconv('GBK', 'UTF-8', $newOrder['invoiceReceiveAddrDetail']);
			$orderPo['icsonInvoiceRecvRegionId']  = $newOrder['invoiceReceiveAddrId'];
			$orderPo['icsonInvoiceRecvMobile']    = $newOrder['invoiceReceiverMobile'];
			$orderPo['icsonInvoiceRecvTel']       = $newOrder['invoiceReceiverTel'];
			$orderPo['icsonInvoiceRecvZip']       = $newOrder['invoicezipCode'];
			$orderPo['icsonInvoiceShipType']      = YT_DELIVERY;//目前只支持圆通
			$orderPo['icsonInvoiceShipFee']       = 1000;//分为单位
		}
		//add by donadzhang 接入统一订单   end
                
		//Logger::err("插入发票");
		$orderDb = ToolUtil::getMSDBObj('ICSON_CORE');			
		//此处的package_id实为fee_id
		// 插入合约表
		$contractinfo = array();
		$contractinfo['order_char_id'] = $newOrderCharId; 
		$contractinfo['uid'] = $newOrder['uid']; 
		$contractinfo['hw_id'] = $wh_id; 
		$contractinfo['order_date'] = $now; 
		$contractinfo['product_id'] = $newOrder['product_id']; 
		$contractinfo['service_type'] = $service_type;  ///?????
		$contractinfo['package_id'] = $newOrder['package_id']; 
		$contractinfo['num'] = $newOrder['num']; 
		$contractinfo['name'] = $newOrder['user_name']; 
		$addrArray = array();
		$addrArray = ToolUtil::getLocInfo($newOrder['receiveAddrId']);
		$user_addrinfo = $addrArray['full_name'] . $newOrder['receiveAddrDetail'];
		$contractinfo['user_addr'] = (isset($newOrder['user_addr'])&&$newOrder['user_addr']!="") ? $newOrder['user_addr'] : $user_addrinfo;
		$contractinfo['zip_code'] = (isset($newOrder['user_zipcode'])&&$newOrder['user_zipcode']!="") ? $newOrder['user_zipcode'] : $newOrder['zipCode']; 
		$contractinfo['user_mobile'] = (isset($newOrder['user_phone'])&& $newOrder['user_phone']!="") ? $newOrder['user_phone'] : $newOrder['receiverMobile'];
		$contractinfo['user_tel'] = (isset($newOrder['user_phone'])&&$newOrder['user_phone']!="") ? $newOrder['user_phone'] : $newOrder['receiverMobile'];
		Logger::info("new order information:" . "user_addr = " . $newOrder['user_addr'] . "user_zipcode = " . $newOrder['user_zipcode'] . "user_mobile = " . $newOrder['user_phone'] . "user_tel = " . $newOrder['user_phone']);
		Logger::info("contractinfo information: = " . "user_addr = " . $contractinfo['user_addr'] . "zip_code = " . $contractinfo['zip_code'] . "user_tel = " . $newOrder['receiverMobile'] . " user_mobile = " . $contractinfo['user_mobile']);
		Logger::info("neworder information: = " . "user_addr = " . $user_addrinfo . "user_zipcode = " . $newOrder['zip_code'] . "user_tel = " . $newOrder['user_phone']);
		
		$contractinfo['idcard_num'] = $newOrder['user_idcard']; 
		$contractinfo['idcard_address'] = $newOrder['user_idaddr']; 
		$contractinfo['idcard_date'] = $newOrder['user_idindate']; 
		$contractinfo['card_price'] = $card_price; 
		$contractinfo['package_price'] = (int) $package_price; 
		$contractinfo['synflag'] = 1;
		$contractinfo['sp_id'] = $sp_id;
		
		$ret = $orderDb->insert("t_cp_contract_info", $contractinfo);
		if (false === $ret) {
			exd_Attr_API2(634529, 1);
			self::$errCode = -2050;
			self::$errMsg = '执行插入合约表失败, line:'. __LINE__ . ',errMsg:' . $orderDb->errMsg;
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql("rollback");
			//库存双写 S zaleli
			//解锁库存
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//打印错误日志
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//库存双写 E zaleli
			self::_transaction( $msSQL, "rollback", __LINE__ );
			return false;
		}
		//Logger::err("插入合约表");
		// 在mysql的号码库中更新状态	
		// 连接到前台的数据库cp_information
        if( false === self::_getDB_s("cp_information", $mysql, __LINE__ ))
        {
                self::$errMsg = ToolUtil::$errMsg;
				//接入促销2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//接入促销2.0 E zaleli
                $orderDb->execSql("rollback");
				//库存双写 S zaleli
				//解锁库存
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//打印错误日志
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//库存双写 E zaleli
                self::_transaction( $msSQL, "rollback", __LINE__ );
                return false;
        }
        global $_CP_Num_Status;
        $data = array( 'status' => $_CP_Num_Status['NA'] );
		$condition = "num={$newOrder['num']} and status={$_CP_Num_Status['Locked']}";
		//$condition = "num={$newOrder['num']}";
        $ret = self::_update_s("t_cp_num", $mysql, $data, $condition, __LINE__);
		if(false === $ret )
		{
			exd_Attr_API2(634516, 1);
			self::$errCode = 501;
			self::$errMsg = '更新号码('.$newOrder['num'].')失败, line:'. __LINE__ . ',errMsg:' . self::$errMsg;
			Logger::err(self::$errMsg);
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql("rollback");
			//库存双写 S zaleli
			//解锁库存
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//打印错误日志
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//库存双写 E zaleli
			$msSQL->execSql("rollback");
			return false;
		}
		
		if( !$mysql->getAffectedRows() )
		{
			exd_Attr_API2(634516, 1);
			self::$errCode = 501;
			self::$errMsg = '更新号码('.$newOrder['num'].')失败, line:'. __LINE__ . ',getAffectedRows :' . $mysql->getAffectedRows();
			Logger::err(self::$errMsg);
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql("rollback");
			//库存双写 S zaleli
			//解锁库存
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//打印错误日志
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//库存双写 E zaleli
			$msSQL->execSql("rollback");
			if( isset( $_COOKIE['contract_key'] ) )
			{
				// 号码置空
				$data = array(
					'contract_key' => $_COOKIE['contract_key'],
					'num' => ''
				);
				ICpContractTTC::update($data);
			}
			return array(
				'errCode' => 501 , 
				'errMsg' => "您操作时间过长，需要重新选择号码", 
				'url' => self::getUrl($newOrder['product_id'],"steptwo",$chid)
			);
		}

		//BEGIN 更改erp号码池状态
		$productDB = ToolUtil::getMSDBObj('Product');
		if($productDB === false) {
			exd_Attr_API2(634530, 1);
			Logger::err('connect to db error');
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql($sql);
			//库存双写 S zaleli
			//解锁库存
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//打印错误日志
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//库存双写 E zaleli
			$msSQL->execSql($sql);
			return false;
		}
		$ret = $productDB->update('Customization_PhoneNumber', array('Status' => 1), 'PhoneNumber=' . $newOrder['num']);
		if($ret === false) {
			exd_Attr_API2(634530, 1);
			self::$errCode = $productDB::$errCode;
			self::$errMsg = $productDB::$errMsg;
			$sql = "rollback";
			//接入促销2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//接入促销2.0 E zaleli
			$orderDb->execSql($sql);
			//库存双写 S zaleli
			//解锁库存
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//打印错误日志
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//库存双写 E zaleli
			$msSQL->execSql($sql);
			return false;
		}
		//END 更改erp号码池状态

		//BEGIN 更新购物券
		if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			global $_CouponStatus;
			$st = $_CouponStatus['partly_used'];

			if ($couponInfo['used_degree'] + 1 >= $couponInfo['max_use_degree']) {
				$st = $_CouponStatus['used'];
			}
			if (NULL == $mysqlDb) {
				$mysqlDb = ToolUtil::getDBObj('coupon', 0);
				if (false === $mysqlDb) {
					self::$errCode = ToolUtil::$errCode;
					self::$errMsg = ToolUtil::$errMsg;

					if(self::_getDB_s("cp_information", $mysql, __LINE__ ))
					{
						$ret = self::_update_s("t_cp_num", $mysql, array( 'status' => $_CP_Num_Status['Locked'] ), "num={$newOrder['num']} and status={$_CP_Num_Status['NA']}", __LINE__);
						if($ret === false) {
						exd_Attr_API2(634516, 1);
							Logger::err('recover num status to normal error');
						}
					}
					else {
						exd_Attr_API2(634516, 1);
						Logger::err('recover num status to normal error');
					}

					$sql = "rollback";
					//接入促销2.0 S zaleli
					self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
					//接入促销2.0 E zaleli
					$orderDb->execSql($sql);
					//库存双写 S zaleli
					//解锁库存
					$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
					if (false === $inventoryRet)
					{
						//打印错误日志
                                                
						Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
					}
					//库存双写 E zaleli
					$msSQL->execSql($sql);
					return false;
				}

				$sql = "start transaction";
				$ret = $mysqlDb->execSql($sql);
				if (false === $ret) {
					self::$errCode = $mysqlDb->errCode;
					self::$errMsg = $mysqlDb->errMsg;

					if(self::_getDB_s("cp_information", $mysql, __LINE__ ))
					{
						$ret = self::_update_s("t_cp_num", $mysql, array( 'status' => $_CP_Num_Status['Locked'] ), "num={$newOrder['num']} and status={$_CP_Num_Status['NA']}", __LINE__);
						if($ret === false) {
							Logger::err('recover num status to normal error');
						}
					}
					else {
						Logger::err('recover num status to normal error');
					}

					$sql = "rollback";
					//接入促销2.0 S zaleli
					self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
					//接入促销2.0 E zaleli
					$orderDb->execSql($sql);
					//库存双写 S zaleli
					//解锁库存
					$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
					if (false === $inventoryRet)
					{
						//打印错误日志
						Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
					}
					//库存双写 E zaleli
					$msSQL->execSql($sql);
					return false;
				}
			}
			$orderstrforlog = ',' . $newOrderId;
			$ret = ICoupon::useCoupon($newOrder['uid'], $couponInfo, $orderstrforlog, $mysqlDb, (isset($userinfo['level']) ? $userinfo['level'] : -1), $wh_id);
			if (false === $ret) {
				exd_Attr_API2(634531, 1);
				self::$errCode = ICoupon::$errCode;
				self::$errMsg = ICoupon::$errMsg;

				$sql = "rollback";
				//库存双写 S zaleli
				//解锁库存
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//打印错误日志
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//库存双写 E zaleli
				$mysqlDb->execSql($sql);
				//接入促销2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//接入促销2.0 E zaleli
				$orderDb->execSql($sql);
				$msSQL->execSql($sql);
				if(self::_getDB_s("cp_information", $mysql, __LINE__ ))
				{
					$ret = self::_update_s("t_cp_num", $mysql, array( 'status' => $_CP_Num_Status['Locked'] ), "num={$newOrder['num']} and status={$_CP_Num_Status['NA']}", __LINE__);
					if($ret === false) {
					exd_Attr_API2(634516, 1);
						Logger::err('recover num status to normal error');
					}
				}
				else {
					exd_Attr_API2(634516, 1);
					Logger::err('recover num status to normal error');
				}
				return false;
			}
			
			$mysqlDb_commit_ret = $mysqlDb->execSql('commit');
			
		}		
		//END 更新购物券
		
		$msSQL->execSql("commit");
		$orderDb->execSql("commit");
		//Logger::err("返回");
		$result = array(
			'errCode' => 0,
			'uid'=> $newOrder['uid'],
			'orderId'=>$newOrderCharId, //$newOrderId,
			'orderAmt'=>$cash,
			'payType'=>$newOrder['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
			'payTypeName' => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
			'orderTotalAmt'=>$cash, //订单总金额
			'payGoodsAmt' => $cash, //订单客户支付的金额（去掉运费和享受到的其它优惠后的用户实际支付金额）
			'orderCreateTime'=>$now,
			'isParentOrder' => false,
			'order_items' => $newOrder['order_items'],
		);
		
		if( isset( $_COOKIE['contract_key'] ) )
		{
			ICpContractTTC::remove($_COOKIE['contract_key']);
		}
		Logger::info('start uni order');
		//add by donadzhang 接入统一订单   start
		global $_UIN_ORDER_4_CUSTOMPHONE;
		if($_UIN_ORDER_4_CUSTOMPHONE['flag'] != true)
		{
			Logger::info("_UIN_ORDER_4_CUSTOMPHONE OFF");
			return $result;
		}
		else
		{
			if($_UIN_ORDER_4_CUSTOMPHONE['type'] == 1)
            {
				//白名单灰度
                if(!in_array($newOrder['uid'], $_UIN_ORDER_4_CUSTOMPHONE['list']))
				{
					Logger::info("_UIN_ORDER_4_CUSTOMPHONE WHITE LIST NOT MATCH");
					return $result;
				}
				else 
					Logger::info("_UIN_ORDER_4_CUSTOMPHONE WHITE LIST  MATCH");
            }
			else if($_UIN_ORDER_4_CUSTOMPHONE['type'] == 2)
            {
                //uid取模灰度
                $mod = $_UIN_ORDER_4_CUSTOMPHONE['mod'];
                if($newOrder['uid'] % $mod != 0)
                {
                   Logger::info("_UIN_ORDER_4_CUSTOMPHONE MOD NOT MATCH");
				   return $result;
                }
				else
					Logger::info("_UIN_ORDER_4_CUSTOMPHONE MOD MATCH");
            }
			else if($_UIN_ORDER_4_CUSTOMPHONE['type'] == 3)
			{
				Logger::info("_UIN_ORDER_4_CUSTOMPHONE ALL ON");
			}
		}
		
		$boData = array();
		$wgid = self::_getWgUidByIcsonUid($uid);
		if ($wgid === false) 
		{
				Logger::err("_GetWgUidByIcsonUid failed, uid:{$uid}, wgid:{$wgid}");
				return $result;
		}
		Logger::info("_GetWgUidByIcsonUid success, uid:{$uid}, wgid:{$wgid}");
		$orderPo['buyerId'] = $wgid;
		$orderPo['dealMd5'] = self::md5Int($wgid.$orderPo['dealSeq'].implode(',', $uniProductIds));
		$orderPo['icsonDealCode'] = $newOrderCharId;
		
		//插入合约信息
		$itemTitles = array();
		for($c = 0;$c < count($orderPo['tradeInfoList']['tradeInfoList']);$c++)
		{
			$tempOrderTradePo = &$orderPo['tradeInfoList']['tradeInfoList'][$c];
			$tempOrderTradePo['icsonCSPhoneType']       = $service_type;
			$tempOrderTradePo['icsonCSPhoneOperator']   = $sp_id;
			$tempOrderTradePo['icsonCSPhoneNumber']     = $newOrder['num'];
			$tempOrderTradePo['icsonCSPhoneArea']       = iconv('GBK', 'UTF-8', $packageInfo['location_pname'].$packageInfo['location_cname']);
			$tempOrderTradePo['icsonCSPhonePackageId']  = $newOrder['package_id'];
			$tempOrderTradePo['icsonCSPhoneUserName']   = iconv('GBK', 'UTF-8', $newOrder['user_name']);
			$tempOrderTradePo['icsonCSPhoneUserAddr']   = iconv('GBK', 'UTF-8', $contractinfo['user_addr']);
			$tempOrderTradePo['icsonCSPhoneUserMobile'] = $contractinfo['user_mobile'];
			$tempOrderTradePo['icsonCSPhoneUserTel']    = $contractinfo['user_tel'];
			$tempOrderTradePo['icsonCSPhoneIdCardNo']   = $contractinfo['idcard_num'];
			$tempOrderTradePo['icsonCSPhoneIdCardAddr'] = iconv('GBK', 'UTF-8', $contractinfo['idcard_address']);
			$tempOrderTradePo['icsonCSPhoneIdCardDate'] = $contractinfo['idcard_date'];
			$tempOrderTradePo['icsonCSPhoneZipCode']    = $contractinfo['zip_code'];
			$tempOrderTradePo['icsonCSPhoneCardPrice']  = $contractinfo['card_price'];
			$tempOrderTradePo['icsonCSPhonePackagePrice'] = $contractinfo['package_price'];
            //            $tempOrderTradePo['location_pid']           = $packageInfo['location_pid'];
            //            $tempOrderTradePo['location_cid']           = $packageInfo['location_cid'];
			$tempOrderTradePo['buyerId']                = $wgid;
			$itemTitles[] = $tempOrderTradePo['itemTitle'];
		}
				$orderPo['itemTitleList'] = iconv('GBK', 'UTF-8', implode(';', $itemTitles));
                $orderPoList['orderInfoList'][] = $orderPo;
                
                $boData['wgid']    = $wgid;
                $boData['dealId']  = '';
                $boData['bdealId'] = '';
				$boData['clientIp'] = $orderMain['customer_ip'];
                $reqData = array("opt" => array(),"req" => array());
                $reqData['opt']['uin']       = $uid;          //使用Mod+L5方式设置路由，一般填写用户QQ（对应setDwUin）
                $reqData['opt']['operator']  = $uid;         //操作者ID，一般填写用户QQ（对应setDwOperatorId）
                $reqData['opt']['caller']    = 'customphone';  //调用方名字，用于模调(对应setCallerName)
                $reqData['opt']['timeout']   = 3;             //超时时间，以秒为单位，特殊情况下可以调大
                
                //设置req参数
                $reqData['req']['source'] = __FILE__;
	
                $reqData['req']['machineKey'] = isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : '';
                $boData['machineKey'] = $reqData['req']['machineKey'];
	
                $reqData['req']['verifyToken'] = '';
                $reqData['req']['baseParams'] = self::setEventParamsBaseBo($boData);
                $reqData['req']['orderList'] = $orderPoList;
                $reqData['req']['reserveIn'] = '';
                $uniResult = \WebStubCntl2::request('ecc\deal\ao\CreateBuyDeal',$reqData);
                if($uniResult === false)	
                    Logger::err("write uni order failed, uid:{$uid}, wgid:{$wgid}");
                else
                {
                        if($uniResult['code'] != 0) 
                        {
                            $msg = iconv('UTF-8', 'GBK', $uniResult['msg']);
                            Logger::err("write uni order failed, uid:{$uid}, wgid:{$wgid}, code:{$uniResult['code']}, msg:{$msg}");
                        }
                        else if($uniResult['data']['result'] != 0)
                        {
                            $errmsg = iconv('UTF-8', 'GBK', $uniResult['data']['errmsg']);
                            Logger::err("write uni order failed, uid:{$uid}, wgid:{$wgid}, result:{$uniResult['data']['result']}, errmsg:{$errmsg}");
                        }
                        else   Logger::info("write uni order success, uid:{$uid}, wgid:{$wgid}");
                }
		return $result;
	}
        
        
    /**
     * 根据商品的类型转换
     * @param $type int
     * @return
     */
    private static function getTradeProperty3($type)
    {
        global $UNPTradeProperty51Buy3_E;
        $property = 0x00000000;

        switch ((int)$type) {
                case 0 :
                        //Normal普通商品
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_NORMAL'];
                        break;
                case 1 :
                        //SecondHand二手商品
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SECOND_HAND'];
                        break;
                case 2 :
                        //Bad坏品
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_BAD'];
                        break;
                case 3 :
                        //Service服务
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SERVICE'];
                        break;
                case 4 :
                        //OnlyViewNoSale展示非卖
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ONLY_VIEW'];
                        break;
                case 9 :
                        //OtherProduct其他商品
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_OTHER'];
                        break;
                case 10 :
                        //AdjustProduct改价商品
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ADJUST'];
                        break;
                default :
                        break;
        }

        return $property;
    }   
        
    /**
     * 根据商品单flag字段转换，易迅网站侧在constant.inc.php中定义
     * @param $flag int
     * @return
     */
    private static function getTradeProperty2($flag) 
    {
        global $UNPTradeProperty51Buy_E;
        $property = $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_NULL'];

        //define('COUPON_PRODUCT', 0X2);
        if ($flag & 0X2) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_COUPON_PRODUCT'];
        }
        //特价商品标志

        //define("OTHER_TIME_LIMITED_RUSHING_BUY", 0x4);
        if ($flag & 0x4) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_OTHER_TIMELIMITED_BUY'];
        }
        //其他抢购类型标识

        //define('CAN_VAT_INVOICE', 0X8);
        if ($flag & 0X8) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CAN_VAT_INVOICE'];
        }
        //是否能开增票

        //define('IS_DEFAULT_INVOICE', 0X10);
        if ($flag & 0X10) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_IS_DEFAULT_INVOICE'];
        }
        //是否默认开票

        //define("TIME_LIMITED_RUSHING_BUY", 0x20);
        if ($flag & 0x20) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_TIMELIMITED_BUY'];
        }
        //显示抢购标志

        //define('FORBID_SET_VIRTUAL', 0x40);
        if ($flag & 0x40) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_FORBID_SET_VIRTUAL'];
        }
        //是否禁止建虚库

        //define('PRODUCT_ENERGY_SUBSIDY', 0x80);
        if ($flag & 0x80) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_ENERGY_SUBSIDY'];
        }
        //节能补贴商品

        //define('CP_YCHF', 0x100);
        if ($flag & 0x100) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————预存话费送手机

        //define('CP_GJRW', 0x200);
        if ($flag & 0x200) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————购机入网送话费

        //define('CP_XHRW', 0x400);
        if ($flag & 0x400) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————选号入网

        //define('CP_GMLJ', 0x800);
        if ($flag & 0x800) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //定制机商品————购买裸机

        //define('PRODUCT_EXTENDED_INSURANCE', 0x1000);
        if ($flag & 0x1000) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_EXTENDED_INSURANCE'];
        }
        //延保商品

        //define('PROMOTION_PRODUCT', 0x2000);
        if ($flag & 0x2000) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_PROMOTION_PRODUCT'];
        }
        //促销商品

        //define('APPOINT_PRODUCT', 0x8000);
        if ($flag & 0x8000) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_APPOINT_PRODUCT'];
        }
        // 预购商品

        return $property;
    } 
        
    /**
     * 获取订单属性,对应原易迅网站端订单flag字段,货票分离订单的设置需要根据易迅网站订单的bits字段进行判断设置；
     * @param $flag int
     * @param $bits int 订单表中bits字段
     * @return
     */
    private static function getDealProperty2($flag, $bits)
    {
        global $UNPDealProperty51Buy_E;
        $property = $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_NULL"];

        //灰度期间订单
        $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_GRAY_RELEASE_DEAL"];

        //订单表中flag字段定义
        //define('ORDER_INSTALLMENT_FLAG', 0X1);
        if ($flag & 0X1) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_PAY_INSTALLMENT"];
        }
        //分期付款订单

        //define('ORDER_HAS_SERVICE', 0X2);
        if ($flag & 0X2) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_SERVICE_PRODUCT"];
        }
        //订单中含有服务商品,需要根据订单是否包含服务商品进行判断    或者   根据网站订单的flag字段判断（ORDER_HAS_SERVICE）

        //define('ORDER_CP', 0X4);
        if ($flag & 0X4) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_CONTRACT_PHONE"];
        }
        //合约机订单

        //define('ORDER_RUSHING_BUY_ONLINE_PAY', 0X8);
        if ($flag & 0X8) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_RUSH_BUY_ONLINE_PAY"];
        }
        // 订单中含有抢购商品且为在线支付

        /*分销商的订单是易金商平台下单的，不会同步到统一后台的
         //define('ORDER_ENTERPRISE_USER', 0X10);
         if ($flag & 0X10) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（企业用户）订单
         //define('ORDER_CHAOHUO_USER', 0X20);
         if ($flag & 0X20) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（炒货商）订单
         //define('ORDER_WHOLESALER_USER', 0X40);
         if ($flag & 0X40) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（批发商）订单
         //define('ORDER_RETAILERS_USER', 0X80);
         if ($flag & 0X80) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //分销商（零售商）订单
         //define('ORDER_FROM_NEW_SH', 0x40000000);
         if ($flag & 0x40000000) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         */

        //define('ORDER_ENERGY_SUBSIDY', 0x100);
        if ($flag & 0x100) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_ENERGY_SUBSIDY"];
        }
        // 节能补贴订单

        //define('ORDER_SHANGQI_USER', 0x200);
        if ($flag & 0x200) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SHANGQI_DEAL"];
        }
        //上汽订单

        //define('ORDER_EXCHANGE_GOODS_FOR_ERP', 0x400);
        if ($flag & 0x400) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_EXCHANGE_GOODS_FOR_ERP"];
        }
        //客服换货订单，前台未使用占住该类型

        //define('ORDER_NONGHANG', 0x1000);
        if ($flag & 0x1000) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_ABCCHINA_SALE"];
        }
        //包含农行活动商品的订单，活动结束后，该字段会去掉

        //订单表中bits字段定义
        //define('ORDER_SEPARATE_GOODS_INVOICE', 0x1);
        if (isset($bits) && (int)$bits == 1) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SEPARATE_GOODS_INVOICE"];
        }
        //货票分离订单，前台未使用占住该类型

        return $property;
    }
        
        
        /**
         * 获取支付方式，将易迅支付方式映射为统一平台的支付方式
         * @param $payType int
         * @return $uniPayType int
         */
        private static function getMappingUniPayType($payType) 
        {
            global $UNPDealPayType_E;
            switch ((int)$payType)
            {
                    case 1 :
                            //货到付款
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_COD'];
                            break;
                    case 3 :
                            //银行电汇
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_BANK_TRANS'];
                            break;
                    case 4 :
                            //邮局汇款
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POST_TRANS'];
                            break;
                    case 5 :
                            //银行划帐  从银行帐号中直接转帐到易迅网指定银行卡上  即时到帐
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                            break;
                    case 6 :
                            //帐期  货到后延期付款
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                            break;
                    default :
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POL'];
                            break;
            }
            return $uniPayType;
        }
        
        
        /**
         * 获取统一平台发票类型
         * @param $type int
         * @return
         */
        private static function getInvoiceType($type)
        {
            if (2 == $type) {//增值税发票
                    //INVOICE_TYPE_VAT = 2
                    return 1;
            }
            else if (4 == $type) {//增值税普通发票
                    // INVOICE_TYPE_VAT_NORMAL = 4
                    return 2;
            }
            else if (8 == $type) {//冠名发票  增值税普通发票,替代发票类型ID为4
                    // INVOICE_TYPE_VAT_NORMAL_NEW = 8
                    return 4;
            }
            else {//商业零售发票(公司)商业零售发票(个人)
                    // 1,3
                    return 3;
            }
        }
        
        /**
         * 获取md5后转换的数字
         * @param $str String
         * @return int
         */
        private static function md5Int($str)
        {
            $md5 = strtolower(md5($str));
            $int = array();
            $int[0] = $md5[0];
            $int[1] = $md5[2];
            $int[2] = $md5[3];
            $int[3] = $md5[5];
            $int[4] = $md5[7];
            $int[5] = $md5[10];
            $int[6] = $md5[13];
            $int[7] = $md5[15];
            $int = array_reverse($int);
            for ($i = 0; $i < count($int); $i++) {
                    $int[$i] = dechex(ord($int[$i]));
            }
            $str = '0x' . implode('', $int);

            return intval($str, 16);
        }
	
	public static function setEventParamsBaseBo($data = array())
        {
            global $UNPSellerAccount51Buy_E;

             $bo = array();

             //必填，从统一用户系统获取用户的uid
             $bo['buyerId'] = isset($data['wgid']) ? $data['wgid'] : 0;

             //合作伙伴id，统一平台易迅的id为855006089
             $bo['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];

             $bo['eventId'] = 0;

             //<uint32_t> 操作者角色(版本>=0) 1：买家，2：卖家，3：系统，4：运营系统，5：支付系统，订单提供的IDL服务
             $bo['operatorRole'] = 1;

             //<std::string> 事件来源，业务必填，请填写调用服务名或文件名(版本>=0)
             $bo['eventSource'] = __FILE__;

             //<std::string> 订单id(版本>=0)
             $bo['dealId'] = isset($data['dealId']) ? $data['dealId'] : 0;

             //<uint64_t> 子单id(版本>=0)
             $bo['tradeId'] = 0;

              //<std::string> 来源ip(版本>=0)
             $bo['clientIp'] = iconv('GBK', 'UTF-8', isset($data['clientIp']) ? $data['clientIp']:'');

             //<std::string> 机器码(版本>=0)
             $bo['machineKey'] = isset($data['machineKey']) ? $data['machineKey'] : '';

             //<std::string> 操作人(版本>=0)
             $bo['operatorName'] = '';

             //<std::string> 保留字段(版本>=0)
             $bo['reserve'] = '';

             //<std::string> 交易单号(版本>=1)
             $bo['bdealId'] = isset($data['bdealId']) ? $data['bdealId'] : '';

             return $bo;
        }

	public function getPackageFeeInfo($sp_id,$product_id,$service_type)
	{
		// 连接到前台的数据库cp_information
		if( false === self::_getDB_s("cp_information", $mysql, __LINE__ ))
		{
			self::$errMsg = ToolUtil::$errMsg;
			return false;
		}
		
		$sql = "select 
			t_cp_package.package_id,
			t_cp_package.package_name,
			t_cp_package.monthly_fee,
			t_cp_package.free_audio_bd_minutes,
			t_cp_package.free_flow,
			t_cp_package.free_mm_message,
			t_cp_package.free_text_message,
			t_cp_package.audio_jbbd_fee,
			t_cp_package.flow_fee,
			t_cp_package.increase_service,
			t_cp_package.others,
			t_cp_fee.predeposit_fee,
			t_cp_fee.phone_price_client,
			t_cp_fee.contract_months, 
			t_cp_fee.monthly_return,
			t_cp_fee.monthly_present
		 from t_cp_package,t_cp_fee 
		 where t_cp_package.package_id=t_cp_fee.package_id 
			and t_cp_package.status=0 
			and t_cp_fee.status=0 
			and t_cp_package.sp_id=".$sp_id." 
			and product_id=".$product_id." 
			and service_type=".$service_type." 
			order by monthly_fee,package_name";
		
		$packageInfo = $mysql->getRows($sql);
		
		if($packageInfo === false )
		{
			self::$errMsg = '获取套餐和返利信息失败, line:'. __LINE__ . ',errMsg:' . $mysql->errMsg;
			return false;
		}
		
		return $packageInfo;
	}
	
	
	/**
	 * 
	 * 通过list_pkgs获取最高预存话费的值(flag=0) or 判断该商品是否是iphone套餐(flag=1)
	 * @param int $list_pkgs
	 * @return int|boolean
	 */
    public static function getMaxYCHF(&$list_pkgs,$flag = 0)
	{
		if(empty($list_pkgs)) return -1;
		$pkg_ids = $fee_pkg_ids = array();
    	foreach ($list_pkgs as $v) {
    	    if (!in_array($v['package_id'], $pkg_ids)) {
    	        //保存手机套餐id
    	        $pkg_ids[] = $v['package_id'];
    	    }
    	    if (!in_array($v['fee_package_id'], $fee_pkg_ids)) {
    	        //保存资费套餐id
    	        $fee_pkg_ids[] = $v['fee_package_id'];
    	    };
    	}
		//拉取展示项目
	    $columns = self::getFeeItems($fee_pkg_ids);
		if(FALSE === $columns) return false;
		$pkg_infos = self::getPackages($pkg_ids);
		if(FALSE === $pkg_infos) return false;
		$sorted_pkg_name_arr = array();
		foreach($pkg_infos as $i_pkg_info) { //套餐名排序
			$sorted_pkg_name_arr[] = $i_pkg_info['package_name'];
		}
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		$new_list_pkgs = array();
		foreach($list_pkgs as $pinfo)
		{
		    //如果手机套餐包不存在，则记录日志，然后跳过此套餐
		    if (!isset($pkg_infos[$pinfo['package_id']])) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //如果手机套餐包状态不可用，则跳过此套餐
		    if ('0' != $pkg_infos[$pinfo['package_id']]['status']) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //如果资费包不存在，则记录日志，然后跳过此套餐
		    if (!isset($columns[$pinfo['fee_package_id']])) {
		        continue;
		    }
			$new_list_pkgs_keys = array_keys($sorted_pkg_name_arr, $pkg_infos[$pinfo['package_id']]['package_name']);
			if(count($new_list_pkgs_keys) > 1) {
			}
			$new_list_pkgs_key = $new_list_pkgs_keys[0];
		    $new_list_pkgs[$new_list_pkgs_key] = $pinfo;
		}
		ksort($new_list_pkgs, SORT_NUMERIC);
		$new_list_pkgs = array_values($new_list_pkgs);
		//Logger::info($new_list_pkgs);
		//返回最大值
		if($flag == 0)
		{
			$arr = array();
			foreach($new_list_pkgs as $pinfo)
			{
				$pkg_column     = $columns[$pinfo['fee_package_id']];
				ksort($pkg_column);
				$arr[] = $pkg_column[3]['item_value'];
			}
			//Logger::info($arr);
			sort($arr,SORT_NUMERIC);
			//Logger::info($arr);
			if(empty($arr)) return -1;
			else return $arr[count($arr)-1];
		}//判断iphone商品
		else if($flag == 1)
		{
			$found = false;
			$arr = array(0,0);
			foreach($new_list_pkgs as $pinfo)
			{
				$brand = $pkg_infos[$pinfo['package_id']]['brand_2nd_id'];
				$pkg_column = $columns[$pinfo['fee_package_id']];
				ksort($pkg_column);
				if(isset($pkg_column[8]['item_value']) && intval($pkg_column[8]['item_value']) != 0) $arr[1] = 1;
				if($brand == 11)  $found = true;
			}
			if($found) { $arr[0] = 1; return $arr;}
			else return $arr;
		}
	}
	
	
	/**
	 * 
	 * 通过list_pkgs获取最高赠送话费的值
	 * @param int $list_pkgs
	 * @return int|boolean
	 */
	public static function getMaxZSHF(&$list_pkgs,$flag = 0)
	{
		if(empty($list_pkgs)) return -1;
		$index = 0;
		$pkg_ids = $fee_pkg_ids = array();
    	foreach ($list_pkgs as $v) {
    	    if (!in_array($v['package_id'], $pkg_ids)) {
    	        //保存手机套餐id
    	        $pkg_ids[] = $v['package_id'];
    	    }
    	    if (!in_array($v['fee_package_id'], $fee_pkg_ids)) {
    	        //保存资费套餐id
    	        $fee_pkg_ids[] = $v['fee_package_id'];
    	    };
    	}
		//拉取展示项目
	    $columns = self::getFeeItems($fee_pkg_ids);
		if(FALSE === $columns) return false;
		$pkg_infos = self::getPackages($pkg_ids);
		if(FALSE === $pkg_infos) return false;
		$sorted_pkg_name_arr = array();
		foreach($pkg_infos as $i_pkg_info) { //套餐名排序
			$sorted_pkg_name_arr[] = $i_pkg_info['package_name'];
		}
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		$new_list_pkgs = array();
		foreach($list_pkgs as $pinfo)
		{
		    //如果手机套餐包不存在，则记录日志，然后跳过此套餐
		    if (!isset($pkg_infos[$pinfo['package_id']])) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //如果手机套餐包状态不可用，则跳过此套餐
		    if ('0' != $pkg_infos[$pinfo['package_id']]['status']) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //如果资费包不存在，则记录日志，然后跳过此套餐
		    if (!isset($columns[$pinfo['fee_package_id']])) {
		        continue;
		    }
			$new_list_pkgs_keys = array_keys($sorted_pkg_name_arr, $pkg_infos[$pinfo['package_id']]['package_name']);
			if(count($new_list_pkgs_keys) > 1) {
			}
			$new_list_pkgs_key = $new_list_pkgs_keys[0];
		    $new_list_pkgs[$new_list_pkgs_key] = $pinfo;
		}
		ksort($new_list_pkgs, SORT_NUMERIC);
		$new_list_pkgs = array_values($new_list_pkgs);
		if($flag == 0)  $index = 7; 
		else if($flag == 1) $index = 8;
		$arr = array();
		foreach($new_list_pkgs as $pinfo)
		{
			$pkg_column     = $columns[$pinfo['fee_package_id']];
			ksort($pkg_column);
			$arr[] = $pkg_column[$index]['item_value'];
		}
		sort($arr,SORT_NUMERIC);
		if(empty($arr)) return -1;
		else return $arr[count($arr)-1];
	}
	
	
	/**
	 * 
	 * 通过list_pkgs获取最低购机款
	 * @param $list_pkgs
	 * @return int|boolean
	 */
	public static function getMinBuyPrice(&$list_pkgs)
	{
		if(empty($list_pkgs)) return -1;
		$pkg_ids = $fee_pkg_ids = array();
    	foreach ($list_pkgs as $v) {
    	    if (!in_array($v['package_id'], $pkg_ids)) {
    	        //保存手机套餐id
    	        $pkg_ids[] = $v['package_id'];
    	    }
    	    if (!in_array($v['fee_package_id'], $fee_pkg_ids)) {
    	        //保存资费套餐id
    	        $fee_pkg_ids[] = $v['fee_package_id'];
    	    };
    	}
		Logger::info($list_pkgs);
		//拉取展示项目
	    $columns = self::getFeeItems($fee_pkg_ids);
		if(FALSE === $columns) return false;
		$pkg_infos = self::getPackages($pkg_ids);
		if(FALSE === $pkg_infos) return false;
		$sorted_pkg_name_arr = array();
		foreach($pkg_infos as $i_pkg_info) { //套餐名排序
			$sorted_pkg_name_arr[] = $i_pkg_info['package_name'];
		}
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		$new_list_pkgs = array();
		foreach($list_pkgs as $pinfo)
		{
		    //如果手机套餐包不存在，则记录日志，然后跳过此套餐
		    if (!isset($pkg_infos[$pinfo['package_id']])) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //如果手机套餐包状态不可用，则跳过此套餐
		    if ('0' != $pkg_infos[$pinfo['package_id']]['status']) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //如果资费包不存在，则记录日志，然后跳过此套餐
		    if (!isset($columns[$pinfo['fee_package_id']])) {
		        continue;
		    }
			$new_list_pkgs_keys = array_keys($sorted_pkg_name_arr, $pkg_infos[$pinfo['package_id']]['package_name']);
			if(count($new_list_pkgs_keys) > 1) {
			}
			$new_list_pkgs_key = $new_list_pkgs_keys[0];
		    $new_list_pkgs[$new_list_pkgs_key] = $pinfo;
		}
		ksort($new_list_pkgs, SORT_NUMERIC);
		$new_list_pkgs = array_values($new_list_pkgs);
		
		Logger::info($new_list_pkgs);
		//返回最小值
		$arr = array();
		foreach($new_list_pkgs as $pinfo)
		{
			$pkg_column     = $columns[$pinfo['fee_package_id']];
			Logger::info($pkg_column);
			ksort($pkg_column);
			$arr[] = $pkg_column[4]['item_value'];
		}
		Logger::info($arr);
		sort($arr,SORT_NUMERIC);
		Logger::info($arr);
		if(empty($arr)) return -1;
		else return $arr[0];
	}
	
	/**
	 * 
	 * 通过product_id获取资费包信息
	 * @param int $product_id
	 * @param array $conditions
	 * @return boolen|array
	 */
    public static function getPackageFees($product_id, $conditions = array())
	{
		$fees = ICpContractFeeTTC::get($product_id, $conditions);
		if($fees === false ) {
		exd_Attr_API2(634517, 1);
			self::$errMsg = 'get fee package failed, line:'. __LINE__ . ',errMsg:' . ICpContractFeeTTC::$errMsg;
			return false;
		}
		return $fees;
	}
	
	/**
	 * 
	 * 通过product_id和fee_id等条件获取唯一的一个资费包信息
	 * @param int $product_id     产品ID
	 * @param int $fee_id         资费项目ID
	 * @param int $wh_id          站点ID
	 * @return boolen|array
	 */
    public static function getPackageOneFee($product_id, $fee_id, $wh_id)
	{
	    global $_CP_Item_Id;
		$rows = ICpContractFeeTTC::get($product_id, array('fee_id' => $fee_id, 'wh_id' => $wh_id));
		if($rows === false ) {
		exd_Attr_API2(634517, 1);
			self::$errMsg = 'get fee package failed, line:'. __LINE__ . ',errMsg:' . ICpContractFeeTTC::$errMsg;
			return false;
		}
	    if( !$rows ) {
			exd_Attr_API2(634517, 1);
			self::$errMsg = 'get fee package failed, line:'. __LINE__ . ',errMsg: fee package is empty';
			return false;
		}
     
		$fee = current($rows);
                
		$item = self::getFeeItem($fee['fee_package_id']);
  
	    if($item === false ) {
			exd_Attr_API2(634518, 1);
			return false;
		}
		$mid = $fee['mode_id'];
		$item_ranks = $_CP_Item_Id[$mid];
		//此处将一条资费包对应的资费项目，按照合约机一期的方式，附在资费包上。以便修改和维护
		if (isset($item[$item_ranks['monthly_return']])) {
		    $fee['monthly_return']  = $item[$item_ranks['monthly_return']]['item_value'];
		}
	    if (isset($item[$item_ranks['contract_months']])) {
		    $fee['contract_months']  = $item[$item_ranks['contract_months']]['item_value'];
		}
               
		if (isset($item[$item_ranks['gift_fee']])) {
		    $fee['gift_fee']  = $item[$item_ranks['gift_fee']]['item_value'];
		} 
		if (isset($item[$item_ranks['package_rwjf']])) {
		    $fee['package_rwjf']  = $item[$item_ranks['package_rwjf']]['item_value'];
		}
	    if (isset($item[$item_ranks['predeposit_fee']])) {

		    $fee['predeposit_fee']  = $item[$item_ranks['predeposit_fee']]['item_value'];
		}
	    if (isset($item_ranks['order_fee']) && isset($item[$item_ranks['order_fee']])) {
		    $fee['order_fee']  = $item[$item_ranks['order_fee']]['item_value'];
		}
	    if (isset($item_ranks['phone_price_fee']) && isset($item[$item_ranks['phone_price_fee']])) {
		    $fee['phone_price_fee']  = $item[$item_ranks['phone_price_fee']]['item_value'];
		}
		if (isset($item_ranks['iphone_gift_fee']) && isset($item[$item_ranks['iphone_gift_fee']])) {
		    $fee['iphone_gift_fee']  = $item[$item_ranks['iphone_gift_fee']]['item_value'];
		}
		
		return $fee;
	}

	/**
	 * 
	 * 根据若干资费包id获取他们对应的资费项目
	 * @param array $package_ids
	 * @return boolen|array
	 */
	public static function getFeeItems($package_ids) {
	    $rows = ICpFeeItemTTC::gets($package_ids);
	    if($rows === false )
		{
			exd_Attr_API2(634518, 1);
			self::$errMsg = 'get fee items failed, line:'. __LINE__ . ',errMsg:' . ICpFeeItemTTC::$errMsg;
			return false;
		}
		$fees = array();
		foreach ($rows as $v) {
		    if (!isset($fees[$v['fee_package_id']])) {
		        $fees[$v['fee_package_id']] = array();
		    }
		    $fees[$v['fee_package_id']][$v['rank']] = $v;
		}
		return $fees;
	}
	
	/**
	 * 
	 * 根据唯一的资费包ID获取对应的资费项目
	 * @param int $fee_pkg_id
	 * @return boolen|array
	 */
    public static function getFeeItem($fee_pkg_id)
	{
		$rows = ICpFeeItemTTC::get($fee_pkg_id);
		if( $rows === false ) {
			self::$errMsg = 'get fee package item failed, line:'. __LINE__ . ',errMsg:' . ICpFeeItemTTC::$errMsg;
			return false;
		}
	    if( !$rows ) {
			self::$errMsg = 'fee package item is empty, line:'. __LINE__;
			return false;
		}
		$items = array();
		foreach ($rows as $v) {
		    $items[$v['rank']] = $v;
		}
		return $items;
	}
	
    public static function getPackages($package_ids)
	{
		$ret = self::_getDB_s("cp_information", $mysql, __LINE__);
		if( false === $ret )
		{
			exd_Attr_API2(634519,1);
			$msg = "getLocations Error, line".ToolUtil::$errMsg."\n";
			// echo ($msg);
			return false;
		}
		$sql = "select * from t_cp_package 
			where 
			package_id in (" . implode(',', $package_ids) . ")
			order by monthly_fee, package_name";
		
		$rows = self::_select_s($mysql, $sql, __LINE__);
		if($rows === false)
		{
			exd_Attr_API2(634519,1);
			self::$errMsg = ToolUtil::$errMsg;
			return false;
		}
		$packageinfo = array();
		foreach($rows as $v)
		{
			$packageinfo[$v['package_id']] = $v;
		}
		return $packageinfo;
	}
	
	public function getOnePackageFeeInfo($package_id,$product_id,$service_type)
	{
		// 连接到前台的数据库cp_information
		if( false === self::_getDB_s("cp_information", $mysql, __LINE__ ))
		{
			self::$errMsg = ToolUtil::$errMsg;
			return false;
		}
		
		$sql = "select 
			t_cp_package.package_id,
			t_cp_package.package_name,
			t_cp_package.monthly_fee,
			t_cp_package.free_audio_bd_minutes,
			t_cp_package.free_flow,
			t_cp_package.free_mm_message,
			t_cp_package.free_text_message,
			t_cp_package.audio_jbbd_fee,
			t_cp_package.flow_fee,
			t_cp_package.increase_service,
			t_cp_package.others,
			t_cp_fee.predeposit_fee,
			t_cp_fee.phone_price_client,
			t_cp_fee.contract_months, 
			t_cp_fee.monthly_return,
			t_cp_fee.monthly_present
		 from t_cp_package,t_cp_fee 
		 where t_cp_package.package_id=t_cp_fee.package_id 
			and t_cp_fee.package_id=".$package_id." 
			and product_id=".$product_id." 
			and service_type=".$service_type;
		
		// and t_cp_package.status=0 
		// and t_cp_fee.status=0  
		
		$packageInfo = $mysql->getRows($sql);		
		if($packageInfo === false )
		{
			self::$errMsg = '获取套餐和返利信息失败, line:'. __LINE__ . ',errMsg:' . $mysql->errMsg;
			return false;
		}
		
		return $packageInfo;
	}
	
	/* 	
		@desc 获得定制机支持的销售类型
		@param  : 
		@param  : 
		@param  : 
	*/
	public function getServiceType($pid)
	{
		if( empty($pid) || !isset($pid) )
		{
			self::$errMsg = "getServiceType pid Error";
			return false;
		}
		
		$msdb = ToolUtil::getMSDBObj('SH_IAS');
		$sql = "select * from Product_SaleMode where ProductSysNo=".$pid;
		
		$ret = $msdb->getRows($sql);
		if( false === $ret )
		{
			self::$errMsg = $msdb->errMsg;
			return false;
		}
		
		if( count($ret) == 0 )
		{
			self::$errMsg = "该产品不属于定制机范畴";
			return false;
		}
		
		$type = $ret[0]['SaleModeSysNo'];
		return $type;
	}
	
	
	/*
	* 获取一个id号码已经注册协议的个数
	*/
	public static function getIDRegCount($idcard)
	{
		// 调用之前请检查 $idcard 号码的合法性，此处不做检查
		// 根据订单号找到合约中的号码
		$contractDb = ToolUtil::getMSDBObj('ICSON_CORE');
		if($contractDb === false)
		{
			self::$errMsg = "getMSDBObj Error, line". __LINE__ . "," .self::$errMsg."\n";
			return 100;
		}
		
		$sql = "select count(*) from t_cp_contract_info where idcard_num='".$idcard."'";
		$idcount = $contractDb->getRows($sql);
		if( $idcount === false )
		{
			self::$errMsg = "getMSDBObj Error, line". __LINE__ . "," .$contractDb->errMsg."\n";
			return 100;
		}
		return $idcount[0]['computed'];
	}
	
	
	/*
		判断是否是定制机商品，目前只需要一个flag标记位，
		为防止以后的扩展，采用传入数组的方式
		return : 定制机的类型
	*/
	public static function isCustomPhoneProduct(&$product)
	{
	
		if( !isset($product['flag']) )
		{
			self::$errMsg = "no flag!";
			return false;		
		}
		// 定制机商品
		if( ($product['flag'] & CP_GJRW ) == CP_GJRW )
		{
			return CP_GJRW;
		}
		else if( ($product['flag'] & CP_YCHF ) == CP_YCHF )
		{
			return CP_YCHF;
		}
		else if( ($product['flag'] & CP_XHRW ) == CP_XHRW ) {
			return CP_XHRW;
		}
		self::$errMsg = "flag error!".$product['flag'];
		return false;
	}
	
	/*
		判断是否是定制机订单，目前只需要一个flag标记位，
		为防止以后的扩展，采用传入数组的方式
	*/
	public static function isCustomPhoneOrder(&$order)
	{
	
		if( !isset($order['flag']) )
			return false;

		// 定制机订单
		if( ($order['flag'] & ORDER_CP ) == ORDER_CP )
		{
			return true;
		}
		return false;
	}
	
	/*
		判断是否是定制机的手机卡，目前只需要一个flag标记位，
		为防止以后的扩展，采用传入数组的方式
	*/
	public static function isCustomPhoneCard(&$product)
	{	
		// 定制机手机卡
		global $_CP_Sp_Data;
		
		foreach($_CP_Sp_Data as $sp)
		{
			if( $product['product_id'] == $sp['CardID']  )
			{
				return true;
			}
		}
		return false;
	}
	
	
	public static function isCustomPhoneProductByPid($product_id)
	{	
		if( !is_numeric($product_id) )
		{
			self::$errMsg = $product_id." is not integer!";
			return false;		
		}
		
		$wh_id = IUser::getSiteId();
		$baseInfo = IProduct::getBaseInfo($product_id,$wh_id,true);
		if($baseInfo === false )
		{
			self::$errMsg = 'isCustomPhoneProductByPid getBaseInfo failed, line:'. __LINE__ . ',errMsg:'.IProduct::$errMsg."\n";
			return false;
		}

		// 定制机商品
		return self::isCustomPhoneProduct($baseInfo);
	}

	public static function getShippingType($district, $orderPrice, $isvirtual_array, $weight_array, $wh_id, $psystock,$contractinfo) {
		global $_District, $_LGT_MODE, $_SelfFetchProductids;
		$product_id = $contractinfo['product_id'];
		$sp_id = $contractinfo['sp_id'];
		//$CardID = $_CP_Sp_Data[$sp_id]['CardID'];
		$CardID = $contractinfo['card_id'];
		$shippingTypeRet = IPreOrder::getShippingTypeByDestination($district, $orderPrice, $isvirtual_array, $weight_array, $wh_id);
		if($shippingTypeRet === false) {
			self::$errCode = 6004;
			self::$errMsg = "不支持的地址($district)，返回空数组,errMsg:" . IPreOrder::$errMsg;
			return false;
		}
		$forbidList = array();
		//获取商品限运配置
		if($product_id != $CardID) {
			$products = array($product_id, $CardID);
		}
		else { //选号入网
			$products = array($CardID);
		}
		$rets = IProductInfoTTC::gets($products, array('wh_id'=>$wh_id));
		if($rets === false) {
			self::$errCode = 6001;
			self::$errMsg = 'IProductInfoTTC get error|' . IProductInfoTTC::$errCode . '|' .IProductInfoTTC::$errMsg;
			return false;
		}
		if(empty($rets)) {
			self::$errCode = 6002;
			self::$errMsg = 'get product info empty,product_id:' . $product_id;
			return false;	
		}
		foreach($rets as $ret) {
			if($ret['restricted_trans_type'] > 0) {
				$forbidList[$ret['restricted_trans_type']][] = $ret['product_id'];
			}
		}
		// 限运逻辑检查
		$shipNotAvailable = array();
		if (!empty($forbidList)) {
			$shipNotAvailable = IShipping::getForbidenShippingType($forbidList, $_District[$district]['province_id'], $_District[$district]['city_id'], $district, $wh_id);
		}
		foreach($shippingTypeRet as $key => $shipping) {
			if(isset($shipNotAvailable[$key])) {
				unset($shippingTypeRet[$key]);
			}
		}

		//剔除自提
		$bothExist = array_intersect($_SelfFetchProductids, $products);
		if (count($bothExist) == 0) {
			foreach ($shippingTypeRet as $key => $it) {
				if (false === strpos($it['ShipTypeName'], '上门提货')) {
					continue;
				}
				unset($shippingTypeRet[$key]);
			}
		}

		if(count($shippingTypeRet) == 0) {
			Logger::info('shippingTypeRet empty,shipNotAvailable:' . var_export($shipNotAvailable, true));
		}
		//Logger::info(var_export($shippingTypeRet, true));
		$shippingType = array();
		foreach($shippingTypeRet as $key => $oneShippingType ) {
			$sp_type = $_LGT_MODE[$oneShippingType['ShippingId']];
			$icson_delivery_info['delivery_time'] = 1;
			$icson_delivery_info['stock_num'] = $psystock;
			$icson_delivery_info['shipping_id'] = $oneShippingType['ShippingId'];
			$shippingtime = IShippingTime::get($icson_delivery_info, $wh_id, $district, false);
			foreach($shippingtime as $shipKey => $shipTime) {
				if($shipTime['status'] != 0) {
					unset($shippingtime[$shipKey]);
				}
			}
			$shippingType[$sp_type['SysNo']]['ShippingId'] = $sp_type['SysNo'];
			$shippingType[$sp_type['SysNo']]['ShipTypeName'] = $sp_type['ShipTypeName'];
			$shippingType[$sp_type['SysNo']]['PremiumRate'] = $sp_type['PremiumRate'];
			$shippingType[$sp_type['SysNo']]['PremiumBase'] = $sp_type['PremiumBase'];
			$shippingType[$sp_type['SysNo']]['FreeShipBase'] = $sp_type['FreeShipBase'];
			$shippingType[$sp_type['SysNo']]['StatusQueryUrl'] = $sp_type['StatusQueryUrl'];
			$shippingType[$sp_type['SysNo']]['ShipTypeDesc'] = "现仅支持上海/广东/北京站快递覆盖区域。<a target='_blank' href='http://st.51buy.com/help/3-1-icson_delivery.htm'><span class='strong'>详情请查看配送说明中的上海/广东/北京站部分</span></a>";
			$shippingType[$sp_type['SysNo']]['Period'] = "上海市区订单确定后的第一个工作日，其他地区多一个工作日";
			$shippingType[$sp_type['SysNo']]['shippingPrice'] = 0;
			$shippingType[$sp_type['SysNo']]['shippingPriceCut'] = 0;
			$shippingType[$oneShippingType['ShippingId']]['subOrder'][$psystock]['timeAvaiable'] = $shippingtime;
		}
		return array('shippingType' => $shippingType , 'forbidden' => $forbidList); 
	}
}