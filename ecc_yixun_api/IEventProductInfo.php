<?php

if (!defined('WEB_ROOT')) {
	define('WEB_ROOT', '/data/release/webapp/');
}

define('CHANNEL_NEWMEMBER', 1);

class IEventProductInfo
{
	public static $errCode	= 0;
	
	public static $errMsg	= '';
	
	public static $channelConfigs = array(
		CHANNEL_NEWMEMBER	=> array(
			'name'		=> '����Ƶ��ר��',
			'event_ids' => array(
				SITE_SH	=> '5603',
				SITE_SZ	=> '5604',
				SITE_BJ	=> '5605',
				SITE_WH	=> '5606',
				SITE_CQ	=> '5607',
				SITE_XA	=> '5608',
			)
		)
	);
	
	public static function getAllByChannelId($channel_id, $site_id = SITE_ALL)
	{
		$event_id = self::getEventIdByChannelId($channel_id, $site_id);
		return !empty($event_id) ? self::getProductInfos($event_id) : '';
	}
	
	public static function getEventIdByChannelId($channel_id, $site_id = SITE_ALL)
	{
		if (isset(self::$channelConfigs[$channel_id]) && isset(self::$channelConfigs[$channel_id]['event_ids'][$site_id])) {
			return self::$channelConfigs[$channel_id]['event_ids'][$site_id];
		} else {
			self::$errCode	= 101;
			self::$errMsg	= 'Ƶ�������ڻ�վ�㲻����';
			return 0;
		}
	}
	
	public static function getProductInfos($event_id) {
		$dir = WEB_ROOT . 'event_icson_com/web/event/';
		$js_filename = $dir . $event_id . '.js';
		
		if (file_exists($js_filename)) {
			return file_get_contents($js_filename);
		} else {
			self::$errCode	= 201;
			self::$errMsg	= 'IDΪ' . $event_id . '�Ļ�����ڻ��Ӧjs�����ļ�������';
			return '';
		}
	}
}