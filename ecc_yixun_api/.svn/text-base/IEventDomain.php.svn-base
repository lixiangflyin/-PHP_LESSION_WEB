<?php
class IEventDomain{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static $BZID = 1;
	

	/**
	 * 参加活动的用户数，
	 * 
	 * @param	$batch_id 批次标识 , 默认为null, 即返回本次活动的总用户数
	 *
	 */	
		
	public static function getUserCount($batch_id = null){
		
		$ret = IEvent::getUserCount(self::$BZID, $batch_id);
		
		if(false === $ret){
			self::$errCode = IEvent::$errCode;
			self::$errMsg = IEvent::$errMsg;
			
			return false;
		}
	
		return $ret;
	}
	
	/**
	 * 提交愿望
	 * 
	 * @param	$batch_id 用户标识标识 
	 * @param	$product_id 商品ID
	 * 
	 * 返回值：正确返回用户参加本次活动的编号，错误返回false
	 */	
		
	public static function submitWish($uid, $product_id, $wish_price, $batch_id){
		
		$uid = intval($uid);
		$product_id = intval($product_id);
		$wish_price = intval($wish_price);
		
		$ticket = IEvent::submit($uid, self::$BZID, time(), "$product_id:$wish_price", $batch_id);
		
		if(false === $ticket){
			self::$errCode = IEvent::$errCode;
			self::$errMsg = IEvent::$errMsg;
			
			return false;		
		}
		
		return $ticket;
	
	}
	
	/**
	 * 查询用户参加活动的信息
	 * 
	 * @param	$uid 用户标识 
	 * @param	$batch_id 批次标识,默认为null
	 * 
	 * 返回值：正确返回用户参加本次活动的信息，错误返回false
	 */		
	
	public static function getInformation($uid, $batch_id = null){

		$uid = intval($uid);
		
		$info = IEvent::getUserEventInfo($uid, self::$BZID, $batch_id);
		
		if(false === $info){
			self::$errCode = IEvent::$errCode;
			self::$errMsg = IEvent::$errMsg;
			
			return false;				
		}
		
		$ret = array();
		
		foreach($info as $item){
			$content = explode(":", $item["content"]);
			
			$item['product_id'] = intval($content[0]);
			$item['wish_price'] = count($content) > 1 ? intval( $content[1] ) : '';
			
			unset($item["content"]);
			
			$ret[] = $item;
		}
		
		return $ret;
	}
	
	/**
	 * 返回中奖用户
	 * 
	 * @param	$uid 用户标识 
	 * @param	$batch_id 批次标识,默认为null
	 * 
	 */
			
	public static function getJackpotUsers($batch_id){
		$info = IEvent::getJackpotUsers(self::$BZID, $batch_id);
		
		if(false === $info){
			self::$errCode = IEvent::$errCode;
			self::$errMsg = IEvent::$errMsg;
			
			return false;				
		}
		
		return $info;		
		
	}
	
	
	/**
	 * 最新许愿
	 * 
	 * @param	$limt 记录条数 
	 * 
	 */
			
	
	public static function getLastWish($limit){
		$ret = IEvent::getTopInformation(self::$BZID, $limit);
		
		if(false === $ret){
			self::$errCode = IEvent::$errCode;
			self::$errMsg = IEvent::$errMsg;
			
			return false;				
		}
		
		$items = array();
		
		foreach($ret as $item){
			
			$content = explode(":", $item['content']);
			
			
			$items[] = array(
				"uid" => $item["uid"],
				"create_time" => $item["create_time"],
				"product_id" => intval($content[0]),
				"wish_price" => count($content) > 1 ? intval($content[1]) : ''
			);
		}
		
		return $items;		
	}
}