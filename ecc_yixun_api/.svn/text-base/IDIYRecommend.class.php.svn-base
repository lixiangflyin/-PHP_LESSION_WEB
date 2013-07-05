<?php
require_once(PHPLIB_ROOT . 'inc/DIYConfig.inc.php');
require_once(PHPLIB_ROOT . 'api/IReviewReply.php');

/**
 * 前台用户获取推荐配置方法类
 * @author oscarzhu
 * @version 1.0
 * @created 03-五月-2011 15:25:54
 */
class IDIYRecommend
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
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	/**
	 * 拉取某推荐配置的评论
	 *
	 * @param type
	 */
	public static function getComment($id,$begin,$num)
	{
		return IReviewDIY::getDIYReview($id,$begin,$num);
	}

	/**
	 * 拉取某推荐配置的评论
	 *
	 * @param type
	 */
	public static function getCommentCount($id)
	{
		return IReviewDIY::getDIYReviewCount($id);
	}
		
	/**
	 * 添加某推荐配置的评论
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
	 * 添加某推荐配置的评论回复
	 *
	 * @param int $cid 评论id
	 * @param int $uid 回复人id
	 * @param int $uid 评论人id
	 * @param string $content 内容
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
	 * 拉取某推荐配置的评论回复
	 *
	 * @param int $cid 评论id
	 * @param int $uid 回复人id
	 * @param int $uid 评论人id
	 * @param string $content 内容
	 * @return bool
	 */
	public static function getCommentReply($cid, $begin=0, $num=0)
	{
		global $_REVIEW_SUB_CATEGORY;
		return IReply::getReplies($cid, $_REVIEW_SUB_CATEGORY['DIY'], $begin, $num);
	}
	
	/**
	 * 获取某种推荐配置默认商品列表
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
	 * 获取推荐配置详细信息<font color="#010101">(</font>包括默认和备选<font color="#010101">)</font>
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

		//产品信息
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
	 * 获取大类下的详细推荐配置列表
	 *
	 * @param type
	 */
	function getList($wid, $type)
	{
		$info = IDiyInfoTTC::get(DIY_RECOMMEND_LIST,array('wh_id'=>$wid,'type_id'=>$type,'status'=>0));
		//排序
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
	 * 获取推荐配置信息
	 *
	 * @param int $wid
	 * @param int $type
	 * @param int $rid
	 * @return array 配置基本信息加上评论数和价格
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
		//评论数
		$ret['comment'] = self::getCommentCount($rid);
		if($flag)
		{
			//价格
			$details = self::getDefaultDetail($rid, $wid);
			$pIds = array();
			foreach ( $details as $val )
			{
				$pIds[] = $val['product_id'];
			}
			//产品信息
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
	 * 获取配置备选商品
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
	 * 获取推荐置配大类信息
	 */
	static function getType($wid)
	{
		$info = IDiyInfoTTC::get(DIY_RECOMMEND_TITLE,array('wh_id'=>$wid,'status'=>0,'pid'=>1));
		//排序
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
	 * 去除product_id为0和空的结果集
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
	 * 获取某种推荐配置默认商品，包括商品信息，配件名称
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
		
		//产品信息
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