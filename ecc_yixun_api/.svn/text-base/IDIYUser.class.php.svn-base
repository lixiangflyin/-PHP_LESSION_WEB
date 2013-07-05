<?php
require_once(PHPLIB_ROOT . 'inc/DIYConfig.inc.php');
/**
 * 前台用户获取<font color="#010101">DIY</font>相关信息类
 * @author oscarzhu
 * @version 1.0
 * @created 03-五月-2011 15:26:06
 */

class IDIYUser
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 设置缓存中保存时间
	 */
	private static $saveTime = 1;
	
	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	public static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/*
	 * 拉取DIY配置
	 * @param int $mid 类型id
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
	 * 拉取DIY某一配置
	 * @param int $mid 类型id
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
	 * 判断配置是否存在
	 * @param int $mid 类型id
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
	 * 拉取用户配置数
	 * @param int $mid 类型id
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
	 * 添加DIY配置
	 * @param int $uid	用户id
	 * @param int $wh_id  分仓id
	 * @param array $info = array ('产品id','配件id','数量') 
	 * @param int $type  配置类型
	 * @param string $title  名称
	 * @param string $tTitle  类型名称
	 * @return bool
	 * 
	 */		
	public static function addDIYUser($type, $uid, $info, $wh_id, $title, $tTitle)
	{
		$mid = IIdGenerator::getNewId('DIYConfig_Master_Sequence');

		//添加到master表
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
	 * 修改DIY配置
	 * @param int $mid 配置id
	 * @param int $uid	用户id
	 * @param int $wh_id  分仓id
	 * @param array $info = array ('产品id','配件id','数量') 
	 * @param int $type  配置类型
	 * @param string $title  名称
	 * @param string $tTitle  类型名称
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
				
		//修改item表里产品记录
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
		
		//插入新添的配件
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
				
		//修改master表里记录
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
	 * 删除DIY配置
	 * @param int $mid 配置id
	 * @param int $wh_id  分仓id
	 * @return bool
	 * 
	 */
	public static function delDIYUser($mid,$wh_id,$uid)
	{	
		//修改item表里产品记录
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
		
		//修改master表里记录
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