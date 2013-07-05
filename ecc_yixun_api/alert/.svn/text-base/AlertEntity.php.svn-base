<?php
/**
 * The class definition for AlertEntity
 */

final class AlertEntity
{
	/**
	 * 
	 * Enter description here ...
	 * @param $timetag Timetag for the entity.
	 * @param $content content for the entity.
	 */
	public function __construct($timetag, $content)
	{
		$this->mTimetag = $timetag;
		$this->mContent = $content;
	}
	
	/**
	 * format
	 * Format the arguments to a string.
	 * @param unknown_type $apiName
	 * @param unknown_type $siteId
	 * @param unknown_type $uid
	 * @param unknown_type $cost
	 * @param unknown_type $errCode
	 * @param unknown_type $errMsg
	 */
	public static function format(
		$apiName,
		$siteId,
		$netType,   // Network type.
		$netState,  // Network status.
		$uid,
		$cost,
		$errCode,
		$errMsg,
		$orderId,
		$extra
		)
	{
		// Format the content.
		$content = "api:".$apiName.",site:".$siteId.",net:".$netType.",stat:".$netState.",cost:".$cost.",err:".$errCode;
		
		if( !empty($errMsg) ){
			$content = $content.",msg:".$errMsg;
		}
		
		if( !empty($uid) ) {
			$content = $content.",uid:".$uid;
		}
		
		if( !empty($orderId) ) {
			$content = $content.".order:".$orderId;
		}
		
		if( !empty($extra) ) {
			$content = $content.",extra:".$extra;
		}
		
		return $content;
	}
	
	/**
	 * getTimetag
	 * Enter description here ...
	 */
	public function getTimetag()
	{
		return $this->mTimetag;
	}
	
	/**
	 * getContent
	 * Enter description here ...
	 */
	public function getContent()
	{
		return $this->mContent;
	}
	
	private $mTimetag;
	private $mContent;
}

?>