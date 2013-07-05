<?php
/*错误码定义
600:三级类目id不合法
601:三级类目id对应属性不存在
602:属性没有对应option
603:replace参数为空
604:option_id不合法
605：attr_id不合法
606：option_value不合法
607：status为空
608：sort_factor为空

*/

class ISearchNav
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static function replaceAttr($newAttr)
	{
		if (!isset($newAttr) || empty($newAttr)) {
			self::$errCode = 603;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newAttr is null";
			return false;
		}
				
		if (!isset($newAttr['c3_id']) || $newAttr['c3_id'] <=0 ) {
			self::$errCode = 600;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newAttr['c3_id']" . $newAttr['c3_id']. " is invalid";
			return false;
		}
		
		if (!isset($newAttr['attr_id']) || $newAttr['attr_id'] <=0 ) {
			self::$errCode = 605;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newAttr['attr_id']" . $newAttr['attr_id']. " is invalid";
			return false;
		}
		
		if (!isset($newAttr['attr_value']) || $newAttr['attr_value'] == '' ) {
			self::$errCode = 606;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newAttr['attr_value']" . $newAttr['attr_value']. " is invalid";
			return false;
		}
		
		if (!isset($newAttr['status'])) {
			self::$errCode = 607;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newAttr['status'] is null";
			return false;
		}
		
		if (!isset($newAttr['sort_factor'])) {
			self::$errCode = 608;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newAttr['sort_factor'] is null";
			return false;
		}
		$newAttr['updatetime'] = time();
		
		$item = ISearchNavAttrTTC::get($newAttr['c3_id'], array('attr_id'=>$newAttr['attr_id']));
		if (false === $item) {
			self::$errCode = ISearchNavAttrTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query ISearchNavAttrTTC failed]' . ISearchNavAttrTTC::$errMsg;
			return false;
		}
		
		if (0 == count($item)) {
			$ret = ISearchNavAttrTTC::insert($newAttr);
		}else 
		{
			$ret = ISearchNavAttrTTC::update($newAttr, array('attr_id'=>$newAttr['attr_id']));
		}
		
		if (false === $ret) {
			self::$errCode = ISearchNavAttrTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update/insert ISearchNavAttrTTC failed]' . ISearchNavAttrTTC::$errMsg;
			return false;
		}
		return true;
	}
	
	public static function replaceAttrOption($newOption)
	{
		if (!isset($newOption) || empty($newOption)) {
			self::$errCode = 603;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOption is null";
			return false;
		}
		
		if (!isset($newOption['option_id']) || $newOption['option_id'] <=0 ) {
			self::$errCode = 604;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOption['option_id']" . $newOption['option_id']. " is invalid";
			return false;
		}
		
		if (!isset($newOption['attr_id']) || $newOption['attr_id'] <=0 ) {
			self::$errCode = 605;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOption['attr_id']" . $newOption['attr_id']. " is invalid";
			return false;
		}
		
		if (!isset($newOption['option_value']) || $newOption['option_value'] == '' ) {
			self::$errCode = 606;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOption['option_value']" . $newOption['option_value']. " is invalid";
			return false;
		}
		
		if (!isset($newOption['status'])) {
			self::$errCode = 607;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOption['status'] is null";
			return false;
		}
		
		if (!isset($newOption['sort_factor'])) {
			self::$errCode = 608;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "newOption['sort_factor'] is null";
			return false;
		}
		$newOption['updatetime'] = time();
		
		$item = ISearchNavAttrOptionTTC::get($newOption['attr_id'], array('option_id'=>$newOption['option_id']));
		if (false === $item) {
			self::$errCode = ISearchNavAttrOptionTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[query ISearchNavAttrOptionTTC failed]' . ISearchNavAttrOptionTTC::$errMsg;
			return false;
		}
		
		if (0 == count($item)) {
			$ret = ISearchNavAttrOptionTTC::insert($newOption);
		}else 
		{
			$ret = ISearchNavAttrOptionTTC::update($newOption, array('option_id'=>$newOption['option_id']));
		}
		
		if (false === $ret) {
			self::$errCode = ISearchNavAttrOptionTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update/insert ISearchNavAttrOptionTTC failed]' . ISearchNavAttrOptionTTC::$errMsg;
			return false;
		}
		return true;		
	}
	public static function getSearchNav($c3id)
	{
		if (!isset($c3id) || $c3id <= 0) {
			self::$errCode = 600;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "c3id($c3id) is invalid";
			return false;
		}
		
		$item = ISearchNavAttrTTC::get($c3id);
		if (false === $item) {
			self::$errCode = ISearchNavAttrTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[QUERY ISearchNavAttrTTC failed]' . ISearchNavAttrTTC::$errMsg;
			return false;
		}
		
		if (0 == count($item))
		{
			self::$errCode = 601;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "c3id($c3id) has no attr";
			return false;
		}
		
		$result = array();
		
		$keys = array();
		foreach ($item as $attr)
		{
			$result[$attr['attr_id']] = array();
			$result[$attr['attr_id']]['attr_value'] = $attr['attr_value'];
			$result[$attr['attr_id']]['sort_factor '] = $attr['sort_factor '];
			
			$keys = $attr['attr_id'];
		}
		
		$attr_options = ISearchNavAttrOptionTTC::gets($keys);
		if (false === $item) {
			self::$errCode = ISearchNavAttrOptionTTC::$errCode;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[QUERY ISearchNavAttrOptionTTC failed]' . ISearchNavAttrOptionTTC::$errMsg;
			return false;
		}
		
		if (0 == count($item))
		{
			self::$errCode = 602;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "c3id($c3id)'s attr has no option";
			return false;
		}
		
		foreach ($attr_options as $attr_option)
		{
			$result[$attr['attr_id']]['option'][] = array('option_value'=>$attr_option['option_value'], 'option_id'=>$attr_option['option_id']);
		}
		
		
		return $result;
	}
	
}