<?php

require_once 'AlertEntity.php';
require_once 'AlertConfig.php';

class AlertReport
{
	/**
	 * report
	 * Enter description here ...
	 * @param unknown_type $entity
	 */
	public function report($priority, $apiId, $entity, $errCode, $cost)
	{
		if( 0 >= $apiId )
			return ;
			
		// Report the entity to backend.
		$content = $entity->getContent();
		
		// Alert while priority is fatal and error occurs.
		if( (0 == $priority) && (0 != $errCode) )
		{
			// Test code, need request for alarm ID.
			$ret = qp_itil_write(StringAlertId, $content);	
		}
		
		// Record to local module api.
		$mlog =	new CLoggerWrap(AppModuleId);
		
		// Regular the error code.
		$retCode = $errCode;
		if( 0 > $errCode || $errCode > 6 )
			$errCode = 6; // Other error code.
		
		// Record the status.
		$mlog->appReport($cost, AppCalleeId, $apiId, $retCode, $errCode, LocalIp, LocalIp);
	}
}