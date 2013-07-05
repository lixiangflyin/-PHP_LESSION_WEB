<?php
class IEventDomain{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static $BZID = 1;
	

	/**
	 * �μӻ���û�����
	 * 
	 * @param	$batch_id ���α�ʶ , Ĭ��Ϊnull, �����ر��λ�����û���
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
	 * �ύԸ��
	 * 
	 * @param	$batch_id �û���ʶ��ʶ 
	 * @param	$product_id ��ƷID
	 * 
	 * ����ֵ����ȷ�����û��μӱ��λ�ı�ţ����󷵻�false
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
	 * ��ѯ�û��μӻ����Ϣ
	 * 
	 * @param	$uid �û���ʶ 
	 * @param	$batch_id ���α�ʶ,Ĭ��Ϊnull
	 * 
	 * ����ֵ����ȷ�����û��μӱ��λ����Ϣ�����󷵻�false
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
	 * �����н��û�
	 * 
	 * @param	$uid �û���ʶ 
	 * @param	$batch_id ���α�ʶ,Ĭ��Ϊnull
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
	 * ������Ը
	 * 
	 * @param	$limt ��¼���� 
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