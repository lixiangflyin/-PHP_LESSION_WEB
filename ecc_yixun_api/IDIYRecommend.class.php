<?php
require_once(PHPLIB_ROOT . 'inc/DIYConfig.inc.php');
require_once(PHPLIB_ROOT . 'api/IReviewReply.php');

/**
 * ǰ̨�û���ȡ�Ƽ����÷�����
 * @author oscarzhu
 * @version 1.0
 * @created 03-����-2011 15:25:54
 */
class IDIYRecommend
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
	 * ��������ʶ����ÿ����������ǰ����
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * ��ȡĳ�Ƽ����õ�����
	 *
	 * @param type
	 */
	public static function getComment($id,$begin,$num)
	{
		return IReviewDIY::getDIYReview($id,$begin,$num);
	}

	/**
	 * ��ȡĳ�Ƽ����õ�����
	 *
	 * @param type
	 */
	public static function getCommentCount($id)
	{
		return IReviewDIY::getDIYReviewCount($id);
	}
		
	/**
	 * ���ĳ�Ƽ����õ�����
	 *
	 * @param type
	 */
	public static function setComment($rid,$uid,$content)
	{
		$uid = IUser::getLoginUid();
		if(!$uid)
			return false;
		return IReviewDIY::addDIYReview($rid,$uid,$content);
	}
	
	/**
	 * ���ĳ�Ƽ����õ����ۻظ�
	 *
	 * @param int $cid ����id
	 * @param int $uid �ظ���id
	 * @param int $uid ������id
	 * @param string $content ����
	 * @return bool
	 */
	public static function setCommentReply($cid, $uid, $cuid, $content)
	{
		global $_REVIEW_SUB_CATEGORY;
		$uid = IUser::getLoginUid();
		if(!$uid)
			return false;
		return IReply::addReply($cid, $uid, $cuid, $_REVIEW_SUB_CATEGORY['DIY'], $content);
	}

	/**
	 * ��ȡĳ�Ƽ����õ����ۻظ�
	 *
	 * @param int $cid ����id
	 * @param int $uid �ظ���id
	 * @param int $uid ������id
	 * @param string $content ����
	 * @return bool
	 */
	public static function getCommentReply($cid, $begin=0, $num=0)
	{
		global $_REVIEW_SUB_CATEGORY;
		return IReply::getReplies($cid, $_REVIEW_SUB_CATEGORY['DIY'], $begin, $num);
	}
	
	/**
	 * ��ȡĳ���Ƽ�����Ĭ����Ʒ�б�
	 *
	 * @param id
	 */
	static function getDefaultDetail($id,$wid)
	{
		// modify by yakehuang
		$return = array();
		$Details = self::getDetail($wid, $id);
		$defaults = IDIYInfo::handleStrideStock($Details, $wid);
		foreach ($Details as $data)
		{
			if (isset($defaults[$data['item_id']]) && $defaults[$data['item_id']] == $data['product_char_id'])
				$return[] = $data;
		}
		return $return;
	}

	/**
	 * ��ȡ�Ƽ�������ϸ��Ϣ<font color="#010101">(</font>����Ĭ�Ϻͱ�ѡ<font color="#010101">)</font>
	 *
	 * @param id
	 */
	function getDetail($wid, $id)
	{
		$info =  IDiyRecommednDetailTTC::get($id, array('wh_id'=>$wid,'status'=>0));
		$info = self::getProductFromResult($info);
		if( $info === false )
		{
			self::$errCode = IDiyRecommednDetailTTC::$errCode;
			self::$errMsg  = IDiyRecommednDetailTTC::$errMsg;
			return false;
		}
			
		if(empty($info))
			return array();
		$pIds = array();
		$lists = array();
		foreach( $info as $val )
		{
			$pIds[] = $val['product_id'];
			$lists[$val['product_id']] = $val;
		}

		//��Ʒ��Ϣ
		$products = IProduct::getProductsInfo($pIds,$wid);
	
		if(empty($products))
			return array();
		$result = array();
		foreach( $products as $product )
		{
			$product['count'] = $lists[$product['product_id']]['count'];
			$product['pic_show'] = $lists[$product['product_id']]['pic_show'];;
			$product['enable'] = $lists[$product['product_id']]['enable'];
			$product['item_id'] = $lists[$product['product_id']]['item_id'];
			$result[] = $product;
		}
		return $result;
	}

	/**
	 * ��ȡ�����µ���ϸ�Ƽ������б�
	 *
	 * @param type
	 */
	function getList($wid, $type)
	{
		$info = IDiyInfoTTC::get(DIY_RECOMMEND_LIST,array('wh_id'=>$wid,'type_id'=>$type,'status'=>0));
		//����
		$tmpArr = array();
		foreach ($info as $t){
			$tmpArr[] = $t['sort'];
		}
		array_multisort($tmpArr, SORT_ASC ,SORT_NUMERIC,$info);		
		if( $info === false )
		{
			self::$errCode = IDiyInfoTTC::$errCode;
			self::$errMsg  = IDiyInfoTTC::$errMsg;
			return false;
		}
		return $info;
	}

	/**
	 * ��ȡ�Ƽ�������Ϣ
	 *
	 * @param int $wid
	 * @param int $type
	 * @param int $rid
	 * @return array ���û�����Ϣ�����������ͼ۸�
	 */
	public static function getRecommendInfo($wid, $type, $rid, $flag=0)
	{
		$info = IDiyInfoTTC::get(DIY_RECOMMEND_LIST,array('wh_id'=>$wid, 'oid'=>$rid));
		if( $info === false )
		{
			self::$errCode = IDiyInfoTTC::$errCode;
			self::$errMsg  = IDiyInfoTTC::$errMsg;
			return false;
		}
		if(empty($info))
			return $info;
		$ret = $info[0];
		//������
		$ret['comment'] = self::getCommentCount($rid);
		if($flag)
		{
			//�۸�
			$details = self::getDefaultDetail($rid, $wid);
			$pIds = array();
			foreach ( $details as $val )
			{
				$pIds[] = $val['product_id'];
			}
			//��Ʒ��Ϣ
			$products = IProduct::getProductsInfo($pIds,$wid);
			$ret['price'] = 0;
			foreach( $products as $product )
			{
				$ret['price'] += $product['show_price'];
			}
		}

		return $ret;
	}
		
	/**
	 * ��ȡ���ñ�ѡ��Ʒ
	 *
	 * @param id
	 */
	function getOtherDetail($id)
	{
		$result =  IDiyRecommednDetailTTC::get($id,array('status'=>0));
		$result = self::getProductFromResult($result);
		if( $result === false )
		{
			self::$errCode = IDiyRecommednDetailTTC::$errCode;
			self::$errMsg  = IDiyRecommednDetailTTC::$errMsg;
			return false;
		}
		if(!$result)
			return array();
		$otherPorducts = array();
		foreach($result as $item)
		{
			if($item['enable']!=1)
				array_push($otherPorducts,$item);
		}
		return $otherPorducts;
	}

	/**
	 * ��ȡ�Ƽ����������Ϣ
	 */
	static function getType($wid)
	{
		$info = IDiyInfoTTC::get(DIY_RECOMMEND_TITLE,array('wh_id'=>$wid,'status'=>0,'pid'=>1));
		//����
		$tmpArr = array();
		foreach ($info as $t){
			$tmpArr[] = $t['sort'];
		}
		array_multisort($tmpArr, SORT_ASC ,SORT_NUMERIC,$info);
		if( $info === false )
		{
			self::$errCode = IDiyInfoTTC::$errCode;
			self::$errMsg  = IDiyInfoTTC::$errMsg;
			return false;
		}
		return 	$info;
	}

	/**
	 * ȥ��product_idΪ0�ͿյĽ����
	 * 
	 */	
	public static function getProductFromResult($result)
	{
		$info = array();
		$pids = array();
		foreach($result as $val)
		{
			if( $val['product_id'] && (!in_array($val['product_id'],$pids) || $val['enable']==1) )
			{
				$info[] = $val;
				$pids[] = $val['product_id'];
			}
		}
		return $info;
	}
	
	/**
	 * ��ȡĳ���Ƽ�����Ĭ����Ʒ��������Ʒ��Ϣ���������
	 *
	 * @param id
	 */
	static function getDefaultProductsInfo($id,$wid)
	{
		$products = self::getDefaultDetail($id,$wid);
		
		$pIds = array();
		$lists = array();
		foreach( $products as $val )
		{
			$pIds[] = $val['product_id'];
			$lists[$val['product_id']] = $val;
		}
		
		//��Ʒ��Ϣ
		$products = IProduct::getProductsInfo($pIds,$wid);
			
		if(empty($products))
			return array();
		$result = array();
		
		foreach( $products as $key=>$product )
		{		
			$product['count'] = $lists[$product['product_id']]['count'];
			$product['pic_show'] = $lists[$product['product_id']]['pic_show'];;
			$ret = IDiyInfoTTC::get(DIY_ITEM,array('oid'=>$lists[$product['product_id']]['item_id']));
			$product['item_name'] = $ret[0]['name'];	
			$product['item_id'] = $lists[$product['product_id']]['item_id'];
			$result[] = $product;
		}
			
		return $result;
	}
		
}
?>