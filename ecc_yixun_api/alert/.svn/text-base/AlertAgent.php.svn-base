<?php
/**
 * Entity for process entity.
 * Enter description here ...
 */

require_once 'AlertEntity.php';
require_once 'AlertRecord.php';
require_once 'AlertReport.php';

final class AlertAgent
{
	static $apiConfig = array(
			'loadhome' => 132000538,
			'login'    => 132000560,
			'review'   => 133000561,
			'pay'      => 133000562
		);
		
	/**
	 * Default constructor of AlertAgent
	 * Enter description here ...
	 */
	public function __construct()
	{
		$this->mRecord = new AlertRecord();
		$this->mReport = new AlertReport();
	}
	
	/**
	 * process
	 * Enter description here ...
	 */
	public function process(
		$priority,
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
		// 1. Format the content, and create a new instance of entity.
		$content = AlertEntity::format($apiName, $siteId, $netType, $netState, $uid, $cost, $errCode, $errMsg, $orderId, $extra);
		$entity = new AlertEntity(time(), $content);
		
		// 2. Save the record to local file storage.
		$this->mRecord->record($entity);
		
		// Check api ID
		$apiId = $this->getApiId($apiName);
		
		if( $apiId > 0 )
		{
			// Filter the error code for review.
			if( $apiId == 133000561 )
			{
				$filterCode = array(11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 23, 24, 25, 26, 27, 28, 500, 501, 776); // More codes filter here.
				foreach ($filterCode as $filter)
				{
					// For iOS version, the error code should increase by 100000.
					if( ($errCode == $filter) || ($errCode == $filter + 100000) )
					{
						$errCode = 0;
						break;
					}
				}
			}
			
			// 3. Report entity to backend for notification.
			$this->mReport->report($priority, $apiId, $entity, $errCode, $cost);	
		}
	}
	
	/**
	 * getApiId
	 * Enter description here ...
	 * @param unknown_type $apiName
	 */
	public function getApiId($apiName)
	{
		// Trim the api name
		$apiName = trim($apiName);
		
		// Check whether index exists in array.
		if( isset(self::$apiConfig[$apiName]) )
		{
			return self::$apiConfig[$apiName];	
		}
		
		return 0;
	}
	
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	private $mRecord;
	private $mReport;
}

?>