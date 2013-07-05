<?php
/**
 * IProductTTC.php
 * ��TTC:t_product�������顢ɾ���ĵȲ���
 * 
 * @Copyright	(c) 1998-2008 Tencent Inc. All Rights Reserved
 * @Author	andyyao
 */

global $_TTC_CFG;

$_TTC_CFG['IProductTTC']['TTCKEY']	= 'IProductTTC';
$_TTC_CFG['IProductTTC']['TABLE']	= 't_product';
$_TTC_CFG['IProductTTC']['TimeOut']	= 1;
$_TTC_CFG['IProductTTC']['KEY']		= 'p_product_id';
$_TTC_CFG['IProductTTC']['FIELDS']	= array();//�������ͣ�int=1,string=2,binary=3
$_TTC_CFG['IProductTTC']['FIELDS']['p_product_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['product_id'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['c3_ids'] = array('type' => 2, 'min' => 0, 'max' => 256);
$_TTC_CFG['IProductTTC']['FIELDS']['product_char_id'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IProductTTC']['FIELDS']['mode'] = array('type' => 2, 'min' => 0, 'max' => 128);
$_TTC_CFG['IProductTTC']['FIELDS']['flag'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductTTC']['FIELDS']['type2'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductTTC']['FIELDS']['name'] = array('type' => 2, 'min' => 0, 'max' => 640);
$_TTC_CFG['IProductTTC']['FIELDS']['weight'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['volume'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['pic_num'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['barcode'] = array('type' => 2, 'min' => 0, 'max' => 32);
$_TTC_CFG['IProductTTC']['FIELDS']['status'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductTTC']['FIELDS']['color'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductTTC']['FIELDS']['size'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductTTC']['FIELDS']['restricted_trans_type'] = array('type' => 1, 'min' => -2147483648, 'max' => 2147483647);
$_TTC_CFG['IProductTTC']['FIELDS']['onshelf_time'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['promotion_word'] = array('type' => 2, 'min' => 0, 'max' => 64);
$_TTC_CFG['IProductTTC']['FIELDS']['promotion_start'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['promotion_end'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['manufacturer'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['updatetime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['createtime'] = array('type' => 1, 'min' => 0, 'max' => 4294967295);
$_TTC_CFG['IProductTTC']['FIELDS']['warranty'] = array('type' => 2, 'min' => 0, 'max' => 500);

class IProductTTC
{
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ttc��¼Map
	 */
	public static $ttcMap  = array();


	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'p_product_id' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'c3_ids' => 'XXX',
	 * 		'product_char_id' => 'XXX',
	 * 		'mode' => 'XXX',
	 * 		'flag' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'type2' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'weight' =>  XXX,
	 * 		'volume' =>  XXX,
	 * 		'pic_num' =>  XXX,
	 * 		'barcode' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'color' =>  XXX,
	 * 		'size' =>  XXX,
	 * 		'restricted_trans_type' =>  XXX,
	 * 		'onshelf_time' =>  XXX,
	 * 		'promotion_word' => 'XXX',
	 * 		'promotion_start' =>  XXX,
	 * 		'promotion_end' =>  XXX,
	 * 		'manufacturer' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		'warranty' => 'XXX',
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function insert($param)
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IProductTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->insert($param);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$param['p_product_id']]))
		{
			unset(self::$ttcMap[$param['p_product_id']]);
		}

		return $v;
	}

	/**
	 * ����һ��TTC��¼
	 * 
	 * @param	$param ��ʽ: 
	 * 	array(
	 * 		'p_product_id' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'c3_ids' => 'XXX',
	 * 		'product_char_id' => 'XXX',
	 * 		'mode' => 'XXX',
	 * 		'flag' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'type2' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'weight' =>  XXX,
	 * 		'volume' =>  XXX,
	 * 		'pic_num' =>  XXX,
	 * 		'barcode' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'color' =>  XXX,
	 * 		'size' =>  XXX,
	 * 		'restricted_trans_type' =>  XXX,
	 * 		'onshelf_time' =>  XXX,
	 * 		'promotion_word' => 'XXX',
	 * 		'promotion_start' =>  XXX,
	 * 		'promotion_end' =>  XXX,
	 * 		'manufacturer' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		'warranty' => 'XXX',
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function update($param, $filter = array())
	{
		self::clearErr();
		
		if(empty($param) || !is_array($param))
		{
			self::$errCode = 111;
			self::$errMsg  = 'param is empty';
		}
		$ttc = Config::getTTC('IProductTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->update($param, $filter);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$param['p_product_id']]))
		{
			unset(self::$ttcMap[$param['p_product_id']]);
		}

		return $v;
	}

	/**
	 * ɾ��һ��TTC��¼
	 * 
	 * @param   string  $key		���ݿ������
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
	 */
	public static function remove($key, $filter= array())
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		$ttc = Config::getTTC('IProductTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->delete($key, $filter);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if(!empty(self::$ttcMap[$key]))
		{
			unset(self::$ttcMap[$key]);
		}

		return $v;
	}

	/**
	 * ȡһ��TTC��¼
	 * 
	 * @param   string  $key		���ݿ������
	 * @param   array   $multikey	��ѡ����, ���ֶ�keyʱ��ѡ, ����array('field2' => 1, 'field3' => 2)
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 * ���ݸ�ʽ:
	 * 	array(
	 * 		'p_product_id' =>  XXX,
	 * 		'product_id' =>  XXX,
	 * 		'c3_ids' => 'XXX',
	 * 		'product_char_id' => 'XXX',
	 * 		'mode' => 'XXX',
	 * 		'flag' =>  XXX,
	 * 		'type' =>  XXX,
	 * 		'type2' =>  XXX,
	 * 		'name' => 'XXX',
	 * 		'weight' =>  XXX,
	 * 		'volume' =>  XXX,
	 * 		'pic_num' =>  XXX,
	 * 		'barcode' => 'XXX',
	 * 		'status' =>  XXX,
	 * 		'color' =>  XXX,
	 * 		'size' =>  XXX,
	 * 		'restricted_trans_type' =>  XXX,
	 * 		'onshelf_time' =>  XXX,
	 * 		'promotion_word' => 'XXX',
	 * 		'promotion_start' =>  XXX,
	 * 		'promotion_end' =>  XXX,
	 * 		'manufacturer' =>  XXX,
	 * 		'updatetime' =>  XXX,
	 * 		'createtime' =>  XXX,
	 * 		'warranty' => 'XXX',
	 * 		)
	 */
	public static function get($key, $filter = array(), $need = array(), $itemLimit = 0, $start = 0)
	{
		self::clearErr();
		
		if(empty($key))
		{
			self::$errCode = 111;
			self::$errMsg  = 'key is empty';
		}
		if(empty($filter) && !empty(self::$ttcMap[$key]))
		{
			return self::$ttcMap[$key];
		}

		$ttc = Config::getTTC('IProductTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($key, $filter, $need , $itemLimit, $start );
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		if (count(self::$ttcMap) > 100)
		{
			self::$ttcMap = array();
		}

		if (empty($filter))
		{
				self::$ttcMap[$key] = $v;

		}

		return $v;
	}

	/**
	 * ����ȡTTC��¼
	 * 
	 * @param   string  $keys		���ݿ����������
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 */
	public static function gets($keys)
	{
		self::clearErr();
		
		if(empty($keys) || !is_array($keys))
		{
			self::$errCode = 111;
			self::$errMsg  = 'keys is empty';
		}
		$ttc = Config::getTTC2('IProductTTC');
		if(!$ttc)
		{
			self::$errCode = 114;
			self::$errMsg  = 'get instance of TTC failed';
			return false;
		}

		$v = $ttc->get($keys);
		if(false === $v)
		{
			self::$errCode = $ttc->errCode;
			self::$errMsg  = $ttc->errMsg;
			return false;
		}

		return $v;
	}

	/**
	 * ȡ����TTCӰ�������
	 * 
	 * 
	 * ����ֵ����ȷ����>-1�����������󷵻ظ���
	 */
	public static function getTTCAffectRows()
	{
		$ttc = Config::getTTC('IProductTTC');
		if(!$ttc)
		{
			self::$errCode = -114;
			self::$errMsg  = 'get instance of TTC failed';
			return -1;
		}

		return $ttc->getAffectRows();
	}

}

//End Of Script

