<?php
require_once(PHPLIB_ROOT . 'inc/DIYConfig.inc.php');
/**
 * ǰ̨�û���ȡ<font color="#010101">DIY</font>�����Ϣ��
 * @author oscarzhu
 * @version 1.0
 * @created 03-����-2011 15:26:06
 */

class IDIYUser
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
	 * ���û����б���ʱ��
	 */
	private static $saveTime = 1;
	
	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/*
	 * ��ȡDIY����
	 * @param int $mid ����id
	 * @return array
	 * 
	 */		
	public static function getDIYUserList($uid, $wid)
	{
		$minfo = IDiyUserMasterTTC::get($uid, array('wh_id'=>$wid,'status'=>0));
		if( $minfo === false )
		{
			self::$errCode = IDiyUserMasterTTC::$errCode;
			self::$errMsg  = IDiyUserMasterTTC::$errMsg;
			return array();
		}
		return $minfo;
	}
		
	/*
	 * ��ȡDIYĳһ����
	 * @param int $mid ����id
	 * @return array
	 * 
	 */		
	public static function getDIYUser($uid, $mid)
	{
		$minfo = IDiyUserMasterTTC::get($uid, array('oid'=>$mid,'status'=>0));
		if( $minfo === false )
		{
			self::$errCode = IDiyUserMasterTTC::$errCode;
			self::$errMsg  = IDiyUserMasterTTC::$errMsg;
			return array();
		}
		$pinfo = IDiyUserItemTTC::get($mid,array('status'=>0));
		if( $pinfo === false )
		{
			self::$errCode = IDiyUserItemTTC::$errCode;
			self::$errMsg  = IDiyUserItemTTC::$errMsg;
			return array();
		}
		return array('type'=>$minfo,'pinfo'=>$pinfo);
	}
	
	/*
	 * �ж������Ƿ����
	 * @param int $mid ����id
	 * @return array
	 * 
	 */		
	public static function checkDIYUserExist($uid, $mid)
	{
		$minfo = IDiyUserMasterTTC::get($uid, array('oid'=>$mid,'status'=>0));
		if( $minfo === false )
		{
			self::$errCode = IDiyUserMasterTTC::$errCode;
			self::$errMsg  = IDiyUserMasterTTC::$errMsg;
			return array();
		}
		if(empty($minfo))
			return false;
		return true;
	}

	/*
	 * ��ȡ�û�������
	 * @param int $mid ����id
	 * @return array
	 * 
	 */		
	public static function getUserCountDIYUser($uid, $wh_id)
	{
		$minfo = IDiyUserMasterTTC::get($uid,array('status'=>0,'wh_id'=>$wh_id));
		if( $minfo === false )
		{
			self::$errCode = IDiyUserMasterTTC::$errCode;
			self::$errMsg  = IDiyUserMasterTTC::$errMsg;
			return false;
		}
		return count($minfo);
	}
		
	/*
	 * ���DIY����
	 * @param int $uid	�û�id
	 * @param int $wh_id  �ֲ�id
	 * @param array $info = array ('��Ʒid','���id','����') 
	 * @param int $type  ��������
	 * @param string $title  ����
	 * @param string $tTitle  ��������
	 * @return bool
	 * 
	 */		
	public static function addDIYUser($type, $uid, $info, $wh_id, $title, $tTitle)
	{
		$mid = IIdGenerator::getNewId('DIYConfig_Master_Sequence');

		//��ӵ�master��
		$insertArray = array(
			'user_id'	=>	$uid,		
			'oid'	=>	$mid,
			'id'	=>	$mid,
			'pid'	=>	1,
			'wh_id'	=>	$wh_id,
			'type_id'	=>	$type,
			'sort'	=>	0,
			'status'	=>	0,
			'updatetime'	=>	date('Y-m-d H:i:s',time()),
			'createtime'	=>	date('Y-m-d H:i:s',time()),
			'recordtime'	=>	date('Y-m-d H:i:s',time()),
			'name'			=>	$title,
			'title'			=>	$title,
			'type_name'		=>	$tTitle,
			'desc'			=>	'',
		);
		$ret = IDiyUserMasterTTC::insert($insertArray);
		if( $ret === false )
		{
			self::$errCode = IDiyUserMasterTTC::$errCode;
			self::$errMsg  = IDiyUserMasterTTC::$errMsg;
			return false;
		}
		
		foreach( $info as $key=>$val )
		{
			$iid = IIdGenerator::getNewId('DIYConfig_Item_Sequence');
			$insertArray = array(
				'master_id'	=>	$mid,			
				'oid'	=>	$iid,
				'wh_id'	=>	$wh_id,
				'product_id'	=>	$val['id'],
				'num'	=>	$val['num'],
				'isShowPic'	=>	0,
				'status'	=>	0,
				'item_id'	=>	$key,
				'updatetime'	=>	date('Y-m-d H:i:s',time()),
				'createtime'	=>	date('Y-m-d H:i:s',time()),
			);
			$ret = IDiyUserItemTTC::insert($insertArray);
			if( $ret === false )
			{
				self::$errCode = IDiyUserItemTTC::$errCode;
				self::$errMsg  = IDiyUserItemTTC::$errMsg;
				return false;
			}
		}
				
		return true;
	}
	
	/*
	 * �޸�DIY����
	 * @param int $mid ����id
	 * @param int $uid	�û�id
	 * @param int $wh_id  �ֲ�id
	 * @param array $info = array ('��Ʒid','���id','����') 
	 * @param int $type  ��������
	 * @param string $title  ����
	 * @param string $tTitle  ��������
	 * @return bool
	 * 
	 */	
	public static function ModDIYUser($mid, $type, $uid, $info, $wh_id, $title, $tTitle)
	{
		$pinfo = IDiyUserItemTTC::get($mid);
		if( $pinfo === false )
		{
			self::$errCode = IDiyUserItemTTC::$errCode;
			self::$errMsg  = IDiyUserItemTTC::$errMsg;
			return array();
		}
				
		//�޸�item�����Ʒ��¼
		foreach( $pinfo as $tmp )
		{
			$key = $tmp['item_id'];
			if(!empty($info[$key]['id']))
			{
				$updateArray = array(
					'master_id'	=>	$mid,
					'product_id'	=>	$info[$key]['id'],
					'num'	=>	$info[$key]['num'],
					'status'	=>	0,
					'updatetime'	=>	date('Y-m-d H:i:s',time()),
				);
			} else {
				$updateArray = array(
					'master_id'	=>	$mid,
					'status'	=>	-1,
					'updatetime'	=>	date('Y-m-d H:i:s',time()),
				);
			}
			$ret = IDiyUserItemTTC::update($updateArray,
					array('item_id'=>$key,'wh_id'=>$wh_id));
			if( $ret === false )
			{
				self::$errCode = IDiyUserItemTTC::$errCode;
				self::$errMsg  = IDiyUserItemTTC::$errMsg;
				return false;
			}
			unset($info[$key]);
		}
		
		//������������
		if(!empty($info))
		{
			foreach( $info as $key=>$val )
			{
				$iid = IIdGenerator::getNewId('DIYConfig_Item_Sequence');
				$insertArray = array(
					'master_id'	=>	$mid,			
					'oid'	=>	$iid,
					'wh_id'	=>	$wh_id,
					'product_id'	=>	$val['id'],
					'num'	=>	$val['num'],
					'isShowPic'	=>	0,
					'status'	=>	0,
					'item_id'	=>	$key,
					'updatetime'	=>	date('Y-m-d H:i:s',time()),
					'createtime'	=>	date('Y-m-d H:i:s',time()),
				);
				$ret = IDiyUserItemTTC::insert($insertArray);
				if( $ret === false )
				{
					self::$errCode = IDiyUserItemTTC::$errCode;
					self::$errMsg  = IDiyUserItemTTC::$errMsg;
					return false;
				}
			}
		}
				
		//�޸�master�����¼
		$updateArray = array(
			'user_id'	=>	$uid,
			'oid'		=>	$mid,
			'type_id'	=>	$type,
			'name'			=>	$title,
			'title'			=>	$title,
			'type_name'		=>	$tTitle,
			'updatetime'	=>	date('Y-m-d H:i:s',time()),
		);
		$ret = IDiyUserMasterTTC::update($updateArray,array('wh_id'=>$wh_id,'oid'=>$mid));
		if( $ret === false )
		{
			self::$errCode = IDiyUserMasterTTC::$errCode;
			self::$errMsg  = IDiyUserMasterTTC::$errMsg;
			return false;
		}		
		return true;
	}

	/*
	 * ɾ��DIY����
	 * @param int $mid ����id
	 * @param int $wh_id  �ֲ�id
	 * @return bool
	 * 
	 */
	public static function delDIYUser($mid,$wh_id,$uid)
	{	
		//�޸�item�����Ʒ��¼
		$updateArray = array(
			'master_id'	=>	$mid,
			'status'	=>	-1,
			'updatetime'	=>	date('Y-m-d H:i:s',time()),
		);	
		$ret = IDiyUserItemTTC::update($updateArray,array('wh_id'=>$wh_id));
		if( $ret === false )
		{
			self::$errCode = IDiyUserItemTTC::$errCode;
			self::$errMsg  = IDiyUserItemTTC::$errMsg;
			return false;
		}
		
		//�޸�master�����¼
		$updateArray = array(
			'user_id'	=>	$uid,
			'oid'		=>	$mid,
			'status'	=>	-1,
			'updatetime'	=>	date('Y-m-d H:i:s',time()),
		);
		$ret = IDiyUserMasterTTC::update($updateArray,array('wh_id'=>$wh_id,'oid'=>$mid));
		if( $ret === false )
		{
			self::$errCode = IDiyUserMasterTTC::$errCode;
			self::$errMsg  = IDiyUserMasterTTC::$errMsg;
			return false;
		}		
		
		return true;
		return true;
	}
		
}