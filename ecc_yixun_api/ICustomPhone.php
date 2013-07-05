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
                    'sceneId' => 0, //����id��������Ĭ����0����
                    'machineKey' => isset($_COOKIE['visitkey']) ? $_COOKIE['visitkey'] : '',
                    'icsonUid' => $uid, //��Ѹ�û�id��Ŀǰ��֧��32λ
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
        
	//���˫д S zaleli
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
	//�����
	private function _setLockInventory($inventroyAllDatas,$uid)
	{
		Logger::info("_setLockInventory Start! inventroyAllDatas:".ToolUtil::gbJsonEncode($inventroyAllDatas)." uid:".$uid);
		$uid = intval($uid);
		if ($uid == 0)
		{
			//��ӡ��־���澯
			Logger::err("uid==0");
			return false;
		}
		foreach ($inventroyAllDatas as $inventroyData)
		{
			$inputPara = self::_parameterFactory($uid, 1, $inventroyData);
			$result = WebStubCntl2::request('b2b2c\skuorder\ao\LockProduct',
				array( 
					'opt'=>array(
						'uin' => $uid,//ʹ��Mod+L5��ʽ����·�ɣ�һ����д�û�QQ����ӦsetDwUin��
						'operator' => $uid,//������ID��һ����д�û�QQ����ӦsetDwOperatorId��
						'caller' => 'customphone',//���÷����֣�����ģ��(��ӦsetCallerName)
						'timeout' => 1,//��ʱʱ�䣬����Ϊ��λ����������¿��Ե���
					),
					'req'=>array(
						'machineKey' => __FILE__,
						'source' => __FILE__,
						'sceneId' => 10011,//��Լ�����ó���
						'optionId' => 0,
						'lockType' => 0,//�ǻ���������0
						'fixupInfoPo' => $inputPara['fixupInfoPo'],//��������
						'eventPo' => $inputPara['event4AppPo'],//����
						'inReserve' => ''
					)
				)
			);
			if ($result['code']!=0 || $result['data']['result']!=0)
			{
				//��ӡ��־���澯
				Logger::err("LockProduct Request Err,code:".$result['code']." errmsg:".$result['msg']." result:".$result['data']['result']);
				exd_Attr_API2(635069, 1);
				return false;
			}
		}
		Logger::info("_setLockInventory Finish! uid:".$uid);
		return true;
	}
	//�������
	private function _setUnLockInventory($inventroyAllDatas,$uid)
	{
		Logger::info("_setUnLockInventory Start! inventroyAllDatas:".ToolUtil::gbJsonEncode($inventroyAllDatas)." uid:".$uid);
		$uid = intval($uid);
		if ($uid == 0)
		{
			//��ӡ��־���澯
			Logger::err("uid==0");
			return false;
		}
		foreach ($inventroyAllDatas as $inventroyData)
		{
			$inputPara = self::_parameterFactory($uid, 2, $inventroyData);
			$result = WebStubCntl2::request('b2b2c\skuorder\ao\UnlockProduct',
				array( 
					'opt'=>array(
						'uin' => $uid,//ʹ��Mod+L5��ʽ����·�ɣ�һ����д�û�QQ����ӦsetDwUin��
						'operator' => $uid,//������ID��һ����д�û�QQ����ӦsetDwOperatorId��
						'caller' => 'customphone',//���÷����֣�����ģ��(��ӦsetCallerName)
						'timeout' => 1,//��ʱʱ�䣬����Ϊ��λ����������¿��Ե���
					),
					'req'=>array(
						'machineKey' => __FILE__,
						'source' => __FILE__,
						'sceneId' => 10011,//��Լ�����ó���
						'optionId' => 0,
						'fixupInfoPo' => $inputPara['fixupInfoPo'],//��������
						'eventPo' => $inputPara['event4AppPo'],//����
						'inReserve' => ''
					)
				)
			);
			if ($result['code']!=0 || $result['data']['result']!=0)
			{
				//��ӡ��־���澯
				exd_Attr_API2(635070, 1);
				Logger::err("UnlockProduct Request Err,code:".$result['code']." errmsg:".$result['msg']." result:".$result['data']['result']);
				return false;
			}
		}
		Logger::info("_setUnLockInventory Finish! uid:".$uid);
		return true;
	}
	//���˫д E zaleli
	//�������2.0 S zaleli
		/**
		 * ����ȷ��ҳ�����ɶ�������������֤�ӿ�
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
			//��ӡ��־���澯
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
		$spsItem['itemNum'] = 1;//��Լ��Ĭ��ֻ��һ��
		$spsItem['pkgId'] = 0;//���ײ���Ʒ
		$spsItem['itemType'] = 0;//��ͨ��Ʒ
		$arrSpsItemListIn[] = $spsItem;
		$result = WebStubCntl2::request('icson\promotion\ao\schedule\CheckPromotionInfo',
			array( 
				'opt'=>array(
					'uin' => $uid,//ʹ��Mod+L5��ʽ����·�ɣ�һ����д�û�QQ����ӦsetDwUin��
					'operator' => $uid,//������ID��һ����д�û�QQ����ӦsetDwOperatorId��
					'caller' => 'customphone',//���÷����֣�����ģ��(��ӦsetCallerName)
					'timeout' => 1,//��ʱʱ�䣬����Ϊ��λ����������¿��Ե���
				),
				'req'=>array(
					'uin' => $uid,
					'source' => __FILE__,
					'scene' => 1,//��ͨ���ﳵ����
					'itemClassNum' => 1,//��Լ��Ĭ��ֻ��һ��
					'itemNum' => 1,//��Լ��Ĭ��ֻ��һ��
					'whId' => $whId,//��վID
					'regionId' => 0,
					'channelId' => '',
					'rulelId' => array(),//����IDһ��Ϊ�գ���������
					'spsItemListIn' => $arrSpsItemListIn,
					'inReserve' => '',
					'extent' => array()
				)
			)
		);
		if ($result['code']!=0 || $result['data']['result']!=0)
		{
			//��ӡ��־���澯
			exd_Attr_API2(635068, 1);
			Logger::err("CheckPromotionInfo error, code:" . $result['code'] . " result:" . $result['data']['result'] . " msg:".$result['msg']);
			return false;
		}
		if (count($result['data']['spsItemListOut']) != 1)
		{
			//��ӡ��־���澯
			exd_Attr_API2(635068, 1);
			Logger::err("_checkRuleForOrder err! spsItemListOut size:".count($result['data']['spsItemListOut']));
			return false;
		}
		$promotion = array();
		$priceInfo = array();
		//��ȡ�����Ϣ
		foreach($result['data']['spsItemListOut'] as $spsItem)
		{
			$priceInfo['itemId'] = $spsItem['itemId'];
			if (count($spsItem['priceInfoList']) != 1)
			{
				//��ӡ��־���澯
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
		//���ض����Ϣ
		$promotion['item'] = $priceInfo;
		//�����޹���Ϣ�����ڿۼ���Ч�����������Ч����
		$promotion['restrict'] = $result['data']['restrictParamList'];
		Logger::info("_checkRuleForOrder finish. promotion:".ToolUtil::gbJsonEncode($promotion)." whId:".$whId." chId:".$chId." uid:".$uid." ruleId:".$ruleId." type:".$type);
		return $promotion;
	}
	//Ϊproduct_base_info���Ӷ����Ϣ
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
				//������Ʒ�����ʶ��
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
	//�ۼ�������Ч����
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
					'uin' => $uid,//ʹ��Mod+L5��ʽ����·�ɣ�һ����д�û�QQ����ӦsetDwUin��
					'operator' => $uid,//������ID��һ����д�û�QQ����ӦsetDwOperatorId��
					'caller' => 'customphone',//���÷����֣�����ģ��(��ӦsetCallerName)
					'timeout' => 1,//��ʱʱ�䣬����Ϊ��λ����������¿��Ե���
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
			//��ӡ��־���澯
			exd_Attr_API2(635066, 1);
			Logger::err("GetDealBatchPromotionRestrict error, code:" . $result['code'] . " result:" . $result['data']['result'] . " msg:".$result['msg']);
			return false;
		}
		Logger::info("_dealPromotionRestrict SUCCESS.restrictParamListOut:".ToolUtil::gbJsonEncode($result['data']['restrictParamListOut'])." isRestrict:".$isRestrict." uid:".$uid);
		return $result['data']['restrictParamListOut'];
	}
	//���˹�����Ч����
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
					'uin' => $uid,//ʹ��Mod+L5��ʽ����·�ɣ�һ����д�û�QQ����ӦsetDwUin��
					'operator' => $uid,//������ID��һ����д�û�QQ����ӦsetDwOperatorId��
					'caller' => 'customphone',//���÷����֣�����ģ��(��ӦsetCallerName)
					'timeout' => 1,//��ʱʱ�䣬����Ϊ��λ����������¿��Ե���
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
			//��ӡ��־���澯
			exd_Attr_API2(635067, 1);
			Logger::err("RollbackDealBatchPromotionRestrict error, code:" . $result['code'] . " result:" . $result['data']['result'] . " msg:".$result['msg']);
			return false;
		}
		Logger::info("_rollbackPromotionRestrict SUCCESS.restrictParamListOut:".ToolUtil::gbJsonEncode($result['data']['restrictParamListOut'])." uid:".$uid);
		return $result['data']['restrictParamListOut'];
	}
	//�����ۼ�����2.0��Ч����
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
				//��¼��Ҫ���˵���Ч��������
				$arrLockPromotionRestrict[] = $lockRestrict;
			}
			else if ( false === $lockRestrict )
			{
				//��ӡ������־
				Logger::err("_batchDealPromotionRestrict err restrict:".ToolUtil::gbJsonEncode($restrict)." uid:".$uid);
				return false;
			}
		}
		return $arrLockPromotionRestrict;
	}
	//�������˴���2.0��Ч����
	private function _batchRollbackPromotionRestrict($arrLockPromotionRestrict, $uid)
	{
		Logger::info("_batchRollbackPromotionRestrict start! arrLockPromotionRestrict:".ToolUtil::gbJsonEncode($arrLockPromotionRestrict)." uid:".$uid);
		foreach($arrLockPromotionRestrict as $lockRestrict)
		{
			$rollbackRestrict = self::_rollbackPromotionRestrict($lockRestrict, $uid);
			if (false === $rollbackRestrict)
			{
				//��ӡ������־
				Logger::err("_rollbackPromotionRestrict error lockRestrict:".ToolUtil::gbJsonEncode($lockRestrict)." uid:".$uid);
			}
		}
		Logger::info("_batchRollbackPromotionRestrict finish! uid:".$uid);
		return ;
	}
	//�������2.0 E zaleli
	//����ͳһ��� S zaleli
	//���ݲ�ID��OMS���
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
					'uin' => $uid,//ʹ��Mod+L5��ʽ����·�ɣ�һ����д�û�QQ����ӦsetDwUin��
					'operator' => $uid,//������ID��һ����д�û�QQ����ӦsetDwOperatorId��
					'caller' => 'customphone',//���÷����֣�����ģ��(��ӦsetCallerName)
					'timeout' => 1,//��ʱʱ�䣬����Ϊ��λ����������¿��Ե���
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
			//��ӡ��־���澯
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
	//����ͳһ��� E zaleli
	/* 	
		@desc ������Ӫ���б������ǵĹ����أ�ȥ���ظ��ģ����ڵ��û�ѡ���ѡ��
		@param splist :  ��Ӫ���б�
		@param  : 
		@param  Locations : array()
	*/
	public static function getLocations(&$splist, &$locations)
	{
		$locations = array("�Ϻ�" => array("�Ϻ�"));
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
		@desc ����Ӫ�̺ͺŶλ�ú����б�
		@param  seg : �Ŷ� 
		@param  numlist:  ���صĺ����б�
		@param  sp: ��Ӫ��id
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
		@desc ����Ӫ�̺ͺŶλ�ú����б�
		@param  seg : �Ŷ� 
		@param  numlist:  ���صĺ����б�
		@param  sp: ��Ӫ��id
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
		@desc ����Ӫ�̺ͺŶλ�ú����б�
		@param  seg : �Ŷ� 
		@param  numlist:  ���صĺ����б�
		@param  sp: ��Ӫ��id
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
		@desc ����Ӫ�̺ͺŶλ�ú����б�
		@param  seg : �Ŷ� 
		@param  numlist:  ���صĺ����б�
		@param  sp: ��Ӫ��id
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
		@desc ��������
	*/
	public static function unlockNum($num)
	{
		// ������(Locked)�ĺ�������Ϊ����״̬(Normal)
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
		@desc �黹����
	*/
	public static function returnNum($num)
	{
		// �Ѳ�����(NA)�ĺ�������Ϊ����״̬(Normal)
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
		@desc ��������		
		@param newNum : Ҫ�������º���	
		@param oldNum : Ҫ�������Ϻ���
	*/
	public static function lockNum($newNum,$oldNum = -1)
	{
		// �Ϻ�����º�����ֱͬ������
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
		
		// ����֮ǰ�ȼ���º����״̬���Ƿ��Ѿ��ȱ���������
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
			self::$errMsg = "�º����Ѿ��������򱻹���";
			return false;
		}
		
		$now = time();
		// �����º���
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
		
		// ���update����û��Ӱ���κ�һ�У����ش���
		if( 0 == $mysql->getAffectedRows() )
		{
			exd_Attr_API2(634516, 1);
			self::$errMsg = "�º����Ѿ��������򱻹���";
			self::_transaction( $mysql, "rollback", __LINE__ );
			return false;
		}
		
		
		// �����Ϻ���
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
		@desc ����ײ���Ϣ
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
		@desc ����ʷ���Ϣ
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
		// �ȸ�����Ʒ��÷����ʷѣ�һ����Ʒֻ֧��һ����Ӫ�̣������֪������Ʒ����ͨ���ǵ��Ŷ��ƻ�
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
			self::$errMsg = "����Ʒû���ײͺͷ����ʷ�";
			return false;
		}
			
		// ��������֧�ֵ���Ӫ��
		$sp_ids = array();
	
		foreach($feeinfo as $it)
		{
			// ��������ڣ������
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
		return array('errCode'=>10, 'errMsg'=>"��ѡ�����Ʒֻ֧��ʹ����Ѹ��ݣ�������ѡ��");
	}
	
	public static function checkInvoice(&$newOrder)
	{
		$newOrder['isVat'] = isset($newOrder['isVat']) ? $newOrder['isVat'] : 1;
		if(0 == $newOrder['isVat']) //�������Ҫ����Ʊ��������֤��Ʊ
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
		//��ҵ���۷�Ʊ
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
		@desc �û��µ������ƻ�
		@param  : 
		@param  : 
		@param  : 
	*/
	public static function order(&$newOrder, $wh_id, $checkAddr = true,$chid = 0)
	{
		//�����ջ���ַ
		if ($checkAddr && false === ICustomPhone::checkReceiverAddr($newOrder['receiveAddrId'], $wh_id))
		{
			return array('errCode' => 100, 'errMsg' => "�ջ��ַ����ȷ");
		}
		//Logger::err("����ַ");	
		//������ͷ�ʽ
		if (false === ICustomPhone::checkShippingType($newOrder['shipType'], $wh_id)) 
		{
			self::$errCode = IOrder::$errCode;
			self::$errMsg = IOrder::$errMsg;
			return array('errCode' => 101, 'errMsg' => "���ͷ�ʽ����ȷ");
		}
		//Logger::err("������ͷ�ʽ");
		//���֧����ʽ
		if (false === IOrder::checkPayType($newOrder, $wh_id)) 
		{
			self::$errCode = IOrder::$errCode;
			self::$errMsg = IOrder::$errMsg;
			return array('errCode' => 102, 'errMsg' => "֧����ʽ����ȷ");
		}
		//Logger::err("��鷢Ʊ");
		//��鷢Ʊ
		if (false === ICustomPhone::checkInvoice($newOrder)) 
		{
			self::$errCode = ICustomPhone::$errCode;
			self::$errMsg = ICustomPhone::$errMsg;
			return array('errCode' => 103, 'errMsg' => "��Ʊ���ݲ���ȷ");
		}
		//Logger::err("����Լ����");
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
		'comment' => '�յ�',
		'invoiceBankName' => '',
		'invoiceBankNo' => '',
		'invoiceCompanyAddr' => '',
		'invoiceCompanyName' => '',
		'invoiceCompanyTel' => '',
		'invoiceContent' => '��Ʒ��ϸ',
		'invoiceId' =>	271792,
		'invoiceTaxno' => '',
		'invoiceTitle' => '����',
		'invoiceType' =>	1,
		'receiveAddrDetail' =>"�Ϻ���ɽ",
		'receiveAddrId'	=> 3333,
		'receiver' => 'Ҧ��',
		'receiverMobile' =>'13689564785',
		'receiverTel' =>'',
		'shippingPrice' =>	0,
		'shipType'=>1,
		'sign_by_other'=>1,
		'zipCode' =>'',
		'visitkey' => '2011test',
		'ls' => '',
		'edm' => '',
		'product_id' => 1111,   //�ֻ���Ʒid
		'gift'=>array(158777,38925,173807), //�ֻ���Ʒ����Ʒids
		'num' => xxxx, //�û���ѡ����		
		'Price' =>	619900,
		
		//������Լ��Ϣ
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
			return array('errCode'=>11, 'errMsg'=>"����д�Ķ�����ע�������뷵���޸ģ�");
		}	
		
		$uid = $newOrder['uid'];
		
		$userInfo = IUser::getUserInfo($uid);
		if ($userInfo === false) {
			self::$errCode = IUser::$errCode;
			self::$errMsg = "��ȡ�û���Ϣ����";
			self::$logMsg = basename(__FILE__) . ",line:" . __LINE__ . ",errMsg:��ȡ�û���Ϣ����" . IUser::$errMsg;
			return false;
		}
		global $_USER_TYPE;
		if ($userInfo['type'] == $_USER_TYPE['Dealer'] && isset($newOrder['couponCode']) && $newOrder['couponCode'] != '') {
			return array('errCode'=> 15, 'errMsg'=> "�����ڷ����û�������ʹ���Ż�ȯ��");
		}
		//�Ż�ȯ���
		if( !isset( $_COOKIE['contract_key'] )  || FALSE === strpos($_COOKIE['contract_key'], '-')) {//�û��ֶ��������cookie��ʽ����
			self::$errCode = 1;
			self::$errMsg = '��ʱ��Լ��Ϣcookie��ȡʧ��';
			return array('errCode' => 2, 'errMsg' => '�޷���ȡ��Լ��Ϣ');
		}
		$cpInfo = array('contract_key' => $_COOKIE['contract_key']);
		$couponInfo = array('amt'=> 0, 'code'=> '', 'type'=> 0);
		if (isset($newOrder['couponCode']) && $newOrder['couponCode'] != "") {
			$couponInfo = ICoupon::checkCoupon($uid, $newOrder['couponCode'], $newOrder['receiveAddrId'], $newOrder['payType'], $wh_id, 0, $cpInfo);
			if (false === $couponInfo) {
				exd_Attr_API2(634521, 1);
				self::$errCode = ICoupon::$errCode;
				self::$errMsg = ICoupon::$errMsg;
				return array('errCode' => '16', 'errMsg' => '�Ż�ȯ�޷�ʹ��');
			}
			
		    //����ͳһ���� add by donadzhang start
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
			//����ͳһ���� add by donadzhang end
		}
		
		// ����Ʒ����Ʒ
		$productids = array();
		// ����Ʒ
		$orderGifts = array();
		if($newOrder['gift'] != "")
		{
			$productids = explode(",",$newOrder['gift']);
			$orderGifts = explode(",",$newOrder['gift']);
		}
		// 
		if( $newOrder['product_id'] != $CardID )
		{
			//��¼�ֻ�
			array_push($productids, $newOrder['product_id']);
			$shoppingProduct[$newOrder['product_id']]['buy_num'] = 1; //��¼ÿ����Ʒ�Ĺ�������
			$shoppingProduct[$newOrder['product_id']]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
			$shoppingProduct[$newOrder['product_id']]['product_id'] = $newOrder['product_id'];
		
			//��ȡ��Լ�ֻ�����Ʒ��Ϣ
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
				// һ�㲻ִ��
				$service_type = 0;
			}
		}
		else
		{
			$service_type = 4;
		}
		
		
		if($service_type == 0)
		{
			Logger::err("����ʽ����");
			return array('errCode' => 17, 'errMsg' => '����ʽ����ȷ');
		}
		
		//��¼sim��
		array_push($productids, $CardID);
		$shoppingProduct[$CardID]['buy_num'] = 1; //��¼ÿ����Ʒ�Ĺ�������
		$shoppingProduct[$CardID]['type'] = SHOPPING_CART_PRODUCT_TYPE_NORMAL;
		$shoppingProduct[$CardID]['product_id'] = $CardID;
		
		Logger::info("��鱸ע");
		//�����Ʒ״̬��Ϣ�Ƿ�Ϸ�
		$product_base_info = IProduct::getProductsInfo($productids, $wh_id, true, true);
		//�������2.0 S zaleli
		$ch_id = isset($newOrder['chid']) ? intval($newOrder['chid']) : 0;
		$product_base_info = self::_setMultPriceInfo($product_base_info,$wh_id,$ch_id,$uid,$newOrder['product_id']);
		//������޹������µ�ʧ��
		foreach($product_base_info as $product)
		{
			if (isset($product['is_restrict']) && ($product['is_restrict'] == 1))
			{
				$url = "";
				//�޹���ʾ
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
				return array('errCode'=>6952, 'errMsg'=>"��Ǹ���µ�ʧ�ܡ����ܴ˻�۵���Ʒ�����꣡����Ϊ����ת�������Żݺ�Լ��", 'url'=>$url);
			}
		}
		//�����ۼ���Ч����
		$isRestrict = 0;
		$arrLockPromotionRestrict = self::_batchDealPromotionRestrict($product_base_info, $uid,$isRestrict);
		if (false ===  $arrLockPromotionRestrict)
		{
			$url = "";
			//�޹���ʾ
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
				return array('errCode'=>6952, 'errMsg'=>"��Ǹ���µ�ʧ�ܡ����ܴ˻�۵���Ʒ�����꣡����Ϊ����ת�������Żݺ�Լ��", 'url'=>$url);
			}
			else
			{
				return array('errCode'=>6952, 'errMsg'=>"��Ǹ���µ�ʧ�ܡ�����Ϊ����ת�������Żݺ�Լ��", 'url'=>$url);
			}
		}
		//�������2.0 E zaleli
		if (false === $product_base_info) {
			exd_Attr_API2(634513, 1);
			self::$errCode = IProduct::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query IProduct failed]' . IProduct::$errMsg;
			return false;
		}	
		
		// ��ȡ�ײ�ժҪ
		if($service_type == 4)
			$packageInfo = self::getPackageOneFee(0, $newOrder['package_id'], $wh_id);
		else
			$packageInfo = self::getPackageOneFee($newOrder['product_id'], $newOrder['package_id'], $wh_id);
        if(FALSE === $packageInfo)
    	{
    	    Logger::err("getPackageOneFee error");	
            return false;
    	}
    	//��ȡ�ֻ��ײ���
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
				//�ֻ�����				
				if (!isset($product_base_info[$pid]) || $product_base_info[$pid]['status'] != PRODUCT_STATUS_NORMAL) {
					Logger::err("���ƻ�" . $product_base_info[$pid]['name'] . "�ݲ�����");
					return  array('errCode'=>-1, 'errMsg'=>"��Ʒ" . $product_base_info[$pid]['name'] . "�ݲ�����");
				}
			}
			else if ( $CardID == $pid)
			{
				// SIM��
				if (!isset($product_base_info[$pid])) {
					Logger::err("SIM��{$pid}" . $product_base_info[$pid]['name'] . "�ݲ�����");
					return  array('errCode'=>-1, 'errMsg'=>"��Ʒ{$pid}" . $product_base_info[$pid]['name'] . "�ݲ�����");
				}
				// ��Ҫ�޸Ŀ��ļ۸�ѡ�������͹��������ļ۸�ΪԤ�滰�ѵļ۸�
				//ѡ��������sim���۸񣬵���$packageInfo['order_fee']
				if (4 == $service_type) {
					$card_price = 0;
					$package_price = $product_base_info[$pid]['show_price'];
				}
				//����������sim���۸񣬵�$packageInfo['predeposit_fee']
				else if (2 == $service_type) {
				    if (!isset($packageInfo['predeposit_fee'])) {
				        Logger::err("SIM��{$pid}" . $product_base_info[$pid]['name'] . "�������� �۸��ȡʧ��");
					    return  array('errCode'=>-1, 'errMsg'=>"��Ʒ{$pid}" . $product_base_info[$pid]['name'] . "�ݲ�����");
				    }
                                    Logger::info('predeposit_fee : '.$packageInfo['predeposit_fee']);
				    $product_base_info[$pid]['show_price'] = $packageInfo['predeposit_fee'] * 100;
					$card_price = 0;
					$package_price = $packageInfo['predeposit_fee'] * 100;
				}
				else
				{
					// Ԥ��
					$product_base_info[$pid]['show_price'] = 0;
					$card_price = 0;
					$package_price = 0;					
				}			
			}
			else //��Ʒ
			{
				//Logger::err("��Ʒ");
				if (!isset($product_base_info[$pid]) || $product_base_info[$pid]['status'] == PRODUCT_STATUS_NORMAL) {
					Logger::err("��Ʒ" . $product_base_info[$pid]['name'] . "�ݲ�����");
					return  array('errCode'=>-1, 'errMsg'=>"��Ʒ" . $product_base_info[$pid]['name'] . "��Ϣ�Ѿ��仯����ˢ��ҳ��");
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
		
		Logger::info("�����Ʒ״̬��Ϣ�Ƿ�Ϸ�");			
	
		//��ʼ�����
		$msSQL = ToolUtil::getMSDBObj('Inventory_Manager');
		if (false === $msSQL) {
			exd_Attr_API2(634522, 1);
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query ms sql faild " . ToolUtil::$errMsg;
			return false;
		}		
		if($service_type == 4)
		{
			// ѡ��������$newOrder['product_id']��0���ֲ��ÿ���
			$psyStock = $product_base_info[$CardID]['psystock'];//$psyStock = 1;			
		}
		else
		{
			// Ԥ�� �� ������$newOrder['product_id']Ϊ�ֻ�id���ֲ����ֻ�
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
		Logger::info("�����SQL��䣺".$sql);	
		//����ͳһ��� S zaleli
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
		//����ͳһ��� E zaleli
		$giftLackOfStock = array();
		$lackGiftAndIgnore = false;
		foreach ($shoppingProduct as $pid => $sp)
		{
			$exist = false;
			foreach ($productStocks as $pstock)
			{
				if ($sp['product_id'] == $pstock['ProductSysNo']) {
					$exist = true;
					if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_GIFT)  //��Ʒ
					{
						if ($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_num']) {
							$ret = IInventoryStockTTC::update(array('product_id'=>$sp['product_id'], 'num_available'=>$pstock['AvailableQty'], 'virtual_num'=> $pstock['VirtualQty']), array('sys_no'=>$pstock['SysNo']));
							if( false === $ret )
							{
								exd_Attr_API2(634522, 1);
								Logger::err("IInventoryStockTTC::update failed, errMsg:".IInventoryStockTTC::$errMsg);
							}
							if (!isset($newOrder['ingoreLackOfGift'])) {   //�����һ���ύ����
								$giftLackOfStock[$sp['product_id']] = $pstock['AvailableQty']  + $pstock['VirtualQty'];
							}else if ($newOrder['ingoreLackOfGift'] == 1) {  //�û�����ȱ����Ʒ
								$shoppingProduct[$pid]['buy_num'] = $pstock['AvailableQty']  + $pstock['VirtualQty'];
								if ($shoppingProduct[$pid]['buy_num'] <= 0) {
									unset($shoppingProduct[$pid]);
								}
								$lackGiftAndIgnore = true;
							}else   //�û������ܣ���ܾ��µ�
							{
								return  array('errCode'=>-13, 'errMsg'=>'��Ʒ'.$product_base_info[$sp['product_id']]['name']."��治��");
							}
						}
					}else if ($sp['type'] == SHOPPING_CART_PRODUCT_TYPE_ZUJIAN) {
						if ($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_num']) {
							return  array('errCode'=>-15, 'errMsg'=>'���'.$product_base_info[$sp['product_id']]['name']."��治��,����ϵ�ͷ�");
						}
					}else//����Ʒ
					{
						if (($pstock['AvailableQty']  + $pstock['VirtualQty'] < $sp['buy_num'])) {
								return  array('errCode'=>-15, 'errMsg'=>'��Ʒ'.$product_base_info[$sp['product_id']]['name']."��治��");
						}
					}
					$shoppingProduct[$sp['product_id']]['AvailableQty'] = $pstock['AvailableQty'];
					$shoppingProduct[$sp['product_id']]['VirtualQty'] = $pstock['VirtualQty'];
					break;
				}
			}
			if (false === $exist) {
				return  array('errCode'=>-16, 'errMsg'=>'��Ʒ'.$product_base_info[$sp['product_id']]['name']."�ݲ�����".$sp['product_id']);
			}
		}
		Logger::info("giftLackOfStock");	
		if (count($giftLackOfStock) != 0) {
			$errMsg = "���ﳵ����Ʒ:";
			foreach ($giftLackOfStock as $key=>$num)
			{
				$errMsg .= $product_base_info[$key]['name'] . "��治��,";//��ʣ��" . $num ."��,";
			}
			$errMsg .= "�Ƿ�����µ�?";
			return array('errCode'=>-100, 'errMsg'=>$errMsg);
		}
		Logger::info("�����");
		// �����ʾ
		if($lackGiftAndIgnore){
			$newOrder['comment'] .= "\nϵͳ�Զ���ע���û��ѽ���ȱ����Ʒ��治�㡣";
		}
		//// �ڶ�������д���Լ����������Ϣ
		
		// ���Ӧ֧�����ֽ�		,  ����۸�����ǲ����и����ӵ���Ҫ����?
		$cash = 0;
		$orderPrice = 0;
		foreach($product_base_info as $it)
		{
			$cash += $it['show_price'];
			$orderPrice += $it['show_price'];
		}
		
		
		//У��۸�
		
		if (bccomp($cash, $newOrder['Price'], 0) != 0) {
			self::$errCode = -2030;
			self::$errMsg="����Ķ����۸���ǰ̨�����۸�һ��.{$cash}, {$newOrder['Price']}";
			return array('errCode'=>-16, 'errMsg'=> self::$errMsg);
		}
		Logger::info("�����۸���ǰ̨����һ��:".$cash." == ".$newOrder['Price']);
		
		if ($couponInfo['amt'] > 0) {
			$cash -= $couponInfo['amt'];
		}
		//��̯�Ż�ȯ����Ʒ
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
		// ���ɶ�����
		$newOrderId = IIdGenerator::getNewId('so_sequence', 1);
		if (false === $newOrderId || $newOrderId <= 0) {
			exd_Attr_API2(634523, 1);
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		Logger::info("���ɶ�����$newOrderId");
		//���ɶ�����Ʒ���к�, �ֻ�����Ϊһ��������Ʒ
		$itemStartID = IIdGenerator::getNewId('so_item_sequence', count($shoppingProduct));  
		if (false === $itemStartID || $itemStartID <= 0) {
			exd_Attr_API2(634523, 1);
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		Logger::info("���ɶ�����Ʒ���к�");
		//��ȡ������Ʊid
		//$invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence' ,$orderNum);
		$invoice_id = IIdGenerator::getNewId('so_valueadded_invoice_sequence' ,1);
		if (false === $invoice_id) {
			exd_Attr_API2(634523, 1);
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		Logger::info("��ȡ������Ʊid");
		// ��ö������ݿ�
		$db_tab_index = ToolUtil::getMSDBTableIndex($uid,'ICSON_ORDER_CORE');
		$orderDb = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $db_tab_index['db']);			
		if (false === $orderDb) {
			exd_Attr_API2(634524, 1);
			self::$errCode = -2032 . "  " . $orderDb->errCode;
			self::$errMsg='����ICSON_ORDER_CORE����ʧ��'  . $orderDb->errMsg;
			Logger::err(var_export($db_tab_index,true));
			Logger::err("getMSDBObj failed");
			return  false;
		}
                
                //add by donadzhang ����ͳһ����   start
		$orderPoList = array("orderInfoList" => array());
		//add by donadzhang ����ͳһ����   end
		
		$sql = "begin transaction";
		$ret = $orderDb->execSql($sql);
		if (false === $ret) {
			exd_Attr_API2(634524, 1);
			self::$errCode = -2032 . "  " . $orderDb->errCode;
			self::$errMsg='����ICSON_ORDER_CORE����ʧ��'  . $orderDb->errMsg;
			Logger::err("orderDb begin transaction failed");
			return  false;
		}
		
		$ret = $msSQL->execSql($sql);
		if (false === $ret) {
			exd_Attr_API2(634524, 1);
			self::$errCode = -2032 . "  " . $msSQL->errCode;
			self::$errMsg='����ICSON_ORDER_CORE����ʧ��'  . $msSQL->errMsg;
			Logger::err("msSQL begin transaction failed");
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql("rollback");
			return  false;
		}
		Logger::info("��ö������ݿ�");
		$now = time();

		$newOrderCharId = sprintf("%s%09d", "1", $newOrderId % 1000000000);
		// ���ɶ�����Ϣ
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
                //add by donadzhang ����ͳһ����   start
		$orderPo = array();
		$orderPo['dealId']           = '';//��Ϊ��
		$orderPo['dealId64']         = 0; //��Ϊ��
		$orderPo['bdealId']          = 0; //��Ϊ��
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
		$orderPo['dealPayType']      = 0;//ȷ�Ϲ�����ʱ����д
		
		//����֧��������֧�����ʾֻ��vs���е�㣩��ʼ״̬Ϊ��UNP_DEAL_STATE_WAIT_PAY��δ�������ˣ���
		$dealState = $UNPDealState_E['UNP_DEAL_STATE_WAIT_PAY'];
		//���������ʼ״̬Ϊ��UNP_DEAL_STATE_WAIT_CHECK������ˣ���
	    //0Ԫ���������߼�����ʼ״̬UNP_DEAL_STATE_WAIT_CHECK������ˣ�
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
		
		//�ο���ͨ����������д�ģ���Ҫȷ�����Ƿ���ȷ
		$orderPo['dealTotalFee']     = $cash;
		$orderPo['dealPayment']      = $cash;     //Ŀǰû���˷ѣ�������˷���Ҫ��������
		$orderPo['dealDownPayment']  = 0;
		$orderPo['dealDiscountTotal'] = 0;  //��Լ������û���κδ����
		if(isset($couponInfo['amt']) && $couponInfo['amt'] > 0)
			$orderPo['dealDiscountTotal'] = $couponInfo['amt'];
		$orderPo['dealItemTotalFee']  = $cash;
		
		//˭֧���ʷѣ�1�����ң�2�����
		$orderPo['dealWhoPayShippingFee']  = 2;
		$orderPo['dealShippingFee']        = $newOrder['shippingPrice'];
		
		//˭�е�COD�����ѣ�1�����ҳе���2����ң�3��ƽ̨�е�
		$orderPo['dealWhoPayCodFee']       = 1;
		$orderPo['dealCodFee']             = 0;
		
		//˭֧�����շѣ�1���������ͣ�2����ң�3��ƽ̨�е�
		$orderPo['dealWhoPayInsuranceFee'] = 0;
		$orderPo['dealInsuranceFee']       = 0;  //��Ӧpremium_cost�ֶ�
		$orderPo['dealSysAdjustFee']       = 0;
		
		//��Լ����ʹ�û����µ�,�µ�Ҳ�����ͻ���
		$orderPo['payScore']               = 0;
		$orderPo['obtainScore']            = 0;
		
		//��������ʱ��
		$orderPo['dealGenTime']            = $now;
		
		//��������������,����ȷ���Ƿ���д��ȷ(ȷ�Ϲ��ˣ�����Ҫ��д)
		$orderPo['sendFromDesc']           = '';
		
		//�µ�ʱ���,Ŀǰ��д��������ʱ��
		$orderPo['dealSeq']                = $now;
		
		//�µ�md5��seq+recvregionid+skulist�� ------------------------��������
		$orderPo['dealMd5']                = '';
		
		
		$orderPo['dealIp']                 = iconv('GBK', 'UTF-8', $orderMain['customer_ip']);
		
		//��cpsinfo��͸���ģ�������������ȷ��
		$orderPo['dealRefer']              = $orderMain['cpsinfo'];
		$orderPo['dealVisitKey']           = $orderMain['visitkey'];
		$orderPo['promotionDesc']          = '';
		
		//�û����
		$orderPo['recvName']               = iconv('GBK', 'UTF-8', $newOrder['receiver']);
		$orderPo['recvRegionCode']         = 0; //ǰ�ڲ���
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
		
		//�������
		$orderPo['expressType']            = 0;
		$orderPo['expressCompanyID']       = '';
		$orderPo['expressCompanyName']     = '';
		
		$orderPo['cftDealId']              = '';
		$orderPo['lastUpdateTime']         = 0;
		
		//������Ʒӳ��
		$orderPo['tradeInfoList']          = array('tradeInfoList' => array());    //-----------------------------------------------------------��������
		
		//payInfoList,actionLogInfoList,dealExtInfoMap������
		/*
		$orderPo['payInfoList'] = ayyay();
		$orderPo['actionLogInfoList'] = ayyay();
		$orderPo['dealExtInfoMap'] = ayyay();
	    */
		
		$orderPo['bdealCode']              = '';//��֪���Ǹ�ʲô�ģ�����ȷ���£�ȷ�Ϲ��ˣ����
		$orderPo['businessBdealId']        = $newOrderId;   //��ʱ���id
		$orderPo['siteId']                 = $wh_id;
		$orderPo['dealCouponFee']          = $couponInfo['amt'];
		$orderPo['cashScore']              = 0;
		$orderPo['promotionScore']         = 0;
		$orderPo['dealDigest']             = '';
		
		//���ڸ�����Ϣ����ʱû�У�
		$orderPo['payInstallmentBank']     = '';
		$orderPo['payInstallmentNum']      = 0;
		$orderPo['payInstallmentPayment']  = 0;
		
		//��Ѹ������չ��Ϣ
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
		$orderPo['payChannel']             = 0;  //��ʱ����
		$orderPo['payServiceFee']          = 0;
		$orderPo['icsonDealCashBack']      = 0;
		$orderPo['payInstallmentFee']      = 0;

		//����ά�Ȼ�б�
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
		
		//add by donadzhang ����ͳһ����   end 
		
		// ���붩�����ݿ�
		$ret = $orderDb->insert("t_orders_{$db_tab_index['table']}", $orderMain);
		if( false === $ret )
		{
			exd_Attr_API2(634524, 1);
			self::$errCode = -2033;
			self::$errMsg = 'ִ��insert�������ʧ��, line:'. __LINE__ . ',errMsg:' . $orderDb->errMsg;
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql("rollback");
			self::_transaction( $msSQL, "rollback", __LINE__ );
			return false;
		}
		Logger::info("���붩�����ݿ�");
		
		//���˫д S zaleli
		$orderCreatTime = $now;
		$lockedInventory = array();//��¼���������Ϣ
		//���˫д E zaleli
		
		//�ۿ�� ���붩������Ʒ��ӳ���
		$now = time();
		$SubKeyId = $psyStock;
		$timeNow = date('Y-m-d H:i:s', $now);
                $uniProductIds = array();
		foreach ($shoppingProduct as $sp)
		{		
			//�۷ֲ�
			$sql = "update Inventory_Stock set AvailableQty = AvailableQty - {$sp['buy_num']},  OrderQty = OrderQty + {$sp['buy_num']}, rowModifydate='{$timeNow}' where  StockSysNo=$SubKeyId AND  ProductSysNo={$sp['product_id']}";
			$ret = $msSQL->execSql($sql);			
			if (false === $ret || 1 != $msSQL->getAffectedRows()) 
			{	
				exd_Attr_API2(634525, 1);
				Logger::info($sql);	
				self::$errCode = -2047;
				self::$errMsg="�ۼ�ms sql�ֲֿ��ʧ��({$sp['product_id'] })"  . $msSQL->errMsg;
				//�������2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//�������2.0 E zaleli
				$orderDb->execSql("rollback");
				$msSQL->execSql("rollback");
				return false;
			}
			$uniProductIds[] = $sp['product_id'];
			//���˫д S zaleli
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
				//��ӡ������־
				Logger::err("_setLockInventory Err. inventroyAllDatas:".ToolUtil::gbJsonEncode($inventroyAllDatas)." uid:".$uid);	
			}
			else
			{
				$lockedInventory[] = $inventroyData;//��¼���������Ϣ
				Logger::info("lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//���˫д E zaleli
			// �ǿ��仯��ˮ
			// AvailableQty
			$buy_num_negative = -1 * $sp['buy_num'];
			$sql = "insert into Inventory_Flow values({$SubKeyId}, {$sp['product_id']}, 1, '{$newOrderId}', 2, {$buy_num_negative},'{$timeNow}', '{$timeNow}',7)";
			$ret = $msSQL->execSql($sql);
			if ( false === $ret )
			{
				exd_Attr_API2(634526, 1);
				Logger::info($sql);	
				self::$errCode = -2048;
				self::$errMsg = "��¼ AvailableQty �仯��ˮʧ��, line:". __LINE__ .",errMsg".$msSQL->errMsg;
				//�������2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//�������2.0 E zaleli
				$orderDb->execSql("rollback");
				//���˫д S zaleli
				//�������
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//��ӡ������־
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//���˫д E zaleli
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
				self::$errMsg = "��¼ OrderQty �仯��ˮʧ��, line:". __LINE__ .",errMsg".$msSQL->errMsg;
				//�������2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//�������2.0 E zaleli
				$orderDb->execSql("rollback");
				//���˫д S zaleli
				//�������
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//��ӡ������־
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//���˫д E zaleli
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
				'shop_guide_cost' => 0 // ԭ���ϣ������������������ߵ����ƻ����
			);
			
			$newOrder['order_items'][] = $newOrderItems; //��Ҫ��order_item �����ú���
			$ret = $orderDb->insert("t_order_items_{$db_tab_index['table']}" , $newOrderItems);
			if (false === $ret) {
				exd_Attr_API2(634532, 1);
				self::$errCode = -2039;
				self::$errMsg='ִ��sql���ʧ��' . $orderDb->errMsg;
				//�������2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//�������2.0 E zaleli
				$orderDb->execSql("rollback");
				//���˫д S zaleli
				//�������
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//��ӡ������־
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//���˫д E zaleli
				self::_transaction( $msSQL, "rollback", __LINE__ );
				return  false;
			}
                        //add by donadzhang ����ͳһ����   start 
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
			$orderTradePo['tradePayType']           = 0;                 //��Ҫ��ע
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
			$orderTradePo['itemClassId']            = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemTitle']              = iconv('GBK', 'UTF-8', $newOrderItems['name']);
			$orderTradePo['itemAttrCode']           = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemAttr']               = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemSkuId']              = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemSpuId']              = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemStockId']            = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemStoreHouseId']       = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemLogo']               = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemSnapVersion']        = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemResetTime']          = 0;//ͳһ��Ʒ��������д
			$orderTradePo['itemId']                 = $newOrderItems['product_id'];
			$orderTradePo['itemLocalStockCode']     = '';
			$orderTradePo['itemBarCode']            = '';
			$orderTradePo['itemPhyisicalStorage']   = $psyStock;
			$orderTradePo['itemWeight']             = $newOrderItems['weight'];
			$orderTradePo['itemVolume']             = 0; //�ݲ�����
			$orderTradePo['mainItemId']             = $newOrderItems['main_product_id'];
			$orderTradePo['itemAccessoryDesc']      = '';
			$orderTradePo['itemCostPrice']          = $newOrderItems['cost'];
			$orderTradePo['itemOriginPrice']        = 0;
			$orderTradePo['activeInfoList']         = array('tradeActiveInfoList' => array());   //�������2.0��������
			$orderTradePo['itemB2CMarket']          = 0;
			$orderTradePo['itemB2CPM']              = 0;
			$orderTradePo['tradeDiscountTotal']     = 0;
			$orderTradePo['itemSoldPrice']          = $newOrderItems['price'];
			$orderTradePo['buyPrice']               = $orderTradePo['itemSoldPrice'];
			$orderTradePo['buyNum']                 = $newOrderItems['buy_num'];
			$orderTradePo['tradePayment']           = $orderTradePo['buyPrice']*$orderTradePo['buyNum'];
			//�������2.0 S zaleli
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
			//�������2.0 E zaleli
			if($newOrder['product_id'] == $sp['product_id'])
			{
				//$orderTradePo['itemSoldPrice'] = $newOrderItems['price'] - $couponInfo['amt'];
				//if($orderTradePo['itemSoldPrice'] < 0) $orderTradePo['itemSoldPrice'] = 0;
				
				$orderTradePo['itemB2CPM']              = $couponInfo['type'] == 1 ? $couponInfo['amt'] : 0;
				$orderTradePo['itemB2CMarket']          = $couponInfo['amt'];
				
				//������Ʒά�Ȼ�б�
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
			$orderTradePo['tradeTotalFee']          = $orderTradePo['tradePayment']; //�µ�ʱtradeTotalFee = tradePayment
			$orderTradePo['tradeAdjustFee']         = 0; //�µ�����
			$orderTradePo['tradePaipaiHongbaoUsed'] = 0; //����
			$orderTradePo['payScore']               = 0;
			$orderTradePo['tradeGenTime']           = $now;
			$orderTradePo['tradeOpSerialNo']        = 0;
			$orderTradePo['obtainScore']            = $newOrderItems['points'];
			$orderTradePo['tradeState']             = 0;
			//�����������ȷ����ô��
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
			
			//��Ѹ��չ��Ϣ
			$orderTradePo['icsonEdmCode']           = '';
			$orderTradePo['icsonOTag']              = '';
			$orderTradePo['icsonTradeShopGuideCost'] = '';
			$orderTradePo['icsonTradeFlag']         = $newOrderItems['flag'];
			$orderTradePo['icsonPointType']         = $newOrderItems['point_type'];
			$orderTradePo['icsonPackageIds']        = '';
			$orderTradePo['icsonTradeCashBack']     = 0;
			$orderPo['tradeInfoList']['tradeInfoList'][] = $orderTradePo;
			//add by donadzhang ����ͳһ����   end 
		}
		
		if(0 == $newOrder['isVat'])//�������Ҫ����Ʊ����ô�����ֶ�Ϊ��
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
		
		//Logger::err("������Ʒ������");
		// ���뷢Ʊ��Ϣ
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
			self::$errMsg = 'ִ��insert��Ʊ��, line:'. __LINE__ . ',errMsg:' . $orderDb->errMsg;
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql("rollback");
			//���˫д S zaleli
			//�������
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//��ӡ������־
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//���˫д E zaleli
			self::_transaction( $msSQL, "rollback", __LINE__ );
			return false;
		}
                //add by donadzhang ����ͳһ����   start
		//��Ʊ��Ϣ
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
		
		//��Ʊ����
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
			$orderPo['icsonInvoiceShipType']      = YT_DELIVERY;//Ŀǰֻ֧��Բͨ
			$orderPo['icsonInvoiceShipFee']       = 1000;//��Ϊ��λ
		}
		//add by donadzhang ����ͳһ����   end
                
		//Logger::err("���뷢Ʊ");
		$orderDb = ToolUtil::getMSDBObj('ICSON_CORE');			
		//�˴���package_idʵΪfee_id
		// �����Լ��
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
			self::$errMsg = 'ִ�в����Լ��ʧ��, line:'. __LINE__ . ',errMsg:' . $orderDb->errMsg;
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql("rollback");
			//���˫д S zaleli
			//�������
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//��ӡ������־
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//���˫д E zaleli
			self::_transaction( $msSQL, "rollback", __LINE__ );
			return false;
		}
		//Logger::err("�����Լ��");
		// ��mysql�ĺ�����и���״̬	
		// ���ӵ�ǰ̨�����ݿ�cp_information
        if( false === self::_getDB_s("cp_information", $mysql, __LINE__ ))
        {
                self::$errMsg = ToolUtil::$errMsg;
				//�������2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//�������2.0 E zaleli
                $orderDb->execSql("rollback");
				//���˫д S zaleli
				//�������
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//��ӡ������־
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//���˫д E zaleli
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
			self::$errMsg = '���º���('.$newOrder['num'].')ʧ��, line:'. __LINE__ . ',errMsg:' . self::$errMsg;
			Logger::err(self::$errMsg);
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql("rollback");
			//���˫д S zaleli
			//�������
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//��ӡ������־
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//���˫д E zaleli
			$msSQL->execSql("rollback");
			return false;
		}
		
		if( !$mysql->getAffectedRows() )
		{
			exd_Attr_API2(634516, 1);
			self::$errCode = 501;
			self::$errMsg = '���º���('.$newOrder['num'].')ʧ��, line:'. __LINE__ . ',getAffectedRows :' . $mysql->getAffectedRows();
			Logger::err(self::$errMsg);
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql("rollback");
			//���˫д S zaleli
			//�������
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//��ӡ������־
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//���˫д E zaleli
			$msSQL->execSql("rollback");
			if( isset( $_COOKIE['contract_key'] ) )
			{
				// �����ÿ�
				$data = array(
					'contract_key' => $_COOKIE['contract_key'],
					'num' => ''
				);
				ICpContractTTC::update($data);
			}
			return array(
				'errCode' => 501 , 
				'errMsg' => "������ʱ���������Ҫ����ѡ�����", 
				'url' => self::getUrl($newOrder['product_id'],"steptwo",$chid)
			);
		}

		//BEGIN ����erp�����״̬
		$productDB = ToolUtil::getMSDBObj('Product');
		if($productDB === false) {
			exd_Attr_API2(634530, 1);
			Logger::err('connect to db error');
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql($sql);
			//���˫д S zaleli
			//�������
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//��ӡ������־
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//���˫д E zaleli
			$msSQL->execSql($sql);
			return false;
		}
		$ret = $productDB->update('Customization_PhoneNumber', array('Status' => 1), 'PhoneNumber=' . $newOrder['num']);
		if($ret === false) {
			exd_Attr_API2(634530, 1);
			self::$errCode = $productDB::$errCode;
			self::$errMsg = $productDB::$errMsg;
			$sql = "rollback";
			//�������2.0 S zaleli
			self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
			//�������2.0 E zaleli
			$orderDb->execSql($sql);
			//���˫д S zaleli
			//�������
			$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
			if (false === $inventoryRet)
			{
				//��ӡ������־
				Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
			}
			//���˫д E zaleli
			$msSQL->execSql($sql);
			return false;
		}
		//END ����erp�����״̬

		//BEGIN ���¹���ȯ
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
					//�������2.0 S zaleli
					self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
					//�������2.0 E zaleli
					$orderDb->execSql($sql);
					//���˫д S zaleli
					//�������
					$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
					if (false === $inventoryRet)
					{
						//��ӡ������־
                                                
						Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
					}
					//���˫д E zaleli
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
					//�������2.0 S zaleli
					self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
					//�������2.0 E zaleli
					$orderDb->execSql($sql);
					//���˫д S zaleli
					//�������
					$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
					if (false === $inventoryRet)
					{
						//��ӡ������־
						Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
					}
					//���˫д E zaleli
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
				//���˫д S zaleli
				//�������
				$inventoryRet = self::_setUnLockInventory($lockedInventory,$uid);
				if (false === $inventoryRet)
				{
					//��ӡ������־
					Logger::err("_setUnLockInventory Err. lockedInventory:".ToolUtil::gbJsonEncode($lockedInventory)." uid:".$uid);	
				}
				//���˫д E zaleli
				$mysqlDb->execSql($sql);
				//�������2.0 S zaleli
				self::_batchRollbackPromotionRestrict($arrLockPromotionRestrict,$uid);
				//�������2.0 E zaleli
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
		//END ���¹���ȯ
		
		$msSQL->execSql("commit");
		$orderDb->execSql("commit");
		//Logger::err("����");
		$result = array(
			'errCode' => 0,
			'uid'=> $newOrder['uid'],
			'orderId'=>$newOrderCharId, //$newOrderId,
			'orderAmt'=>$cash,
			'payType'=>$newOrder['payType'],
			'payTypeIsOnline' => $_PAY_MODE[$wh_id][$newOrder['payType']]['IsNet'],
			'payTypeName' => $_PAY_MODE[$wh_id][$newOrder['payType']]['PayTypeName'],
			'orderTotalAmt'=>$cash, //�����ܽ��
			'payGoodsAmt' => $cash, //�����ͻ�֧���Ľ�ȥ���˷Ѻ����ܵ��������Żݺ���û�ʵ��֧����
			'orderCreateTime'=>$now,
			'isParentOrder' => false,
			'order_items' => $newOrder['order_items'],
		);
		
		if( isset( $_COOKIE['contract_key'] ) )
		{
			ICpContractTTC::remove($_COOKIE['contract_key']);
		}
		Logger::info('start uni order');
		//add by donadzhang ����ͳһ����   start
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
				//�������Ҷ�
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
                //uidȡģ�Ҷ�
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
		
		//�����Լ��Ϣ
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
                $reqData['opt']['uin']       = $uid;          //ʹ��Mod+L5��ʽ����·�ɣ�һ����д�û�QQ����ӦsetDwUin��
                $reqData['opt']['operator']  = $uid;         //������ID��һ����д�û�QQ����ӦsetDwOperatorId��
                $reqData['opt']['caller']    = 'customphone';  //���÷����֣�����ģ��(��ӦsetCallerName)
                $reqData['opt']['timeout']   = 3;             //��ʱʱ�䣬����Ϊ��λ����������¿��Ե���
                
                //����req����
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
     * ������Ʒ������ת��
     * @param $type int
     * @return
     */
    private static function getTradeProperty3($type)
    {
        global $UNPTradeProperty51Buy3_E;
        $property = 0x00000000;

        switch ((int)$type) {
                case 0 :
                        //Normal��ͨ��Ʒ
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_NORMAL'];
                        break;
                case 1 :
                        //SecondHand������Ʒ
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SECOND_HAND'];
                        break;
                case 2 :
                        //Bad��Ʒ
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_BAD'];
                        break;
                case 3 :
                        //Service����
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_SERVICE'];
                        break;
                case 4 :
                        //OnlyViewNoSaleչʾ����
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ONLY_VIEW'];
                        break;
                case 9 :
                        //OtherProduct������Ʒ
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_OTHER'];
                        break;
                case 10 :
                        //AdjustProduct�ļ���Ʒ
                        $property = $property | $UNPTradeProperty51Buy3_E['UNP_TRADE_PROP3_51BUY_TYPE_ADJUST'];
                        break;
                default :
                        break;
        }

        return $property;
    }   
        
    /**
     * ������Ʒ��flag�ֶ�ת������Ѹ��վ����constant.inc.php�ж���
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
        //�ؼ���Ʒ��־

        //define("OTHER_TIME_LIMITED_RUSHING_BUY", 0x4);
        if ($flag & 0x4) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_OTHER_TIMELIMITED_BUY'];
        }
        //�����������ͱ�ʶ

        //define('CAN_VAT_INVOICE', 0X8);
        if ($flag & 0X8) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CAN_VAT_INVOICE'];
        }
        //�Ƿ��ܿ���Ʊ

        //define('IS_DEFAULT_INVOICE', 0X10);
        if ($flag & 0X10) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_IS_DEFAULT_INVOICE'];
        }
        //�Ƿ�Ĭ�Ͽ�Ʊ

        //define("TIME_LIMITED_RUSHING_BUY", 0x20);
        if ($flag & 0x20) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_TIMELIMITED_BUY'];
        }
        //��ʾ������־

        //define('FORBID_SET_VIRTUAL', 0x40);
        if ($flag & 0x40) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_FORBID_SET_VIRTUAL'];
        }
        //�Ƿ��ֹ�����

        //define('PRODUCT_ENERGY_SUBSIDY', 0x80);
        if ($flag & 0x80) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_ENERGY_SUBSIDY'];
        }
        //���ܲ�����Ʒ

        //define('CP_YCHF', 0x100);
        if ($flag & 0x100) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ��������Ԥ�滰�����ֻ�

        //define('CP_GJRW', 0x200);
        if ($flag & 0x200) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ�����������������ͻ���

        //define('CP_XHRW', 0x400);
        if ($flag & 0x400) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ��������ѡ������

        //define('CP_GMLJ', 0x800);
        if ($flag & 0x800) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_CONTRACT_PHONE'];
        }
        //���ƻ���Ʒ���������������

        //define('PRODUCT_EXTENDED_INSURANCE', 0x1000);
        if ($flag & 0x1000) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_EXTENDED_INSURANCE'];
        }
        //�ӱ���Ʒ

        //define('PROMOTION_PRODUCT', 0x2000);
        if ($flag & 0x2000) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_PROMOTION_PRODUCT'];
        }
        //������Ʒ

        //define('APPOINT_PRODUCT', 0x8000);
        if ($flag & 0x8000) {
                $property = $property | $UNPTradeProperty51Buy_E['UNP_TRADE_PROP_51BUY_APPOINT_PRODUCT'];
        }
        // Ԥ����Ʒ

        return $property;
    } 
        
    /**
     * ��ȡ��������,��Ӧԭ��Ѹ��վ�˶���flag�ֶ�,��Ʊ���붩����������Ҫ������Ѹ��վ������bits�ֶν����ж����ã�
     * @param $flag int
     * @param $bits int ��������bits�ֶ�
     * @return
     */
    private static function getDealProperty2($flag, $bits)
    {
        global $UNPDealProperty51Buy_E;
        $property = $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_NULL"];

        //�Ҷ��ڼ䶩��
        $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_GRAY_RELEASE_DEAL"];

        //��������flag�ֶζ���
        //define('ORDER_INSTALLMENT_FLAG', 0X1);
        if ($flag & 0X1) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_PAY_INSTALLMENT"];
        }
        //���ڸ����

        //define('ORDER_HAS_SERVICE', 0X2);
        if ($flag & 0X2) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_SERVICE_PRODUCT"];
        }
        //�����к��з�����Ʒ,��Ҫ���ݶ����Ƿ����������Ʒ�����ж�    ����   ������վ������flag�ֶ��жϣ�ORDER_HAS_SERVICE��

        //define('ORDER_CP', 0X4);
        if ($flag & 0X4) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_CONTRACT_PHONE"];
        }
        //��Լ������

        //define('ORDER_RUSHING_BUY_ONLINE_PAY', 0X8);
        if ($flag & 0X8) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_RUSH_BUY_ONLINE_PAY"];
        }
        // �����к���������Ʒ��Ϊ����֧��

        /*�����̵Ķ������׽���ƽ̨�µ��ģ�����ͬ����ͳһ��̨��
         //define('ORDER_ENTERPRISE_USER', 0X10);
         if ($flag & 0X10) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣���ҵ�û�������
         //define('ORDER_CHAOHUO_USER', 0X20);
         if ($flag & 0X20) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣������̣�����
         //define('ORDER_WHOLESALER_USER', 0X40);
         if ($flag & 0X40) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣������̣�����
         //define('ORDER_RETAILERS_USER', 0X80);
         if ($flag & 0X80) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         //�����̣������̣�����
         //define('ORDER_FROM_NEW_SH', 0x40000000);
         if ($flag & 0x40000000) {
         $property = $property | $UNPDealProperty51Buy_E[""];
         }
         */

        //define('ORDER_ENERGY_SUBSIDY', 0x100);
        if ($flag & 0x100) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_ENERGY_SUBSIDY"];
        }
        // ���ܲ�������

        //define('ORDER_SHANGQI_USER', 0x200);
        if ($flag & 0x200) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SHANGQI_DEAL"];
        }
        //��������

        //define('ORDER_EXCHANGE_GOODS_FOR_ERP', 0x400);
        if ($flag & 0x400) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_EXCHANGE_GOODS_FOR_ERP"];
        }
        //�ͷ�����������ǰ̨δʹ��ռס������

        //define('ORDER_NONGHANG', 0x1000);
        if ($flag & 0x1000) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_HAS_ABCCHINA_SALE"];
        }
        //����ũ�л��Ʒ�Ķ�����������󣬸��ֶλ�ȥ��

        //��������bits�ֶζ���
        //define('ORDER_SEPARATE_GOODS_INVOICE', 0x1);
        if (isset($bits) && (int)$bits == 1) {
                $property = $property | $UNPDealProperty51Buy_E["UNP_DEAL_PROP_51BUY_SEPARATE_GOODS_INVOICE"];
        }
        //��Ʊ���붩����ǰ̨δʹ��ռס������

        return $property;
    }
        
        
        /**
         * ��ȡ֧����ʽ������Ѹ֧����ʽӳ��Ϊͳһƽ̨��֧����ʽ
         * @param $payType int
         * @return $uniPayType int
         */
        private static function getMappingUniPayType($payType) 
        {
            global $UNPDealPayType_E;
            switch ((int)$payType)
            {
                    case 1 :
                            //��������
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_COD'];
                            break;
                    case 3 :
                            //���е��
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_BANK_TRANS'];
                            break;
                    case 4 :
                            //�ʾֻ��
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POST_TRANS'];
                            break;
                    case 5 :
                            //���л���  �������ʺ���ֱ��ת�ʵ���Ѹ��ָ�����п���  ��ʱ����
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                            break;
                    case 6 :
                            //����  ���������ڸ���
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_NULL'];
                            break;
                    default :
                            $uniPayType = $UNPDealPayType_E['UNP_DEAL_PAY_TYPE_POL'];
                            break;
            }
            return $uniPayType;
        }
        
        
        /**
         * ��ȡͳһƽ̨��Ʊ����
         * @param $type int
         * @return
         */
        private static function getInvoiceType($type)
        {
            if (2 == $type) {//��ֵ˰��Ʊ
                    //INVOICE_TYPE_VAT = 2
                    return 1;
            }
            else if (4 == $type) {//��ֵ˰��ͨ��Ʊ
                    // INVOICE_TYPE_VAT_NORMAL = 4
                    return 2;
            }
            else if (8 == $type) {//������Ʊ  ��ֵ˰��ͨ��Ʊ,�����Ʊ����IDΪ4
                    // INVOICE_TYPE_VAT_NORMAL_NEW = 8
                    return 4;
            }
            else {//��ҵ���۷�Ʊ(��˾)��ҵ���۷�Ʊ(����)
                    // 1,3
                    return 3;
            }
        }
        
        /**
         * ��ȡmd5��ת��������
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

             //�����ͳһ�û�ϵͳ��ȡ�û���uid
             $bo['buyerId'] = isset($data['wgid']) ? $data['wgid'] : 0;

             //�������id��ͳһƽ̨��Ѹ��idΪ855006089
             $bo['sellerId'] = $UNPSellerAccount51Buy_E['sellerId'];

             $bo['eventId'] = 0;

             //<uint32_t> �����߽�ɫ(�汾>=0) 1����ң�2�����ң�3��ϵͳ��4����Ӫϵͳ��5��֧��ϵͳ�������ṩ��IDL����
             $bo['operatorRole'] = 1;

             //<std::string> �¼���Դ��ҵ��������д���÷��������ļ���(�汾>=0)
             $bo['eventSource'] = __FILE__;

             //<std::string> ����id(�汾>=0)
             $bo['dealId'] = isset($data['dealId']) ? $data['dealId'] : 0;

             //<uint64_t> �ӵ�id(�汾>=0)
             $bo['tradeId'] = 0;

              //<std::string> ��Դip(�汾>=0)
             $bo['clientIp'] = iconv('GBK', 'UTF-8', isset($data['clientIp']) ? $data['clientIp']:'');

             //<std::string> ������(�汾>=0)
             $bo['machineKey'] = isset($data['machineKey']) ? $data['machineKey'] : '';

             //<std::string> ������(�汾>=0)
             $bo['operatorName'] = '';

             //<std::string> �����ֶ�(�汾>=0)
             $bo['reserve'] = '';

             //<std::string> ���׵���(�汾>=1)
             $bo['bdealId'] = isset($data['bdealId']) ? $data['bdealId'] : '';

             return $bo;
        }

	public function getPackageFeeInfo($sp_id,$product_id,$service_type)
	{
		// ���ӵ�ǰ̨�����ݿ�cp_information
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
			self::$errMsg = '��ȡ�ײͺͷ�����Ϣʧ��, line:'. __LINE__ . ',errMsg:' . $mysql->errMsg;
			return false;
		}
		
		return $packageInfo;
	}
	
	
	/**
	 * 
	 * ͨ��list_pkgs��ȡ���Ԥ�滰�ѵ�ֵ(flag=0) or �жϸ���Ʒ�Ƿ���iphone�ײ�(flag=1)
	 * @param int $list_pkgs
	 * @return int|boolean
	 */
    public static function getMaxYCHF(&$list_pkgs,$flag = 0)
	{
		if(empty($list_pkgs)) return -1;
		$pkg_ids = $fee_pkg_ids = array();
    	foreach ($list_pkgs as $v) {
    	    if (!in_array($v['package_id'], $pkg_ids)) {
    	        //�����ֻ��ײ�id
    	        $pkg_ids[] = $v['package_id'];
    	    }
    	    if (!in_array($v['fee_package_id'], $fee_pkg_ids)) {
    	        //�����ʷ��ײ�id
    	        $fee_pkg_ids[] = $v['fee_package_id'];
    	    };
    	}
		//��ȡչʾ��Ŀ
	    $columns = self::getFeeItems($fee_pkg_ids);
		if(FALSE === $columns) return false;
		$pkg_infos = self::getPackages($pkg_ids);
		if(FALSE === $pkg_infos) return false;
		$sorted_pkg_name_arr = array();
		foreach($pkg_infos as $i_pkg_info) { //�ײ�������
			$sorted_pkg_name_arr[] = $i_pkg_info['package_name'];
		}
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		$new_list_pkgs = array();
		foreach($list_pkgs as $pinfo)
		{
		    //����ֻ��ײͰ������ڣ����¼��־��Ȼ���������ײ�
		    if (!isset($pkg_infos[$pinfo['package_id']])) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //����ֻ��ײͰ�״̬�����ã����������ײ�
		    if ('0' != $pkg_infos[$pinfo['package_id']]['status']) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //����ʷѰ������ڣ����¼��־��Ȼ���������ײ�
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
		//�������ֵ
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
		}//�ж�iphone��Ʒ
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
	 * ͨ��list_pkgs��ȡ������ͻ��ѵ�ֵ
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
    	        //�����ֻ��ײ�id
    	        $pkg_ids[] = $v['package_id'];
    	    }
    	    if (!in_array($v['fee_package_id'], $fee_pkg_ids)) {
    	        //�����ʷ��ײ�id
    	        $fee_pkg_ids[] = $v['fee_package_id'];
    	    };
    	}
		//��ȡչʾ��Ŀ
	    $columns = self::getFeeItems($fee_pkg_ids);
		if(FALSE === $columns) return false;
		$pkg_infos = self::getPackages($pkg_ids);
		if(FALSE === $pkg_infos) return false;
		$sorted_pkg_name_arr = array();
		foreach($pkg_infos as $i_pkg_info) { //�ײ�������
			$sorted_pkg_name_arr[] = $i_pkg_info['package_name'];
		}
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		$new_list_pkgs = array();
		foreach($list_pkgs as $pinfo)
		{
		    //����ֻ��ײͰ������ڣ����¼��־��Ȼ���������ײ�
		    if (!isset($pkg_infos[$pinfo['package_id']])) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //����ֻ��ײͰ�״̬�����ã����������ײ�
		    if ('0' != $pkg_infos[$pinfo['package_id']]['status']) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //����ʷѰ������ڣ����¼��־��Ȼ���������ײ�
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
	 * ͨ��list_pkgs��ȡ��͹�����
	 * @param $list_pkgs
	 * @return int|boolean
	 */
	public static function getMinBuyPrice(&$list_pkgs)
	{
		if(empty($list_pkgs)) return -1;
		$pkg_ids = $fee_pkg_ids = array();
    	foreach ($list_pkgs as $v) {
    	    if (!in_array($v['package_id'], $pkg_ids)) {
    	        //�����ֻ��ײ�id
    	        $pkg_ids[] = $v['package_id'];
    	    }
    	    if (!in_array($v['fee_package_id'], $fee_pkg_ids)) {
    	        //�����ʷ��ײ�id
    	        $fee_pkg_ids[] = $v['fee_package_id'];
    	    };
    	}
		Logger::info($list_pkgs);
		//��ȡչʾ��Ŀ
	    $columns = self::getFeeItems($fee_pkg_ids);
		if(FALSE === $columns) return false;
		$pkg_infos = self::getPackages($pkg_ids);
		if(FALSE === $pkg_infos) return false;
		$sorted_pkg_name_arr = array();
		foreach($pkg_infos as $i_pkg_info) { //�ײ�������
			$sorted_pkg_name_arr[] = $i_pkg_info['package_name'];
		}
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		sort($sorted_pkg_name_arr, SORT_NUMERIC);
		$new_list_pkgs = array();
		foreach($list_pkgs as $pinfo)
		{
		    //����ֻ��ײͰ������ڣ����¼��־��Ȼ���������ײ�
		    if (!isset($pkg_infos[$pinfo['package_id']])) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //����ֻ��ײͰ�״̬�����ã����������ײ�
		    if ('0' != $pkg_infos[$pinfo['package_id']]['status']) {
		        unset($columns[$pinfo['fee_package_id']]);
		        continue;
		    }
		    //����ʷѰ������ڣ����¼��־��Ȼ���������ײ�
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
		//������Сֵ
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
	 * ͨ��product_id��ȡ�ʷѰ���Ϣ
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
	 * ͨ��product_id��fee_id��������ȡΨһ��һ���ʷѰ���Ϣ
	 * @param int $product_id     ��ƷID
	 * @param int $fee_id         �ʷ���ĿID
	 * @param int $wh_id          վ��ID
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
		//�˴���һ���ʷѰ���Ӧ���ʷ���Ŀ�����պ�Լ��һ�ڵķ�ʽ�������ʷѰ��ϡ��Ա��޸ĺ�ά��
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
	 * ���������ʷѰ�id��ȡ���Ƕ�Ӧ���ʷ���Ŀ
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
	 * ����Ψһ���ʷѰ�ID��ȡ��Ӧ���ʷ���Ŀ
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
		// ���ӵ�ǰ̨�����ݿ�cp_information
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
			self::$errMsg = '��ȡ�ײͺͷ�����Ϣʧ��, line:'. __LINE__ . ',errMsg:' . $mysql->errMsg;
			return false;
		}
		
		return $packageInfo;
	}
	
	/* 	
		@desc ��ö��ƻ�֧�ֵ���������
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
			self::$errMsg = "�ò�Ʒ�����ڶ��ƻ�����";
			return false;
		}
		
		$type = $ret[0]['SaleModeSysNo'];
		return $type;
	}
	
	
	/*
	* ��ȡһ��id�����Ѿ�ע��Э��ĸ���
	*/
	public static function getIDRegCount($idcard)
	{
		// ����֮ǰ���� $idcard ����ĺϷ��ԣ��˴��������
		// ���ݶ������ҵ���Լ�еĺ���
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
		�ж��Ƿ��Ƕ��ƻ���Ʒ��Ŀǰֻ��Ҫһ��flag���λ��
		Ϊ��ֹ�Ժ����չ�����ô�������ķ�ʽ
		return : ���ƻ�������
	*/
	public static function isCustomPhoneProduct(&$product)
	{
	
		if( !isset($product['flag']) )
		{
			self::$errMsg = "no flag!";
			return false;		
		}
		// ���ƻ���Ʒ
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
		�ж��Ƿ��Ƕ��ƻ�������Ŀǰֻ��Ҫһ��flag���λ��
		Ϊ��ֹ�Ժ����չ�����ô�������ķ�ʽ
	*/
	public static function isCustomPhoneOrder(&$order)
	{
	
		if( !isset($order['flag']) )
			return false;

		// ���ƻ�����
		if( ($order['flag'] & ORDER_CP ) == ORDER_CP )
		{
			return true;
		}
		return false;
	}
	
	/*
		�ж��Ƿ��Ƕ��ƻ����ֻ�����Ŀǰֻ��Ҫһ��flag���λ��
		Ϊ��ֹ�Ժ����չ�����ô�������ķ�ʽ
	*/
	public static function isCustomPhoneCard(&$product)
	{	
		// ���ƻ��ֻ���
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

		// ���ƻ���Ʒ
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
			self::$errMsg = "��֧�ֵĵ�ַ($district)�����ؿ�����,errMsg:" . IPreOrder::$errMsg;
			return false;
		}
		$forbidList = array();
		//��ȡ��Ʒ��������
		if($product_id != $CardID) {
			$products = array($product_id, $CardID);
		}
		else { //ѡ������
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
		// �����߼����
		$shipNotAvailable = array();
		if (!empty($forbidList)) {
			$shipNotAvailable = IShipping::getForbidenShippingType($forbidList, $_District[$district]['province_id'], $_District[$district]['city_id'], $district, $wh_id);
		}
		foreach($shippingTypeRet as $key => $shipping) {
			if(isset($shipNotAvailable[$key])) {
				unset($shippingTypeRet[$key]);
			}
		}

		//�޳�����
		$bothExist = array_intersect($_SelfFetchProductids, $products);
		if (count($bothExist) == 0) {
			foreach ($shippingTypeRet as $key => $it) {
				if (false === strpos($it['ShipTypeName'], '�������')) {
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
			$shippingType[$sp_type['SysNo']]['ShipTypeDesc'] = "�ֽ�֧���Ϻ�/�㶫/����վ��ݸ�������<a target='_blank' href='http://st.51buy.com/help/3-1-icson_delivery.htm'><span class='strong'>������鿴����˵���е��Ϻ�/�㶫/����վ����</span></a>";
			$shippingType[$sp_type['SysNo']]['Period'] = "�Ϻ���������ȷ����ĵ�һ�������գ�����������һ��������";
			$shippingType[$sp_type['SysNo']]['shippingPrice'] = 0;
			$shippingType[$sp_type['SysNo']]['shippingPriceCut'] = 0;
			$shippingType[$oneShippingType['ShippingId']]['subOrder'][$psystock]['timeAvaiable'] = $shippingtime;
		}
		return array('shippingType' => $shippingType , 'forbidden' => $forbidList); 
	}
}