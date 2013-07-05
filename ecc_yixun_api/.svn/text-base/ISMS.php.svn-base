<?php
/**
 *
 * 消息相关
 *
 *
 * @author rongxu
*/
class ISMS {

	public static $errMsg = '';

	public static $errCode = 0;

	//插入消息
	public static function insertSMS($uid, $biz, $msg) {
		$key = ICmemKeys::SMS . $biz . $uid;

		$newId = IIdGenerator::getNewId('sms_record_' . $biz);

		$data = array('id' => $newId, 'msm' => $msg, 'status' => 0);
		$values = unserialize(IDataCache::getData($key));
		$smsData = array();
		if (count($values) > 0) {
			$values[] = $data;
			$smsData = $values;
		} else {
			$smsData[] = $data;
		}

		$rst = IDataCache::setData($key, serialize($smsData));

		if (!$rst) {
			self::$errMsg = IDataCache::$errMsg;
			self::$errCode = IDataCache::$errCode;
			return false;
		} else {
			return $rst;
		}
	}

	//查询消息
	public static function getSMS($uid, $biz) {
		$key = ICmemKeys::SMS . $biz . $uid;
		$ret = EA_AutoPayBack::getPayBackInfoMyOrders($uid);
		//更新价保信息
		if(false === $ret){
			Logger::err("EA_AutoPayBack::getPayBackInfoMyOrders error:" . EA_AutoPayBack::$errMsg);
		}
		//self::insertSMS($uid, $biz, 'hello');
		$values = unserialize(IDataCache::getData($key));
		$i = 0;
		foreach ($values as $value) {
			if ($value['status'] == 0) {
				$i++;
			}
		}
		return $i;
	}

	//更新消息
	public static function updateSMS($uid, $biz, $id = 0) {
		$key = ICmemKeys::SMS . $biz . $uid;

		$values = unserialize(IDataCache::getData($key));
		if(empty($values) || !is_array($values))
		{
			self::$errMsg = IDataCache::$errMsg;
			self::$errCode = IDataCache::$errCode;
			return false;
		}

		$smsData = array();
		$find = false;
		foreach ($values as $value) {
			if ($id > 0) {
				if ($id == $value['id']) {
					$value['status'] = -1;
					$smsData[] = $value;
					$find = true;
				} else {
					$smsData[] = $value;
				}
			} else {
				$value['status'] = -1;
				$smsData[] = $value;
				$find = true;
			}
		}

		if (!$find) {
			return false;
		}

		$rst = IDataCache::setData($key, serialize($smsData));
		if (!$rst) {
			self::$errMsg = IDataCache::$errMsg;
			self::$errCode = IDataCache::$errCode;
			return false;
		} else {
			return $rst;
		}
	}
}
