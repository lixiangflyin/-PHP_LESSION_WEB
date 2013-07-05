<?php
class CompConfig
{
	public static $dbname = 'icson_event_component';
	
	public static function getDB()
	{
		return Config::getDB(self::$dbname);
	}
	
}