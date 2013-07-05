<?php
/**
 * AlertLog: Save the alert entity to local storage file.
 */

require_once 'AlertEntity.php';

if ( !defined('ALERT_DIR') ) {
    define('ALERT_DIR', '/data/alertlogs/');
}

final class AlertRecord
{
	/**
	 * record
	 * Enter description here ...
	 * @param unknown_type $entity
	 */
	public function record($entity)
	{
		// Check the parameters.
		$timetag = $entity->getTimetag();
		$content = $entity->getContent();
		if( empty($timetag) || empty($content) )
			return ;
		
		// Check whether root path for alert exits or not.
		$logDir = ALERT_DIR;
		if ( !file_exists($logDir) ) {
			@umask(0);
			@mkdir($logDir, 0777, true);
		}
		
		// Check whether log file exists.
		$fileName = ALERT_DIR."alert_".date("Ymd").".log";
		$file = fopen($fileName, "a+");
		if( !$file )
			return ;
			
		// Save the log to file. TODO: Format the string for business usage.
		$string = $timetag."|".$content."\r\n";
		fwrite($file, $string);
			
		// Close the file.
		fclose($file);
	}
}