<?php
/**
 * ǰ̨�û���ȡ�������������Ϣ��
 * @author oscarzhu
 * @version 1.0
 * @created 03-����-2011 15:26:06
 */
class IActSecondHand
{	
	public static $c3BaseId = 100000000;
	public static $c2BaseId = 10000;
	public static $pageSize = 30;
	
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ���û����б���ʱ��
	 */
	private static $saveTime = 300;//5����
	
	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}

	/**
	 * ��ȡ������Ϣ
	 */
	public static function getErrMsg()
	{
		return self::$errMsg;
	}
	
	//��������ȡ����
	function getProuductFromPaiPai($input)
	{
		$input['key'] = '����';
		return ISearch::gets($input);
	}
	
	public static function getProducts($id,$page,$level=2)
	{
		$wid = IUser::getSiteId();
		$input = array(
					'currentPage'	=>	$page,
					'pageSize'	=>	IActSecondHand::$pageSize,
					"sort" => 6,
					"desc" => 1,
					"day" => 0,
					"price" => 0,
					"option" => '',
					"classId"	=> $id,
					"categorylevel" 	=>	$id ? $level : '',
					"areacode"	=>	$wid
					);
		return self::getProuductFromPaiPai($input);			
	}
	
	/*
	 * 
	 * ������Ʒ����Ŀ¼����
	 */
	public static function getCategory()
	{
		$wid = IUser::getSiteId();
		$input = array(
					'currentPage'	=>	1,
					'pageSize'	=>	1,
					"sort" => 6,
					"desc" => 1,
					"day" => 0,
					"price" => 0,
					"option" => '',
					"classId"	=>	0,
					"areacode"	=>	$wid
					);
		$data = self::getProuductFromPaiPai($input);
		$category1 = self::_getCategory1Name($data['classes']);
		$category2 = self::_getCategory2Name($data['classes']);
		$category3 = self::_getCategory3Name($data['classes']);
		
		return array('c2'=>$category1,'c3'=>$category2,'c4'=>$category3);
	}
	
	//����С����
	private static function _getCategory3Name($data)
	{
		$result = array();
		$tmp = array();
		foreach( $data as $val )
		{
			if($val['id']>IActSecondHand::$c3BaseId)
				$tmp[] = $val['id']-IActSecondHand::$c3BaseId;
		}
		$ret = self::getCategorysName($tmp,3);
		$tmp = array();
		foreach( $ret as $val )
		{
			$tmp['id'] = $val['id'];
			$tmp['name'] = $val['name'];
			$result[$val['parent_id']][] = $tmp;
		} 
		//var_dump($result);
		return $result;
	}
	
	//����С����
	private static function _getCategory2Name($data)
	{
		$result = array();
		$tmp = array();
		foreach( $data as $val )
		{
			if( ($val['id']>IActSecondHand::$c2BaseId) && ($val['id']<IActSecondHand::$c3BaseId) )
				$tmp[] = $val['id'] - IActSecondHand::$c2BaseId;
		}
		//var_dump($tmp);
		$ret = self::getCategorysName($tmp,2);
		$tmp = array();
		foreach( $ret as $val )
		{
			$tmp['id'] = $val['id'];
			$tmp['name'] = $val['name'];
			$result[$val['parent_id']][] = $tmp;
		} 
		//var_dump($result);
		return $result;
	}

	//һ��С����
	private static function _getCategory1Name($data)
	{
		$result = array();
		$tmp = array();
		foreach( $data as $val )
		{
			if($val['id']<IActSecondHand::$c2BaseId)
				$tmp[] = $val['id'];
		}
		$ret = self::getCategorysName($tmp,1);
		$tmp = array();
		foreach( $ret as $val )
		{
			$tmp['id'] = $val['id'];
			$tmp['name'] = $val['name'];
			$result[] = $tmp;
		} 
		//var_dump($result);
		return $result;
	}
		
	//����
	private static function getCategorysName($ids,$type)
	{
		$ret = ICategoryTTC::gets(($ids),array('level'=>$type));
		return $ret;
	}	
}