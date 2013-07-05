<?php
/**
 *  小分类组件类
 * @author rongxu
 * @version 1.0
 * @created 16-04-2012
 */
class CompCategory
{
	private static $tableName = "t_category";
	private static $debug = true; //调试开关
	
	/**
	 * 日志调试
	 */
	private static function logger($str)
	{
		if(self::$debug)
			logger::info($str);
	}
	
	/**
	 * 从数据库拉取组件信息
	 * @param int $id 
	 * @return string 组件界面
	 */	
	public static function getConfig($configId, $id)
	{
		$db = Config::getDB('icson_admin_store');
		$sql = "select * from " . self::$tableName . " WHERE id=" . $id;
		$rs = $db->getRows($sql);
		if (empty($rs)) {
			$sql = "select * from " . self::$tableName . " WHERE id=" . ($id + 10000000);
			$rs = $db->getRows($sql);
		}
		if ($rs === false || empty($rs)) {
			return '';
		} else {
			$style = htmlspecialchars_decode($rs[0]['style']);
			$lists = json_decode($rs[0]['lists']);
			if (!empty($style)) {
				$i = 1;
				foreach ($lists as $list) {
					$name = htmlspecialchars_decode($list->name);
					$url = htmlspecialchars_decode($list->url);
					$style = str_replace('{@name_' . $i . '}', iconv("UTF-8", "GBK", $name), $style);
					$style = str_replace('{@url_' . $i . '}', iconv("UTF-8", "GBK", $url), $style);
					$i++;
				}
			} else {
				foreach ($lists as $list) {
					$name = htmlspecialchars_decode(iconv("UTF-8", "GBK", $list->name));
					$url = htmlspecialchars_decode(iconv("UTF-8", "GBK", $list->url));
					$style .= '<a href="' . $url . '" target="_blank" title="' . $name . '">' . $name . '</a>';
				}
			}
			return $style;
		}
	}
	
}