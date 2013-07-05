<?php
class IEventZuan{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static $BZID = 2;
	
	
	public static $BATCH_ID = 1;
	
	public static $STYLE = array(
		'MEMBER' => 1,  //会员
		'YELLOW' => 2,	//黄钻
		'RED' => 3, 	//红钻
		'GREEN' => 4	//绿钻
	);
	

	/**
	 * 提交愿望
	 * 
	 * @param	$batch_id 用户标识标识 
	 * @param	$style_id 钻石款式ID
	 * 
	 * 返回值：正确返回插入信息，错误返回false
	 */	
		
	public static function submit($uid, $style_id){
		
		$uid = intval($uid);
		$style_id = intval($style_id);
		
		
		$info = self::getInformation($uid);
		
		if( false === $info ){
			return false;
		}
		
		$_param = array(
			"uid" => $uid,
			"bzid" => IEventZuan::$BZID,
			"ticket_id" => 0,
			"batch_id" => IEventZuan::$BATCH_ID,
			"create_time" => time(),
			'content' => $style_id
		);
		
		
		
		if( count($info) > 0 ){
			$result = IEventDetailTTC::update($_param, array("bzid" => IEventZuan::$BZID));
		}
		else{
			$result = IEventDetailTTC::insert($_param);
		}
		
		if(false === $result){
			self::$errCode = IEventDetailTTC::$errCode;
			self::$errMsg = IEventDetailTTC::$errMsg;
			
			return false;		
		}
		
		return $result;
	}
	
	/**
	 * 查询用户领钻信息
	 * 
	 * @param	$uid 用户标识 
	 * 
	 * 返回值：正确返回用户参加本次活动的信息，错误返回false
	 */		
	
	public static function getInformation($uid){

		$uid = intval($uid);
		
		$info = IEventDetailTTC::get($uid, array("bzid" => IEventZuan::$BZID), array("uid", 'content', 'create_time'));
		
		if(false === $info){
			self::$errCode = IEventDetailTTC::$errCode;
			self::$errMsg = IEventDetailTTC::$errMsg;
			
			return false;				
		}
		
		foreach($info as &$item){
			$item['style_id'] = $item['content'];
			unset( $item['content']);
		}
		
		return $info;
	}
}