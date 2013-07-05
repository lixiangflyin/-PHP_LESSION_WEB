<?php
class IKeyWordHotClass
{
	public static $errCode = 0;
	public static $errMsg = '';
	
	public static function get($keyWord, $wh_id)
	{
		$ret = self::gets($keyWord, $wh_id);
		
		if( false !== $ret ){
			
			$ret = ToolUtil::multi_array_sort($ret, 'score', SORT_DESC);
			
			if( count($ret) > 0 ){
				$ret = $ret[0];
			}
		}
		
		return $ret;
	}

	
	/*// old ttc
	public static function gets($keyWord, $wh_id){
		$ret = IKeyWordHotClassTTC::get($keyWord, array(
			"wh_id" => $wh_id
		));
		
		if( false === $ret ){
			self::$errCode = IKeyWordHotClassTTC::$errCode;
			self::$errMsg = IKeyWordHotClassTTC::$errMsg;
		}
		
		return $ret;
	}
*/
	// new ttc
	public static function gets($keyWord, $wh_id) {
		$ttcKey = 1;
		$ret = IKeyWordHotClassNewTTC::get($ttcKey, array(
			"keyword" => $keyWord,
			"status" => 1
		));
		
		if( false === $ret ){
			self::$errCode = IKeyWordHotClassNewTTC::$errCode;
			self::$errMsg = IKeyWordHotClassNewTTC::$errMsg;
		} else {
			foreach ($ret as $k => $v) {
				$ret[$k]['c3_id'] = $v['c3id'];
			}
		}
		
		return $ret;
	}
}